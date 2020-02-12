<?php

namespace App\Http\Controllers;

use App\OfferType;
use App\PricingPackage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test() {
        $user = New User();
        $user->name = 'Rasel';
        $user->mobile = '+880172365354';
        $user->company_name = 'RTC';
        $user->company_address = 'Uttara';
        $user->password = Hash::make(123456);
        $user->save();
        return $user;


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
