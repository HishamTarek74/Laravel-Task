<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(StoreCategoryRequest $request)
    {

        try {

            $category = Category::create($request->all());
            return redirect()->route('admin.categories')->with(['success' => 'You Have been Added Category']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'There Is Some Error']);
        }

    }


    public function edit($Cat_id)
    {
        $mainCategory = Category::find($Cat_id);
        if (!$mainCategory)
               return redirect()->route('admin.categories')->with(['error' => 'There Is No This Category']);
        return view('admin.categories.edit', compact('mainCategory'));
    }


    public function update($Cat_id, UpdateCategoryRequest $request)
    {

        try {
            $category = Category::find($Cat_id);

            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'There Is No This Category ']);

            $category->update($request->all());
            return redirect()->route('admin.categories')->with(['success' => 'You Have been Updated']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.categories')->with(['error' => 'You Have Some Error']);
        }

    }

    public function destroy($id)
    {

        try {
            $category = Category::find($id);
            if (!$category)
               return redirect()->route('admin.categories')->with(['error' => 'There Is No This Category ']);
            /*If Category Have Products Not Allowed deleted
            ** I Can Use Observer For Deleted Product in Updates
            **But I Choose This Scnario
            */
            $products = $category->products();
            if (isset($products) && $products->count() > 0) {
                return redirect()->route('admin.categories')->with(['error' => 'Not Allowed deleted']);
            }

            $category->delete();
            return redirect()->route('admin.categories')->with(['success' => 'You Have Been Deleted']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'There Is Some Error']);
        }
    }
}
