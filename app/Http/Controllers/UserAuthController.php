<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    // USER REGISTER API - POST
 public function register(Request $request)
 {
     // validation
     $request->validate([
         "name" => "required",
         "email" => "required|email|unique:users",
         "password" => "required"
     ]);
// create user data + save
     $user = new User();
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = bcrypt($request->password);
    $user->save();
// send response
     return response()->json([
         "status" => 1,
         "message" => "User registered successfully"
     ], 200);
 }
      // User LOGIN API - POST
  public function login(Request $request)
  {
      // validation
      $request->validate([
          "email" => "required|email",
          "password" => "required"
      ]);
// verify user + token
      if (!$token = auth()->guard()->attempt(["email" => $request->email, "password" => $request->password])) {
        return response()->json([
              "status" => 0,
              "message" => "Invalid credentials"
          ]);
      }
// send response
      return response()->json([
          "status" => 1,
          "message" => "Logged in successfully",
          "access_token" => $token
      ]);
  }
// USER PROFILE API - GET
  public function profile()
  {
      $User_data= auth()->guard()->user();
    if( auth()->check()){

     return response()->json([
          "status" => 1,
          "message" => "User profile data",
          "data" => $User_data
      ]);
    }else{
        return response()->json([
            "status" => 0,
            "message" => "User Not Found"
        ]); 
    }
  }
// USER LOGOUT API - GET
  public function logout()
  {
    if( auth()->check()){
      auth()->guard()->logout();
     return response()->json([
          "status" => 1,
          "message" => "User logged out"
      ]);
    }else{
        return response()->json([
            "status" => 0,
            "message" => "User Not Found"
        ]); 
    }
  }
  

  // USER UPDATE API - GET
  public function updateProfile(Request $request)
  {
    if( auth()->check()){
      if($request->email == null && $request->password != null ){
        $user_id=auth()->user()->id;
        $user=User::where('id',$user_id)->first();

        $user->update([
         'password'=>$request->password
        ]);
      
     return response()->json([
          "status" => 1,
          "message" => "password Changed"
      ]);
    }
    else{
        $user->update([
            'email'=>$request->email
           ]);
          return response()->json([
            "status" => 1,
            "message" => "email Changed"
        ]); 
    }
}
  }



  public function deleteMyAccount()
  {

      if(auth()->check()){
          $user_id = auth()->guard('user')->user()->id;
          User::where('id',$user_id)->delete();
              return response()->json([
                  'message'=>'the Account DELETED successfully',
                  'status'=> 1 ,
  
              ]);
  
          }else{
              return response()->json([
                  'message'=>'you arenot authenticated',
                  'status'=> 0 ,
  
              ]);
          }
  
  }

  
}
