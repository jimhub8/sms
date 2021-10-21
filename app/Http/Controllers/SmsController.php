<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sms(Request$request)
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required'
        ]);
        $sms = new Sms();

        // $sms->sms_sandbox($request->phone, $request->message);
        $sms->sms($request->phone, $request->message);
        return $sms;
    }
}
