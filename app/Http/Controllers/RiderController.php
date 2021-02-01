<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // return Rider::create($request->all());

        $this->Validate($request, [
            'date' => 'required',
            'rider' => 'required',
            'total_orders' => 'required',
            'delivered' => 'required',
            'returned' => 'required',
            'total_orders' => 'required'
        ]);

        return Rider::updateOrCreate(
            [
                'date' => Carbon::parse($request->date),
                'rider' => $request->rider
            ],
            [
                'delivered' => $request->delivered,
                'returned' => $request->returned,
                'total_orders' => $request->total_orders,
                'comment' => $request->comment
            ]

        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function rider_filter(Request $request)
    {
        $this->Validate($request, [
            'rider' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        // return $request->all();
        $start_date = Carbon::parse($request->start_date)->format('y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('y-m-d');
        $report = Rider::whereBetween('date', [$start_date, $end_date])->where('rider', $request->rider)->get();
        if(count($report) > 0) {
            return $report;
        } else{
            abort(404, 'No data found');
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rider $rider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        //
    }

    public function export(Request $request)
    {
        // return $request->all();
        // return $request->start_date;
        // return $dateStarted = new \DateTime($request->start_date);


        // return $start_date = Carbon::parse($request->start_date);
        // $end_date = Carbon::parse($request->end_date)->format('y-m-d');
        $report = Rider::whereBetween('date', [$request->start_date, $request->end_date])->where('rider', $request->rider)->get();


        // $date_array = explode(' : ', $request->date);
        // $report = Rider::where('rider', $request->client)->where('start_date', $date_array[0])->where('end_date', $date_array[1])->first();
        $pdf = PDF::loadView('pdf.riders', array('report' => $report, 'request_data' => $request->all()));
        return $pdf->stream();
    }
}
