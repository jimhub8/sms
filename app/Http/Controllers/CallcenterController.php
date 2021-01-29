<?php

namespace App\Http\Controllers;

use App\Exports\CallcentreExpo;
use App\Models\Callcenter;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CallcenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = Callcenter::distinct()->latest()->take(20)->get(['start_date', 'end_date']);

        $date_array = [];

        foreach ($dates as $value) {
            $date_array[] = $value['start_date'] . ' : ' . $value['end_date'];
            // $date_array[] = Carbon::parse($value['start_date'])->format('y-m-d') .' : '. Carbon::parse($value['end_date'])->format('y-m-d');
        }
        return $date_array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $this->Validate($request, [
            'client' => 'required',
            'total_orders' => 'required'
        ]);


        // $request->start_date = Carbon::parse($request->start_date);
        // $request->end_date = Carbon::parse($request->end_date);
        // return $request->all();

        // return Callcenter::create($request->all());

        return Callcenter::updateOrCreate(
            [
                // 'start_date' => $request->start_date,
                'report_date' => Carbon::parse($request->report_date),
                'client' => $request->client
            ],
            [
                'total_orders' => $request->total_orders,
                'comment' => $request->comment,
                'data' => $request->data
            ]

        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Callcenter  $callcenter
     * @return \Illuminate\Http\Response
     */
    public function show(Callcenter $callcenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Callcenter  $callcenter
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        // return $request->all();

        // $date_array = explode(' : ', $request->date);

        $date = $request->date;
        // $end_date = $request->end_date;

        $report = Callcenter::where('client', $request->client)->where('report_date', $date)->get();
        if (count($report) > 0) {
            return $report[0];
        } else {
            return [];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Callcenter  $callcenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Callcenter $callcenter)
    {
        //
    }

    public function export(Request $request)
    {
        $date_array = explode(' : ', $request->date);
        $report = Callcenter::where('client', $request->client)->where('start_date', $date_array[0])->where('end_date', $date_array[1])->first();
        $pdf = PDF::loadView('pdf.callcenter', array('report' => $report));
        return $pdf->stream();
    }
}
