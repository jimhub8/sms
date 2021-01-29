<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stock::with('agent')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('agent')->check()) {
            $stock_date = Carbon::parse($request->stock_date)->format('yy-m-d');
            // return $request->all();
            // return Stock::create($request->all());

            $stock_exists = Stock::where('stock_date', $stock_date)->where('agent_id', 1)->exists();
            if ($stock_exists) {
                abort(403, "You already updated today's stock");
            }
            return Stock::updateOrCreate(
                [
                    'stock_date' => $stock_date,
                    'agent_id' => 1
                ],
                [
                    'closing_stock' => $request->closing_stock,
                    'delivered' => $request->delivered,
                    'opening_stock' => $request->opening_stock,
                    'received' => $request->received,
                    'returned' => $request->returned,
                ]
            );
        } else {
                abort(403, "Please log in as an agent");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function opening_stock($id)
    {
        $stock = Stock::where('agent_id', 1)->first('closing_stock');

        if (!$stock) {
            $stock = new Stock;
            $stock->closing_stock = 0;
            // return $closing_stock = 0;
        }
        return $stock;
    }

    public function stock_filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        //  DB::connection()->enableQueryLog();

        $agent = Stock::with('agent');
        if ($request->agent_id) {
            $agent = $agent->where('agent_id', $request->agent_id);
        }
        if ($start_date && $end_date) {
            $agent = $agent->whereBetween('created_at', [$start_date, $end_date]);
        }
        return $agent->paginate(100);
        // dd(DB::getQueryLog());
    }
}
