<?php

namespace App\Http\Controllers;

use App\Models\IncomingCall;
use App\Models\User;
use App\Models\Voice;
use App\User as AppUser;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;

class IncomingCallController extends Controller
{
    public function index()
    {
        return IncomingCall::all();
    }

    public function store(Request $request)
    {
        $data = Voice::find(15);
        $call = new IncomingCall();
        $call->create(unserialize($data->api_data));
        // $call->create($request->all());

        return $call;
    }
}
