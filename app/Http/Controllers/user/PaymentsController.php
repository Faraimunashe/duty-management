<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $cart = [];
        return view('user.payments', [
            'cart' => $cart
        ]);
    }
}
