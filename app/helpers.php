<?php

//use DB;

use App\Models\Rate;
use Illuminate\Support\Facades\DB;

function get_user_role($id){
    $role =  DB::table('roles')->where('id', $id)->first();
    return $role->display_name;
}

function get_duty_rate(){
    $rate = Rate::first();

    return $rate;
}
