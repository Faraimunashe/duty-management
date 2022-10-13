<?php

//use DB;

use Illuminate\Support\Facades\DB;

function get_user_role($id){
    $role =  DB::table('roles')->where('id', $id)->first();
    return $role->display_name;
}
