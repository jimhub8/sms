<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Call extends Model
{
    use HasFactory;


    public function make_call($phone)
    {

        try {
            //Lookup phone number to make sure it is valid before initiating call
            //   $phone_number = $this->client->lookups->v1->phoneNumbers($request->phone_number)->fetch();
            $phone_number = '+254731090832';
            // $phone_number = $request->phone_number;

            // dd( $this->client);
            // If phone number is valid and exists
            if ($phone_number) {
                // Initiate call and record call
                $call = $this->client->calls->create(
                    $phone_number,
                    $this->from,
                    [
                        "method" => "GET",
                        "statusCallback" => "https://ecbf4da9f6c5.ngrok.io/api/twilio_call",
                        "statusCallbackMethod" => "POST",
                        "statusCallbackEvent" => ["initiated","answered"],
                        "url" => "http://demo.twilio.com/docs/voice.xml"
                    ]
                    // array("url" => "http://demo.twilio.com/docs/voice.xml")
                    // [
                    //     "twiml" => "<Response><Say>Ahoy there!</Say></Response>"
                    // ]
                );
                $voice = new Voice();
                $voice->api_data = serialize($call);
                $voice->save();
                Log::debug($call);
                if ($call) {

                    return response(['status' => 'success', 'message' => 'Call connected'], 200);
                    // return 'Call Connected!';

                    // echo 'Call initiated successfully';
                } else {
                    return response(['status' => 'failed', 'message' => 'Call connected'], 402);
                    // return 'Call failed!';
                }
            }
        } catch (Exception $e) {
            return response(['status' => 'failed', 'message' => $e->getMessage()], 402);
            // echo 'Error: ' . $e->getMessage();
        }
    }
}
