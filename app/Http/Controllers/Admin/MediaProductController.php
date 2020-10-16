<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Validator;
use App\Models\Product;
use App\Models\MediaProduct;
use  Yajra\Datatables\Datatables;
use  Image;
use DB;

class MediaProductController extends Controller
{
    
    function show()
    {
       
       return redirect('services');
    }

    function index($idservice)
    {
       if($idservice){
            $products = Product::find($idservice);
            if(!empty($products)>0)
                {
                return view('admin.productmedia')->with('products',$products);
                }
                else{
                    return redirect('services');
                }
            }else{
                return redirect('services');
            }       
     //http://127.0.0:8000/ajaxdata
    }

    function getdata($idproduct)
    {
        $SQL="select id, image from  mediaproducts where  IdProduct=".$idproduct;
        $products  =DB::select($SQL);
            return Datatables::of($products)

            ->addColumn('image', function($products){
                return $products->image;
            })

            ->addColumn('action', function($products){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$products->id.'">
                <i class="fa fa-edit fa-2x" ></i> </a>         
                <a href="#" class="btn btn-xs btn-danger deleteModal "   data-toggle="modal" data-target="#confirm-delete" id="'.$products->id.'">
                <i class="fa fa-times fa-2x"></i> </a>';
                
            })
     ->make(true);
    }

    function postdata(Request $request)
    {
        
         $validation = Validator::make($request->all(), [

          'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
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
               if ($request->has('image')) {
                  $filePath = uploadImage('products', $request->image);
               }
         
                    $media = new MediaProduct([

                        'image'     =>  $filePath ,
                        'IdProduct' =>  $request->get('IdProduct')
                     ]);
                    $media->save();
                    $success_output = '<div class="alert alert-success">Image Inserted</div>';
            }

                      // Update Data By student_id
                      if($request->get('button_action') == 'update')
                      {
                          $data = MediaProduct::find($request->get('Date_id'));
          
                          // Update Image 
                            $filePath = "";
                            if ($request->has('image')) {
                                $filePath = uploadImage('products', $request->image);
                                $data->image = $filePath;
                            }
                          $data->save();
                          $success_output = '<div class="alert alert-success">Image  Updated
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

    function fetchdata($id)
    {

        $data = MediaProduct::find($id);
      
      $output = array(

            'image'      =>  $data['image']
        );
        echo json_encode($output);

    }


    function removedata($id)
    {
       
        $media = MediaProduct::find($id);
       
        $image_path = $media->image;  // Value is not URL but directory file path

                        if(File::exists($image_path)) {
                            File::delete($image_path);
                    }
                        $image_full=str_replace('/thumbnail','',$image_path);
                    
                        
                        if(File::exists($image_full)) {
                            File::delete($image_full);
                    }
       
        if($media->delete())
        {
            echo '<div class="alert alert-success">Image Deleted 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>';
        }
    }

}
