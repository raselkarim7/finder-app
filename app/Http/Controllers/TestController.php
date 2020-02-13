<?php

namespace App\Http\Controllers;

use App\OfferType;
use App\Otp;
use App\PricingPackage;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{

    public function __construct()
    {
//        $this->middleware('jwt', ['except' => ['test1']]);
    }
    public function test() {


//        $role = new Role();
//        $role->title = 'Admin';
//        $role->name = 'admin';
//        $role->save();
//
//        $role = new Role();
//        $role->title = 'Merchant';
//        $role->name = 'merchant';
//        $role->save();
//
//        $role = new Role();
//        $role->title = 'Customer';
//        $role->name = 'customer';
//        $role->save();



        $user = New User();
        $user->name = 'Rasel';
        $user->mobile = '0172365354';
        $user->email = '';
        $user->company_name = 'RTC';
        $user->company_address = 'Uttara';
        $user->password = Hash::make(123456);
        if ($user->save()){
            $user->Roles()->attach('5e44f2ebf2c1040e1000624b'); // 5e44f2ebf2c1040e1000624b = merchant
            $otp = new Otp();
            $otp->mobile = $user->mobile;
            $otp->code = rand(1000,9999);
            $otp->user_id = $user->id;
            if ($otp->save()){
                //send otp code to mobile
            }
            return User::with('Roles','Otps')->find($user->id);
        }



//        $pp = new PricingPackage();
//        $pp->title = 'Free';
//        $pp->duration = 2;
//        $pp->price = 0;
//        $pp->save();
//
//
//        $ot = new OfferType();
//        $ot->title = 'All Time';
//        $ot->type = 'percentage';
//        $ot->save();
//        $ot = new OfferType();
//        $ot->title = 'Upto';
//        $ot->type = 'percentage';
//        $ot->save();
//        $ot = new OfferType();
//        $ot->title = 'Fixed';
//        $ot->type = 'fixed';
//        $ot->save();
//
//        return ['pp' => $pp, 'ot' => $ot];
    }
}
