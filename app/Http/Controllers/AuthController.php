<?php

namespace App\Http\Controllers;


use App\Otp;
use App\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Auth\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }
    function login(Request $request) {

        $mobile = $request->mobile;
        $password = $request->password;
        $user = User::where('mobile', $mobile)->first();
        if ($user === null) {
            return 'Enter Correct mobile & password';
        }

        if (Hash::check($password,$user->password)) {
            $token = auth()->login($user);
            return $this->respondWithToken($token);
        }else{
            return [
                'code'=>400,
                'status'=>'error',
                'message' => 'Mobile or Password Incorrect'
            ];
        }

        return [
            'code'=>400,
            'status'=>'error',
            'message' => 'Something Wrong'
        ];
    }

    protected function respondWithToken($token)
    {
        return [
            'code'=>200,
            'status'=>'success',
            'message'=>'Login Success',
            'data'=> [
                'login'=>[
                    'token' => $token,
                    'token_type' => 'bearer',
                ]
            ]
        ];
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
            'email' => 'unique:users',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        }

        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->company_name = $request->company_name;
        $user->company_address = $request->company_address;
        $user->password = Hash::make( $request->password );
        if ($user->save()){
            $user->Roles()->attach('5e44f2ebf2c1040e1000624b'); // 5e44f2ebf2c1040e1000624b = merchant
            $otp = new Otp();
            $otp->mobile = $user->mobile;
            $otp->code = rand(1000,9999);
            $otp->user_id = $user->id;
            if ($otp->save()){
                //send otp code to mobile
            }
        }

        return [
            'code' => 200,
            'message' => 'SignUp Successful',
            'data' =>  [
              'user' => $user
            ]
        ];

    }
}
