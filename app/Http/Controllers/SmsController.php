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
            // 'message' => 'required'
        ]);
        $sms = new Sms();
        $phone = preg_split("/[\r\n,]+/", $request->phone, -1, PREG_SPLIT_NO_EMPTY);

        // $phone = explode(',', $request->phone);

        // $sms->sms_sandbox($phone, $request->message);
        $sms->sms($phone, $request->message, $request->org);
        return $sms;
    }
}
