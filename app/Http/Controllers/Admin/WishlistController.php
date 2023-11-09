<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    
    public function getWishlists()
    {
        $Wishlist=Wishlist::all();
        return response()->json([
            'Wishlist'=>$Wishlist,
            'status'=>1
        ]);
    }

    public function sendNotification()
    {
        //cron job
        
        // send 
    }

    
}
