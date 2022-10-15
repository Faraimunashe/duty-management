<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $cart = Cart::all();
        return view('user.payments', [
            'cart' => $cart
        ]);
    }

    public function add_vehicle(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'numeric'],
            'make' => ['required'],
            'model' => ['required'],
            'engine_number' => ['required', 'string'],
            'date_manufactured' => ['required', 'date'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric']
        ]);

        try{
            $veh = new Vehicle();
            $veh->category_id = $request->category_id;
            $veh->make = $request->make;
            $veh->model = $request->model;
            $veh->engine_number = $request->engine_number;
            $veh->date_manufactured = $request->date_manufactured;
            $veh->quantity = $request->quantity;
            $veh->price = money($request->price);

            $veh->save();

            $cart = new Cart();
            $cart->vehicle_id = $veh->id;
            $cart->price = money($request->price * $request->quantity);
            $cart->rate = get_duty_rate();
            $cart->qty = $request->quantity;
            $cart->save();
            return redirect()->back()->with('success', 'You have successfully added vehicle');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }
}
