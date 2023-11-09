<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCarts(){
        $Cart=Cart::all();
         return response()->json([
        'Cart'=>$Cart,
        'status'=> 1 ,
         ]); 
    }

   

    public function desoryCart($id){
        $Cart=Cart::find($id);

        if(!$Cart){
            return response()->json([
                'message' => 'Cart not found',
                'status'=> 0 ,
            ]);
            
        }

        

        if($Cart){
            $Cart->delete($id);
            return response()->json([
                'message' => 'Cart deleted',
                'status'=> 1 ,
            ]);
        }

    }   
}
