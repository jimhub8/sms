<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;

class Sms extends Model
{
    public function sms($phone, $message)
    {
        // $phone = '+254731090832';
        // $phone = '254711379383';
        // $username = 'sandbox'; // use 'sandbox' for development in the test environment
        // $apiKey   = '05998e3687d028994e47a6b10ad8fdc8a8fd006a32814a1daf6483b70ba0fea7'; // use your sandbox app API key for development in the test environment

        $username = 'speedball'; // use 'sandbox' for development in the test environment
        $apiKey   = '5c89888737070cd26f873a41cd8ca9fd99402a4cd2c066d0eb75fd406a4de358'; // Live

        $AT       = new AfricasTalking($username, $apiKey);
        // Get one of the services
        $sms      = $AT->sms();
        // Use the service
        $result   = $sms->send([
            'enqueue' => true,
            'from'    => 'Speedball',
            'to'      => $phone,
            'message' => $message
        ]);
        return $result;
        // print_r($result);
    }
}


