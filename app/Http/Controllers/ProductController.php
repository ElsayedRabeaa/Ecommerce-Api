<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    // show products
    public function getProducts(){
        $products=Product::all();
        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
    }


        // show getProductsForCategory
    public function getProductsForCategory($id){
        $products=Product::where('cat_id',$id)->get();
        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
    }
    
}
