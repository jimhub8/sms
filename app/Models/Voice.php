<?php

namespace App\Models;

use AfricasTalking\SDK\AfricasTalking;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;

class Voice extends Model
{
    use HasFactory;

    public function call($phone)
    {
        $username = 'speedball'; // use 'sandbox' for development in the test environment
        $apiKey   = '5c89888737070cd26f873a41cd8ca9fd99402a4cd2c066d0eb75fd406a4de358';
        // $apiKey   = env('AFRICAS_TALKING_KEY', '5efea01d1d6de55d9b17393ce689470dde30e32e765e07968c7e71dbf5980b45');

        // Specify your Africa's Talking Phone number
        $from = "+254711082259";

        // Specify the number that you want to call
        // Please ensure    you include the country code (+254 for Kenya in this case)
        $to = $phone;


        // Initialize the SDK
        $AT = new AfricasTalking($username, $apiKey);

        // dd($AT);

        // Get the voice service
        $voice    = $AT->voice();

        // Set your Africa's Talking phone number in international format

        // Set the numbers you want to call to in a comma-separated list

        try {
            // Make the call
            $results = $voice->call([
                'from' => $from,
                'to'   => $to
            ]);

            // dd($results);

            $sessionId = $_POST['sessionId'];
            // Check to see whether this call is active
            $isActive  = $_POST['isActive'];
            if ($isActive == 1) {
                // Forward by dialing customer service numbers and record the conversation
                // $callerNumber = $_POST['callerNumber'];
                // Compose the response
                $response  = '<?xml version="1.0" encoding="UTF-8"?>';
                $response .= '<Response>';
                $response .= '<Dial record="false" sequential="true" phoneNumbers="' . $phone . '"/>';
                $response .= '</Response>';
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function twilio_call()
    {
        $sid = 'SK845ee7a214412ddba45a4f8d8f93e866';
        $token = 'VozpgT7JEaziSVm5d8KUvPApgVPLMXWM';

        $client = new Client($sid, $token);
        try {
            $call = $client->calls->create(
                '+254731090832',
                // env('TWILIO_NUMBER'),
                '+14328887412',
                array('url' => 'https://demo.twilio.com/welcome/voice/')
            );
            dd("started calling: " . $call->id);
            echo "started calling: " . $call->id;
        } catch (Exception $e) {
            dd($e->getMessage());
            //throw $th;
        }
    }
}
