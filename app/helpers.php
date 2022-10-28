<?php

//use DB;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Duty;
use App\Models\DutyItem;
use App\Models\Rate;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

function get_user_role($id){
    $role =  DB::table('roles')->where('id', $id)->first();
    return $role->display_name;
}

function get_duty_rate(){
    $rate = Rate::first();
    if(is_null($rate)){
        return 0;
    }
    return $rate->percentage_rate;
}

function get_vehicle_categories(){
    return Category::all();
}

function get_vehicle_category($id){
    return Category::find($id);
}

function get_vehicle($id){
    return Vehicle::find($id);
}

function count_users(){
    return User::count();
}

function count_duty(){
    return Duty::count();
}

function count_duty_today(){
    return Duty::whereDate('created_at', Carbon::today())->count();
}

function calculate_duty($total_price, $rate){
    return $total_price * ($rate/100);
}

function money($number)
{
    return number_format((float)$number, 2, '.', '');
}

function get_vehicle_price($id){
    $vehicle = Vehicle::find($id);
    if(is_null($vehicle)){
        return 0;
    }

    return $vehicle->price;
}

function record_duty($total, $rate, $user){
    try{
        $duty = new Duty();
        $duty->reference = rand(111111, 999999);
        $duty->percentage_rate = $rate;
        $duty->total = $total;
        $duty->user_id = $user;
        $duty->save();

        foreach(Cart::all() as $cart){
            $item = new DutyItem();
            $item->duty_id = $duty->id;
            $item->vehicle_id = $cart->vehicle_id;
            $item->qty = $cart->qty;
            $item->unit_price = get_vehicle_price($cart->vehicle_id);
            $item->total_price = $cart->price;
            $item->save();
        }
        return true;
    }catch(Exception $e){
        //dd($e->getMessage());
        return false;
    }
}

function count_vehicle($duty_id){
    $count = 0;

    $items = DutyItem::where('duty_id', $duty_id)->get();
    if($items->isEmpty())
    {
        return $count;
    }
    foreach($items as $item)
    {
        $count = $count + $item->qty;
    }

    return $count;

}

function get_user($user_id){
    $user = User::find($user_id);
    if(is_null($user)){
        return 'unknown';
    }
    return $user->name;
}

function get_duty_items($duty_id){
    return DutyItem::where('duty_id', $duty_id)->get();
}

function get_daily_revenue($date)
{
    $revenue = 0.0;
    $data = Duty::whereDate('created_at', $date)->get();
    foreach($data as $item)
    {
        $revenue = $revenue + $item->total;
    }

    return $revenue;
}
