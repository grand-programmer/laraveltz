<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        //$data=$request->only(['name','email','password']);
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required'
        ]);
        if($validator->fails())  return response()->json([
            'type' => 'error',
            'message' => 'Error in Add User',
            'error' => $validator->errors(),
        ]);
        $data=$request->only(['name','email','password']);
        $data['password']=Hash::make($data['password']);
        $user = User::create($data);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);

    }
    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
