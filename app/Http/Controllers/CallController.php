<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function call(Request $request)
    {
        $call = new Call();
        $call->make_call($request->phone_number);
        return $call;
    }
}
