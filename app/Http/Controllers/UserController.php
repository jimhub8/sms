<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = User::first();
        // $password = Str::random(8);
        // Mail::send(new UserMail($user, $password));
        // // $user->roles()->sync($request->roles);
        // return $user;
        $this->Validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ]);
        $password = Str::random(8);
        $data = $request->all();
        $data['password'] = Hash::make($password);

        $user = User::create($data);
        Mail::send(new UserMail($user, $password));
        // $user->roles()->sync($request->roles);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->Validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'role' => 'required',
        // ]);
        $data = $request->all();

        $user = User::find($id)->update($data);
        // $user->roles()->sync($request->roles);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
