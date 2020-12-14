<?php

namespace App\Models;

use AfricasTalking\SDK\AfricasTalking;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;

class Voice_1 extends Model
{
    use HasFactory;

    public function call()
    {



        $username = 'speedball'; // use 'sandbox' for development in the test environment
        $apiKey   = env('AFRICAS_TALKING_KEY', '5efea01d1d6de55d9b17393ce689470dde30e32e765e07968c7e71dbf5980b45');

        // Specify your Africa's Talking Phone number
        $from = "+254711082259";

        // Specify the number that you want to call
        // Please ensure you include the country code (+254 for Kenya in this case)
        $to = "+254731090832";
        $data = [
            'username' => 'speedball',
            'to'      => $to,
            'from'    => $from
        ];

        try {
            $client = new GuzzleHttpClient();
            $request = $client->request('POST', 'https://voice.africastalking.com/call', [
                'headers' => [
                    'Content-type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'apiKey' => '5efea01d1d6de55d9b17393ce689470dde30e32e765e07968c7e71dbf5980b45',
                ],
                'body' => json_encode([
                    'username' => 'speedball',
                    'to'      => $to,
                    'from'    => $from
                ])
            ]);
            return 'dwdwdw';
            // $response = $http->get(env('API_URL').'/api/getUsers');
            return $response = $request->getBody()->getContents();
            // dd($response);
        } catch (\Exception $e) {
            dd($e);

            \Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            $code = $e->getResponse()->getStatusCode();
            if ($code == 401) {
                abort(401);
            }
            return $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile();
        }



        // Create a new instance of our awesome gateway class
        $gateway = new AfricasTalking($username, $apiKey);
        // $gateway  = new AfricaStalkingGateway($username, $apiKey);

        // Thats it, make the call and we'll take care of the rest
        if ($gateway->voice($from, $to)) {
            // Call was made, time for song and dance
            echo "Success";
        } else {
            echo "Oops, The call could not be made. Error: " . $gateway->getErrorMessage();
        }

        return;





        $url = 'https://voice.sandbox.africastalking.com/call';

        $phone = '+254799999999';
        $recepient = '+254731090832';

        $username = 'sandbox'; // use 'sandbox' for development in the test environment
        $apiKey   = env('AFRICAS_TALKING_KEY', 'fb7adb9275127c1b0c416da3c6c68cf0a79df7d923e4df9cab1aa3554a573e94');
        $AT       = new AfricasTalking($username, $apiKey);
        $voice = $AT->voice();
        $result   = $voice->call([
            // 'enqueue' => true,
            'from'    => $phone,
            'to'      => $recepient,
            'url'    => $url
        ]);
        print_r($result);
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
