<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function index()
    {
        // $days = DB::table('duties')
        // ->select('created_at', DB::raw('COUNT(*) as total'))
        // ->whereDate('created_at', $date)
        // ->get();

        $dates = Duty::orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });

        //dd($dates);
        foreach($dates as $key => $items){
            $day = $key;
            $totalCount = $items->count();

        }

        return view('admin.revenue', [
            'dates' => $dates
        ]);
    }
}
