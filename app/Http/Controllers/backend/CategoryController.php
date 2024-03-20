<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        $category_list = Category::pluck('title', 'id')->all();

        return view('categories.index', compact('category_list', 'categories'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        return view('categories.create', compact('categories'));
    }

    public function edit($id)
    {
        $post = Category::findOrFail($id);

        if ($post)
            return view('categories.edit', compact('post'));
        else
            return 'Data Not Found!';
    }

    public function store(Request $request)
    {
        function CleanURL($string, $delimiter = '-')
        {
            $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
            $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);
            return $string;
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            // 'slug' => 'required|string|max:255|unique:products',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $this->UploadImage($request, 'image', 'images/categories/', '200', '200');
        }

        $category = Category::create([
            'title' => $request->title,
            'slug'   => CleanURL($request->title),
            'parent_id' => $request->parent_id,
            'image' => $image ?? null,
            'status' => $request->status ? 1 : 0,
        ]);

        if ($request->ajax()) {
            $categories = Category::with('subCategories')->whereNull('parent_id')->get();
            if ($categories)
                return view('categories.listbox', compact('categories'));
            else
                return 'Data Not Found!';
        } else {
            return redirect()->back()->with('success', 'Category added successfully.');
        }
    }

    public function update(Request $request, $id)
    {
        function CleanURL2($string, $delimiter = '-')
        {
            $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
            $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);
            return $string;
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            // 'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);


        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->UploadImage($request, 'image', 'images/categories/', '200', '200', $category->image);
        }

        if ($request->status) {
            $validatedData['status'] = 1;
        } else {
            $validatedData['status'] = 0;
        }

        $validatedData['slug'] = CleanURL2($request->title);

        $category->update($validatedData);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Category has been updated',
        ];

        if ($request->ajax()) {

            $categories = Category::with('subCategories')->whereNull('parent_id')->get();
            if ($categories)
                return view('categories.listbox', compact('categories'));
            else
                return 'Data Not Found!';

        } else {
            return back()->with($notification);
        }
    }


    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }

        $data->delete();

        $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        if ($categories)
            return view('categories.listbox', compact('categories'));
        else
            return 'Data Not Found!';
    }
}
