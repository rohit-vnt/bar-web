<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class Api extends Controller
{
    //
    public function register(Request $request){
        $data=$request->validate(
        [
            'name'=>'required|string',
            'mobile'=>'required|string|unique:users',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password'=>'required|string|same:password',
        ]);
        $data['password']=bcrypt($data['password']);
        $data['type']=1; // type admin
        $admin=new User($data);
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
    public function login(Request $request){
        $request->validate([
            'mobile'=>'required|string',
            'password'=>'required|string',
        ]);
        $user = User::where('mobile', $request->mobile)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=>'Unauthorized',
                'type'=>'failed'
                ]);
        }else{
            $token=$user->createToken('token')->plainTextToken;
            return response()->json([
                'user'=>$user,
                'token'=>$token
                ]);
        }

       
    }
}
