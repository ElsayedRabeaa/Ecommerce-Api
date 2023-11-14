<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    // show products
    public function getProducts(){
        $products=Product::paginate(6);
        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // show getProductsForCategory
    public function getProductsForCategory($id){
        $products=Product::where('category_id',$id)->paginate(6);

        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function viewDetails($id){
        $products=Product::where('id',$id)->first();
        $review=Comment::where('product_id',$id)->first();
        $average=$review->sum('star') / $review->count();

        return response()->json([
            'products'=>$product,
            'total_rate'=>round($average,1),
             'status'=>1
        ]);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function topRatedProducts($type){

        // sum star products
        $products=Comment::where('category_id',$id)->paginate(6);
        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function bestSeller(){
        // sum order product
        $order=Order::where('category_id',$id)->paginate(6);
        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
        // PurchasedItem::select(DB::raw('COUNT(id) as cnt', 'voucher_id'))
        // ->groupBy('voucher_id')->orderBy('cnt', 'DESC')->first();
    }



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function searchProductORCategory(){
        // sum order product
       /*   if($request->keywork )
        $order=Order::where('category_id',$id)->paginate(6);
        return response()->json([
            'products'=>$products,
             'status'=>1
        ]);
    } */

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

}