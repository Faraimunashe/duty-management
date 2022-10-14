<?php

//use DB;

use App\Models\Category;
use App\Models\Rate;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

function get_user_role($id){
    $role =  DB::table('roles')->where('id', $id)->first();
    return $role->display_name;
}

function get_duty_rate(){
    $rate = Rate::first();

    return $rate;
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
