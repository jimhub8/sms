<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomingCall;
use App\Models\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoiceApiController extends Controller
{
    public function callback(Request $request)
    {
        // Log::useFiles(storage_path().'/logs/africastalking.log');

        Log::info('******************************');
        Log::info($request->all());
        Log::info('******************************');


        // This is a unique ID generated for this call
        $sessionId = $request->sessionId;

        // Check to see whether this call is active
        $isActive  = $request->isActive;

        if ($isActive == 1) {
            // Read in the caller's number. The format will contain the + in the beginning
            $callerNumber = $request->callerNumber;

            // You can replace this array with an actual database table

            // Read the caller's information from the database if necessary
            $text    = "Hello Jimmy. Thank you for calling again";


            if ($isActive == 1) {
                // Forward by dialing customer service numbers and record the conversation
                // $callerNumber = $_POST['callerNumber'];
                // Compose the response
                $response  = '<?xml version="1.0" encoding="UTF-8"?>';
                $response .= '<Response>';
                $response .= '<Dial record="false" sequential="true" phoneNumbers="' . $callerNumber . '"/>';
                $response .= '</Response>';
            }
            // Compose the response
            // Print the response onto the page so that our gateway can read it
            header('Content-type: text/plain');
            echo $response;
        } else {
            // Read in call details (duration, cost). This flag is set once the call is completed.
            // Note that the gateway does not expect a response in thie case
            $text    = "ooops Jimmy";

            $duration     = $request->durationInSeconds;
            $currencyCode = $request->currencyCode;
            $amount       = $request->amount;

            // You can then store this information in the database for your records
        }
    }
    public function event(Request $request)
    {
        // Log::useFiles(storage_path().'/logs/africastalking.log');
        // Log::info('¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬`');
        // Log::info($request->all());
        // Log::info('¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬`');

        $incomming = new IncomingCall();

        $incomming->name = $request->incomming;
        $incomming->phone = $request->incomming;
        $incomming->duration = $request->incomming;
        $incomming->agent = $request->incomming;
        $incomming->from = $request->incomming;
        $incomming->to = $request->incomming;
        $incomming->country_from = $request->incomming;
        $incomming->country_to = $request->incomming;
        $incomming->direction = $request->incomming;
        $incomming->CallSid = $request->incomming;
    }

    public function twilio_call(Request $request)
    {
        Log::info('¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬`');
        Log::info($request->all());
        Log::info('¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬`');

        $voice = new Voice();
        $voice->api_data = serialize($request->all());
        $voice->save();


        $call = new IncomingCall();
        $call->create($request->all());
        // $call->create($request->all());

        return $call;
    }
}

