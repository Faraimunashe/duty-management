<?php

//use DB;

use App\Models\Category;
use App\Models\Duty;
use App\Models\Rate;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
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
