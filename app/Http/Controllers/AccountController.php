<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
    public function index()
    {
        $orders = request()->user()->orders()->latest()->get();

        return view('storefront.account', compact('orders'));
    }
}
