<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
class AuthController extends Controller
{
  // Admin LOGIN API - POST
  public function login(Request $request)
  {
      // validation
      $request->validate([
          "email" => "required|email",
          "password" => "required"
      ]);
// verify user + token
      if (!$token = auth()->guard('admin')->attempt(["email" => $request->email, "password" => $request->password])) {
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
    $admin_data=auth()->guard('admin')->user();
      if( auth()->guard('admin')->check()){
        return response()->json([
          "status" => 1,
          "data" => $admin_data
      ]);
    }
    else{
      return response()->json([
        "status" => 0,
        "message" => "You Arenot Authenticated",
        
    ]);
    }
  }
// USER LOGOUT API - GET
  public function logout()
  {
    if( auth()->guard('admin')->check()){
      auth()->guard('admin')->logout();
      return response()->json([
          "status" => 1,
          "message" => "Admin logged out"
      ]);
    }
    else{
      return response()->json([
        "status" => 0,
        "message" => "You Arenot Authenticated",
        
    ]);
    }

  }

  // USER LOGOUT API - GET
  public function deleteUser($id)
  {
    
    $User=App\Models\User::find($id);

        if(!$User){
            return response()->json([
                'message' => 'User not found',
                'status'=>0
            ]);
            
        }

        if($User){
            $User->delete($id);
            return response()->json([
                'message' => 'User Delted',
                'status'=>1
            ]);
        }


  }


    // USER LOGOUT API - GET
    public function updateProfile(Request $request)
    {
      if( auth()->guard('admin')->check()){
          $admin_id=auth()->guard('admin')->user()->id;
          $admin=Admin::where('id',$admin_id)->first();
        if($request->email == null && $request->password != null ){
          
  
          $admin->update([
           'password'=>$request->password
          ]);
        
       return response()->json([
            "status" => 1,
            "message" => "password Changed"
        ]);
      }
        else if($request->email != null && $request->password == null ){
          $admin->update([
           'email'=>$request->email
          ]);
        
          return response()->json([
            "status" => 1,
            "message" => "email Changed"
        ]); 
      }
      else{
          $admin->update([
              'name'=>$request->name
             ]);
            return response()->json([
              "status" => 1,
              "message" => "Name Changed"
          ]); 
      }
  }
  else{
    return response()->json([
      "status" => 0,
      "message" => "You Arenot Authenticated",
      
  ]);
  }



    }



    public function addMyPhoto(Request $request){
      if(auth()->guard('admin')->check()){
        //validate image
        $this->$request->validate([
          'image'=>'mimes:png,jpg,jpeg'
        ]);

        $file = $request->file('image');
        $name = time();
        $extension = $file->extension();
        $fileName = $name.'.'.$extension;
        $file->move('ImagesAdmins',$fileName);
        
        
        // create image for this user
        $admin= Admin::create([
          'image'=>$fileName,
        ]);
        
      }else{
        return response()->json([
            'message'=>'you arenot authenticated',
            'status'=> 0 ,
  
        ]);
    }
    
    }
      public function deleteMyPhoto(){
        if(auth()->check()){
  
          $admin_id= admin::where('id',auth()->guard('admin')->user()->id)->first();
          // check this admin 
          if($admin_id) {
          $admin_id->image = null;
          $admin_id->save();
        }
  
        }else{
          return response()->json([
              'message'=>'you arenot authenticated',
              'status'=> 0 ,
  
          ]);
      }
      
    }
}
