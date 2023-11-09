<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getCats(){
        $categories=Category::select('id','name','image')->get();
         return response()->json([
        'categories'=>$categories,
        'status'=> 1 ,

         ]); 
    }

    public function storeCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        
        else{
            if($request->has('image')){
                $file = $request->file('image');
                $name = time();
                $extension = $file->extension();
                 $fileName = $name.'.'.$extension;
                $file->move('ImagesCategories',$fileName);
            };
            Category::create([
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'image' => $fileName,
            ]);
        }

        return response()->json([
            'message'=>' Category Added Successfully',
            'status'=> 1 ,
        ]);
    }


    public function updateCategory(Request $request,$id){


        $Category=Category::find($id);

        if(!$Category){
            return response()->json([
                'message'=>' Category Not Found',
                'status'=> 0 ,
            ]);
        }
        $Category->update($request->all());

        if($Category){
            
            return response()->json([
                'message'=>' Category  updated successfully',
                'status'=> 1 ,
            ]);

        }
        if($request->all() == null){
            
            return response()->json([
                'message'=>' You Must Edit a One Value at Least',
                'status'=> 0 ,
            ]);

        }
    }


    public function desoryCategory($id){
        $Category=Category::find($id);
        if(!$Category){
            return response()->json([
                'message'=>' Category Not Found',
                'status'=> 0 ,
            ]);
        }
        $Category->delete($id);

        if($Category){
            
            return response()->json([
                'message'=>' Category Deleted',
                'status'=> 1 ,
            ]);
        }

    }
    
 
}
