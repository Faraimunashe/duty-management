<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Paynowlog;
use App\Models\Transaction;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function make_payment(Request $request)
    {
        $request->validate([
            'total' => ['required', 'numeric', 'min:5'],
            'phone' => ['required', 'digits:10', 'starts_with:07']
        ]);

        $wallet = "ecocash";

        //get all data ready
        $email = "jimmymotofire@gmail.com";
        $phone = $request->phone;
        $amount = $request->total;

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('user-make-payment'),
            route('user-make-payment'),
        );

        // Create Payments
        $invoice_name = "Zimboarder_Duty" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Vehicle Duty", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);
        //dd($response);
        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "license";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = 1;
                    $trans->save();
                    try{
                        $duty = record_duty($request->total, get_duty_rate(), Auth::id());
                        if($duty){
                            Cart::truncate();
                            return redirect()->back()->with('success', 'successfully paid');

                        }else{
                            return redirect()->back()->with('error', 'An error occured could not perform payment');
                        }
                    }catch(Exception $e){
                        return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
                    }

                    return redirect()->back()->with('success', 'Succesfully paid license fee');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    $trans_status = 2;
                    if($info['status'] != 'sent')
                    {
                        $trans_status = 0;
                    }
                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "license";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = $trans_status;
                    $trans->save();

                    return redirect()->back()->with('error', 'Taking too long wait a moment and refresh');
                } //endif
            } //endwhile
        } //endif

        //total fail
        return redirect()->back()->with('error', 'Cannot perform transaction at the moment');
    }

    public function clear_cart(Request $request)
    {
        try{
            Cart::truncate();
            return redirect()->back()->with('success', 'successfully cleared');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
