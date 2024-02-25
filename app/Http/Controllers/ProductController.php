<?php

namespace App\Http\Controllers;

use App\Exports\ExportProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show', 'list']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('products.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::withoutTrashed()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_id', function ($row) {
                    return $row->category_id->title;
                })
                ->addColumn('imageview', function ($row) {
                    $galleryIds = json_decode($row->galleryimg_id, true);

                    if (is_array($galleryIds) && !empty($galleryIds)) {
                        $images = Media::whereIn('id', $galleryIds)->get();
                        if (!empty($images[0])) {
                            $imageUrl = asset($images[0]->file_directory . '/' . $images[0]->filename);
                        } else {
                            $imageUrl = asset('/demo_img.jpg');
                        }
                    } else {
                        $imageUrl = asset('/demo_img.jpg');
                    }
                    return '<a href="' . $imageUrl . '" data-lightbox="product-gallery" data-title="">
                        <img src="' . $imageUrl . '" alt="Product Image" class="img-thumbnail" width="50" height="50">
                    </a>';
                })
                ->addColumn('details', function ($row) {
                    return '<span>' . $row->detail . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('products.edit', $row->id);
                    $deleteUrl = route('products.destroy', $row->id);

                    $actionBtn = '';

                    // Check if the user has permission to edit
                    if (Auth::user()->can('product-edit')) {
                        $actionBtn .= '<a href="' . $editUrl . '" class="edit btn btn-success btn-xs" data-toggle="tooltip"
                        data-original-title="edit">Edit</a> ';
                    }

                    // Check if the user has permission to delete
                    if (Auth::user()->can('product-delete')) {
                        $actionBtn .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="delete btn btn-danger btn-xs">Delete</button>
                                   </form>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['imageview', 'details', 'action'])
                ->make(true);
        }
    }



    public function create()
    {
        $categories = Category::withoutTrashed()->with('subCategories')->whereNull('parent_id')->get();
        $brands = Brand::withoutTrashed()->latest()->get();
        $offers = Offer::withoutTrashed()->latest()->get();
        return view('products.create', compact('categories','brands','offers'));
    }




    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'detail' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0',
            'type' => 'nullable',
            'galleryimg_id' => 'required|array',
            'category' => 'required|exists:categories,id',
            'meta_keyword' => 'nullable',
            'unit' => 'nullable',
            'quantity' => 'nullable',
            'stock_alert' => 'nullable',
        ]);

        $validatedData['type'] ??= null;
        $validatedData['type'] = json_encode($validatedData['type']);
        $validatedData['galleryimg_id'] = json_encode($validatedData['galleryimg_id']);
        $validatedData['meta_keyword'] = json_encode($validatedData['meta_keyword']);
        $validatedData['created_by'] = Auth::user()->id;

        // Get the selected category and its ancestors
        $category = Category::findOrFail($validatedData['category']);
        $categoryHierarchy = $this->getCategoryHierarchy($category);
        $validatedData['category_hierarchy'] = json_encode($categoryHierarchy);


        $product = new Product($validatedData);
        $product->save();

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Product has been added'
        );

        return redirect()->route('products.index')
            ->with($notification);
    }


    private function getCategoryHierarchy(Category $category)
    {
        $hierarchy = [$category->id];

        while ($category->parent_id) {
            $category = Category::findOrFail($category->parent_id);
            array_unshift($hierarchy, $category->id);
        }

        return $hierarchy;
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $post = Product::findOrFail($product->id);
        $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        $types = json_decode($product->type);

        return view('products.edit', compact('post', 'categories', 'types'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'detail' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0',
            'type' => 'nullable',
            'galleryimg_id' => 'required|array',
            'category' => 'required|exists:categories,id',
            'meta_keyword' => 'nullable',
            'unit' => 'nullable',
            'quantity' => 'nullable',
            'stock_alert' => 'nullable',
        ]);

        $validatedData['type'] ??= null;
        $validatedData['type'] = json_encode($validatedData['type']);
        $validatedData['galleryimg_id'] = json_encode($validatedData['galleryimg_id']);
        $validatedData['meta_keyword'] = json_encode($validatedData['meta_keyword']);
        $validatedData['edited_by'] = Auth::user()->id;

        // Get the selected category and its ancestors
        $category = Category::findOrFail($validatedData['category']);
        $categoryHierarchy = $this->getCategoryHierarchy($category);
        $validatedData['category_hierarchy'] = json_encode($categoryHierarchy);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Product has been updated'
        );

        return back()->with($notification);
    }


    public function destroy($id)
    {
        // Retrieve the product with the given ID
        $product = Product::findOrFail($id);
        $product->delete();

        // Your logic for deleting goes here

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Product deleted successfully'
        );

        return redirect()->route('products.index')->with($notification);
    }


    public function exportCSVFile()
    {
        // return (new ExportProducts)->download('users.csv', Maatwebsite\Excel\Excel::CSV);

        return Excel::download(new ExportProducts, 'products.xls');
    }
}
