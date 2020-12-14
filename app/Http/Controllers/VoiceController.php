<?php

namespace App\Http\Controllers;

use App\Models\Voice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Jwt\ClientToken;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class VoiceController extends Controller
{
    public function __construct()
    {
        // Twilio credentials
        $this->account_sid = env('ACCOUNT_SID');
        $this->auth_token = env('AUTH_TOKEN');
        //the twilio number you purchased
        $this->from = env('TWILIO_PHONE_NUMBER');
        $this->app_sid = env('TWILIO_APPLICATION_SID');

        // Initialize the Programmable Voice API
        $this->client = new Client($this->account_sid, $this->auth_token);
    }



    public function initiateCall(Request $request)
    {
        // return $request->all();
        $call = new Voice();
        $call->call($request->phone);
    }


    /**
     * Making an outgoing call
     */
    public function initiateCall_twilio(Request $request)
    {
        // return $request->all();
        //     curl -X POST 'https://api.twilio.com/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages.json'
        // —data-urlencode 'To=+16501231234'
        // —data-urlencode 'From=+16502223333'
        // —data-urlencode 'Body=Hello there'
        // -u ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX:your_auth_token


        // return ;
        // Validate form input
        // return $request->all();
        // $this->validate($request, [
        //     'phone_number' => 'required|string',
        // ]);

        try {
            // dd('swdw');
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
                dd ($call);


                // $call = $this->client->account->calls->create(
                //     $request->phone_number, // Destination phone number
                //     $this->from, // Valid Twilio phone number
                //     array(
                //         "url" => "http://demo.twilio.com/docs/voice.xml"
                //     )
                // );
                // return $call->sid;

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


    public function hangup()
    {
        $response = new VoiceResponse();
        // $response->say("Your Laravel test pin is: $pin.");
        // $response->say("GoodBye!");
        $response->hangup();
        return $response;
    }

    public function voice_data()
    {
        // $voice =  Voice::latest()->first('api_data');
        // return unserialize($voice->api_data);
        $voices = Voice::all();
        $voices->transform(function ($voice) {
            $voice->api_data = unserialize($voice->api_data);
            return $voice;
        });
        return $voices;
    }

    public function incoming()
    {
        $response = new Services_Twilio_Twiml;

        $response->dial(array(
            'callerId' => '+15017122661'
        ))->number($number);


        $incoming_phone_number = $this->client->incomingPhoneNumbers
            ->create([
                "phoneNumber" => $this->from,
                "voiceUrl" => "http://demo.twilio.com/docs/voice.xml"
            ]);

        print($incoming_phone_number);
    }


    public function twilio_token()
    {
        $accountSid = $this->account_sid;
        $authToken  = $this->auth_token;
        $appSid = $this->app_sid;

        $capability = new ClientToken($accountSid, $authToken);
        $capability->allowClientOutgoing($appSid);
        $token = $capability->generateToken();

        return $token;
    }

    public function dial_call(Request $request)
    {
        $response = new VoiceResponse();
        $callerIdNumber = config('services.twilio')['number'];

        $dial = $response->dial(null, ['callerId' => $callerIdNumber]);
        $phoneNumberToDial = '+254731090832';

        if ($phoneNumberToDial) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

        return $response;
    }

    public function dial_call__()
    {
        $response = new VoiceResponse;
        $phone = '+254731090832';

        // get the phone number from the page request parameters, if given
        // if (isset($_REQUEST['To'])) {
        // $number = htmlspecialchars($_REQUEST['To']);
        // $response->dial(
        //     '+15005550006'
        // )->number($phone);
        // } else {
            $response->say("Thanks for calling!");
        // }

        Log::debug($response);
        return $response;
    }
}
