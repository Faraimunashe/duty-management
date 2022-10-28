<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DutyItem;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function imported()
    {
        $vehicles = DutyItem::all();
        return view('admin.imported-vehicles', [
            'vehicles' => $vehicles
        ]);
    }
}
