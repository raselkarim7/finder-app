<?php

namespace App\Http\Controllers;

use App\Otp;
use Jenssegers\Mongodb\Auth\User;
use Illuminate\Http\Request;

class OtpController extends Controller
{


    public function verify(Request $request)
    {
        $otp = Otp::where('mobile',$request->mobile)->where('code', $request->code)->where('isUsed',0)->first();
        if ($otp !== null) {
            $user = User::where('mobile', $request->mobile)->first();
            $token = auth()->login($user);
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

    }

}
