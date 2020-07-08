<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use DB;

class ProductsController extends Controller
{
   
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        try {

            $filePath = "";
            if ($request->has('image')) {
                $filePath = uploadImage('products', $request->image);
            }

            $products = Product::create([
                'title' => $request->title,
                'price' => $request->price,
                'image' => $filePath,
                'cat_id' => $request->cat_id,
            ]);
         
            return redirect()->route('admin.products')->with(['success' => 'You Have Been Added']);

        } catch (\Exception $ex) {
             return redirect()->route('admin.products')->with(['error' => $ex.'There Is Some Error']);

        }
    }

    public function edit($id)
    {
        try {

            $product = Product::find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'There IS No Product ']);

            $categories = Category::all();

            return view('admin.products.edit', compact('product', 'categories'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.products')->with(['error' =>'There Is Some Error']);
        }
    }

    public function update($id, UpdateProductRequest $request)
    {

        try {

            $product = Product::find($id);
            if (!$product)
                  return redirect()->route('admin.products')->with(['error' => 'There IS No Product ']);

            // Start TransAction From Here To Confirm all Process Excuted
            DB::beginTransaction(); 
            //check image in request
            if ($request->has('image') ) {
                 $filePath = uploadImage('products', $request->image);
                Product::where('id', $id)
                    ->update([
                        'image' => $filePath,
                    ]);
            }
            $data = $request->except('_token', 'id', 'image');

            Product::where('id',$id)->update($data);

            // If ALL TransAction Excuted Do Commit     
            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'You Have Been Updated']);
        } catch (\Exception $exception) {
            return $exception;
            //If TransAction Not Excuted do database rollback
            DB::rollback();
            return redirect()->route('admin.products')->with(['error' => 'There Is Some Error']);
        }

    }

    public function destroy($id)
    {

        try {
            $product = Product::find($id);
            if (!$product)
               return redirect()->route('admin.products')->with(['error' => 'There Is No This Product ']);

                //delete Image File from folder
               $image = Str::after($product->image, 'assets/');
               $image = base_path('assets/' . $image);
               unlink($image); 

            $product->delete();
            return redirect()->route('admin.products')->with(['success' => 'You Have Been Deleted']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'There Is Some Error']);
        }
    }
}
