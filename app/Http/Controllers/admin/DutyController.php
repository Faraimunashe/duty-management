<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Duty;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
}
