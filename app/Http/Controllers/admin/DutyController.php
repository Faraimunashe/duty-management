<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use App\Models\Rate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class DutyController extends Controller
{
    public function index()
    {
        $duties = Duty::all();

        return view('admin.duty', [
            'duties' => $duties
        ]);
    }

    public function download(Request $request)
    {
        $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date']
        ]);

        $data = Duty::whereDate('created_at', '>=', $request->from)->whereDate('created_at', '<=', $request->to)->get();

        //dd($data);
        if($data->isEmpty())
        {
            return redirect()->back()->with('error', 'No data matching your parameters');
        }
        $pdf = Pdf::loadView('pdf.duty', $data->toArray());
        return $pdf->download('duty_report_'.now().'.pdf');
    }

    public function update_rate(Request $request)
    {
        $request->validate([
            'rate' => ['required', 'numeric']
        ]);

        try{
            $rate = Rate::first();
            if(is_null($rate)){
                $new = new Rate();
                $new->percentage_rate = $request->rate;
                $new->save();

                return redirect()->back()->with('success', 'Successfully added duty rate!');
            }
            $rate->percentage_rate = $request->rate;
            $rate->save();

            return redirect()->back()->with('success', 'Successfully updated the duty rate!');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
