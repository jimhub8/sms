<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Agent::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $this->Validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:agents',
            'role' => 'required',
        ]);
        // return $data;
        return Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'town' => $request->town,
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
