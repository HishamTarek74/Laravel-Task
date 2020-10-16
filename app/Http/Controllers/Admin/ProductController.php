<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use  Yajra\Datatables\Datatables;
use File;
use Event;
use App\Events\SendMail;

class ProductController extends Controller
{

	function index()
    {
     return view('admin.services');
    }
 function getdata()
    {
        
     $AllData = Product::select('id', 'name', 'description', 'price' ,'image')->get();

     return Datatables::of($AllData)
     ->addColumn('name', function($AllData){
        return  $AllData->name;
    })
    ->addColumn('description', function($AllData){
        return $AllData->description;
    })
    ->addColumn('price', function($AllData){
        return $AllData->price;
    })
    ->addColumn('image', function($AllData){
        return $AllData->image;
    })
    ->addColumn('medias', function($AllData){
        return $AllData->id;
    })
     ->addColumn('action', function($AllData){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$AllData->id.'">
                <i class="fa fa-edit fa-2x" ></i> </a> 
                
                <a href="#" class="btn btn-xs btn-danger deleteModal "   data-toggle="modal" data-target="#confirm-delete" id="'.$AllData->id.'">
                <i class="fa fa-times fa-2x"></i> </a>';
            })
     ->make(true);
    }

    function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description'  => 'required',
            'imagee'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        // Validation Of Data 
        $error_array = array();
        $success_output = '';

        // If Fail 
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }

        // If Succsess
        else
        {
            // Insert Data 
            if($request->get('button_action') == "insert")
            {
                   //Upload Images
                    $filePath = "";
                      if ($request->has('imagee')) {
                         $filePath = uploadImage('products', $request->imagee);
                      }

                        $data = new Product([
                        'name'             => $request->get('name'),
                        'description'      => $request->get('description'),
                        'price'            => $request->get('price'),
                        'image'            =>  $filePath,
                            ]);            
                   
                $data->save();
                //Send mail when Product Added Using Event 
                event(new SendMail(1));
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }


            // Update Data By student_id
            if($request->get('button_action') == 'update')
            {
                $data = Product::find($request->get('student_id'));

                 // Update Image 
                 $filePath = "";
                 if ($request->has('imagee')) {
                    $filePath = uploadImage('products', $request->imagee);
                    $data->image = $filePath;
                 }

                $data->name =$request->get('name');
                $data->description =$request->get('description');
                $data->price =$request->get('price');
                $data->save();
                $success_output = '<div class="alert alert-success"> Product Updated
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    // Fetch Data has been Updated  With id
     function fetchdata(Request $request)
    {
        $id = $request->input('id');
        $data = Product::find($id);
        $name= $data['name'];
        $descs=  $data['description'];
        $price=  $data['price'];
        $image=  $data['image'];

        $output = array(
            'name'        =>   $name,
            'description'  =>   $descs,
            'price'       =>   $price,
            'image'       =>   $data['image']

        );

        echo json_encode($output);

    }

    // Remove Date 
    function removedata(Request $request)
    {
        $data = Product::find($request->input('id'));
        $image_path =$data->main_image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
      }

       $image_full = str_replace('/thumbnail','',$image_path);
        
      if(File::exists($image_full)) {
          File::delete($image_full);
    }

        if($data->delete())
        {
            echo '<div class="alert alert-success"> Product Deleted 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
        }
    }
}