<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments(){
        $Comments=Comment::all();
         return response()->json([
        'Comments'=>$Comments,    
        'status'=> 1 ,
         ]); 
    }

   

    public function desoryComment($id){
        $Comment=Comment::find($id);

        if(!$Comment){
            return response()->json([
                'message' => 'Comment not found',
                'status'=> 0 ,
                
            ]);
            
        }
        $Comment->delete($id);

        if($Comment){
            return response()->json([
                'message' => 'Comment Deleted Successfully',
                'status'=> 1 ,
            ]);
        }

    }
    
}
