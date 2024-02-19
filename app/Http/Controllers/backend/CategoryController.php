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

        return view('categories.index', compact('category_list','categories'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        return view('categories.create', compact('categories'));
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
        ]);

        Category::create([
            'title' => $request->title,
            'slug'   => CleanURL($request->title),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();


        $notification = array(
            'alert-type' => 'success',
            'message' => 'Category and its children deleted successfully'
        );

        return redirect()->back()->with($notification);
    }
}
