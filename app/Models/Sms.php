<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;

class Sms extends Model
{
    public function sms($phone, $message)
    {
        // dd($phone);
        // $phone = '+254731090832';
        // $phone = '254711379383';
        // $username = 'sandbox'; // use 'sandbox' for development in the test environment
        // $apiKey   = 'f40e36a71eb3081324cdd6f6dbb9195d2ff72f7a80fca78a3fbb5e988b15304b'; // use your sandbox app API key for development in the test environment

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

    public function sms_sandbox($phone, $message)
    {
        // dd($phone);
        $phone = '+254731090832';
        $username = 'sandbox'; // use 'sandbox' for development in the test environment
        $apiKey   = 'f40e36a71eb3081324cdd6f6dbb9195d2ff72f7a80fca78a3fbb5e988b15304b'; // use your sandbox app API key for development in the test environment

        // $username = 'speedball'; // use 'sandbox' for development in the test environment
        // $apiKey   = '5c89888737070cd26f873a41cd8ca9fd99402a4cd2c066d0eb75fd406a4de358'; // Live

        $AT       = new AfricasTalking($username, $apiKey);
        // Get one of the services
        $sms      = $AT->sms();
        // Use the service
        $result   = $sms->send([
            'enqueue' => true,
            // 'from'    => 'Speedball',
            'to'      => $phone,
            'message' => $message
        ]);
        return $result;
        // print_r($result);
    }
}


