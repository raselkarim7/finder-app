<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Auth\User;

class AuthController extends Controller
{
    function login(Request $request) {

        // dd($request->all());

        $mobile = $request->mobile;
        $password = $request->password;
        $user = User::where('mobile', $mobile)->find();
        dd($user);

        return $user;
    }

    function signup(Request $request) {
        // dd($request->all());

        $validator  = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'mobile' => array(
                'required',
                'unique:users',
                'regex:/^(?:\+88|88|01)?(?:\d{11}|\d{13})$/u'

            ),
            'company_name' => 'required',
            'company_address' => 'required',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        }

        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->company_name = $request->company_name;
        $user->company_address = $request->company_address;
        $user->password = Hash::make( $request->password );
        $user->save();

        return [
            'code' => 200,
            'message' => 'SignUp Successful',
            'data' =>  [
              'user' => $user
            ]
        ];

    }
}
