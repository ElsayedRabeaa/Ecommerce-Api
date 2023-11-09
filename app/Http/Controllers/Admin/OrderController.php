<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrders(){
        $Orders=Order::all();
         return response()->json([
        'Orders'=>$Orders,
        'status'=> 1 ,
         ]); 
    }

   

    public function desoryOrder($id){
        $Order=Order::find($id);
        
        if(!$Order){
            return response()->json([
                'message' => 'Order not found',
                'status'=> 0 ,
            ]);
            
        }
        $Order->delete($id);
        
        if($Order){
            return response()->json([
                'message' => 'Order deleted',
                'status'=> 1 ,
            ]);

        }

    }   
   
}
