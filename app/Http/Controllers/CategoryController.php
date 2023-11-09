<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCats(){
        $categories=Category::select('id','name','image')->get();
         return response()->json([
        'categories'=>$categories,
        'status'=>1
         ]); 
    }
   
 
}
