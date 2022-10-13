<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->get();

        return view('admin.users',[
            'users' => $users
        ]);

    }

    public function remove($id)
    {
        try{
            $user = User::find($id);

            $user->delete();

            return redirect()->back()->with('success', 'You have successfully deleted user.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }
}
