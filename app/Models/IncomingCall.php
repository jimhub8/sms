<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class IncomingCall extends Model
{
    use HasFactory;

    public function create($call_data)
    {
        $call = IncomingCall::where('to', $call_data['Called'])->first();
        if (!$call) {
            $call = new IncomingCall;
            $call->call_count += 1;
            $call->save();
            return $call;
        }

        $call->user_id = Auth::id();
        $call->name = '';
        $call->duration = $call_data['CallDuration'];
        // $call->agent = $call_dat;
        $call->from = $call_data['From'];
        $call->to = $call_data['Called'];
        $call->country_from = $call_data['FromCountry'];
        $call->country_to = $call_data['CalledCountry'];
        $call->direction = $call_data['Direction'];
        $call->CallSid = $call_data['CallSid'];
        $call->status = $call_data['CallStatus'];
        $call->call_count = 1;
        $call->followup = ($call_data['CallStatus'] == 'completed') ? false : true;
        $call->save();
        return $call;
    }
}
