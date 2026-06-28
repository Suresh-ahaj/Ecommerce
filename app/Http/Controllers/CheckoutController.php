<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }

      public function sucess(){
        return view('frontend.checkout.sucess');
    }

        public function cancel(){
        return view('frontend.checkout.cancel');
    }

}
