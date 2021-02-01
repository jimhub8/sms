<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Mail\AgentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'town' => 'required',
        ]);

        $password = Str::random(8);
        // return $data;
        $agent = Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'town' => $request->town,
            'password' => Hash::make($password),
        ]);

        // $agent = Agent::first();

        Mail::send(new AgentMail($agent, $password));
        return $agent;
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
        Agent::find($id)->update($request->all());
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
