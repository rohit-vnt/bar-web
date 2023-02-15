<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class Api extends Controller
{
    //
    public function register(Request $request){
        $data=$request->validate(
        [
            'name'=>'required|string',
            'mobile'=>'required|string|unique:admins',
            'email'=>'required|string|unique:admins',
            'password'=>'required|string',
            'c_password'=>'required|string|same:password',
        ]);
        $admin=new Admin($data);
        if($admin->save()){
            return response()->json([
                'message' => 'Admin registered',
                'type'=>'success'
              ], 201);
        }else{
            return response()->json([
                'message' => 'Oops! Operation failed',
                'type'=>'failed'
              ], 401);
        }
    }
}
