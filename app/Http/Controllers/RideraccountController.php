<?php

namespace App\Http\Controllers;

use App\Models\Rideraccount;
use Illuminate\Http\Request;

class RideraccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rideraccount::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Validate($request, [
            'name' => 'required|unique:rideraccounts',
        ]);
        return Rideraccount::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rideraccount  $rideraccount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rideraccount::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rideraccount  $rideraccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Rideraccount::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rideraccount  $rideraccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
