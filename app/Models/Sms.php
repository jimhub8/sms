<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;

class Sms extends Model
{
    public function sms($phone, $message, $org)
    {
        // dd($phone);
        // $phone = '+254731090832';
        // $phone = '254711379383';
        // $username = 'sandbox'; // use 'sandbox' for development in the test environment
        // $apiKey   = '60e3d1e55a2b10d0ebd403362dea375fcd71a49f7fa0d09799c4ecab13fbbec5'; // use your sandbox app API key for development in the test environment

        // Mft
        $phone = $this->clean($phone);
        if ($org == 'MFT') {
            $username = 'MFT'; // use 'sandbox' for development in the test environment
            $apiKey = 'f37b958fa9ad12a939eec4435141c9c8a3b48f1895840896c87c7aa72dee7612'; // Live
        } elseif ($org == 'Speedball') {
            $username = 'speedball'; // use 'sandbox' for development in the test environment
            $apiKey   = '5c89888737070cd26f873a41cd8ca9fd99402a4cd2c066d0eb75fd406a4de358'; // Live
        } else {
            return;
        }

        // dd($username, $apiKey);

        $AT = new AfricasTalking($username, $apiKey);
        // Get one of the services
        $sms = $AT->sms();
        // Use the service
        $result = $sms->send([
            // 'enqueue' => true,
            'from'    => $username,
            'to'      => $phone,
            'message' => $message
        ]);
        // return $result;
        print_r($result);
    }

    public function sms_sandbox($phone, $message)
    {
        $phone = $this->clean($phone);
        // dd($phone);
        $phone = '+254731090832';
        $username = 'sandbox'; // use 'sandbox' for development in the test environment
        $apiKey   = '60e3d1e55a2b10d0ebd403362dea375fcd71a49f7fa0d09799c4ecab13fbbec5'; // use your sandbox app API key for development in the test environment

        // $username = 'speedball'; // use 'sandbox' for development in the test environment
        // $apiKey   = '5c89888737070cd26f873a41cd8ca9fd99402a4cd2c066d0eb75fd406a4de358'; // Live

        $AT = new AfricasTalking($username, $apiKey);
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



    public function clean($phone_no)
    {
        // dd($phone);

        $phone_arr = [];
        foreach ($phone_no as $phone) {
            $string = str_replace(' ', '', $phone);

            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            $p_length = strlen($string);
            $str = (int)mb_substr($string, 0, 1);

            if ($p_length == 9 && $str == 7) {
                $phone_no = '254' . $string;
            } elseif ($p_length == 10 && $str == 0) {
                $str = substr($string, 1);
                $phone_no = '254' . $str;
            } else {
                $phone_no = $string;
            }

            $phone_arr[] = $phone_no;

        }

        return $phone_arr;
    }
}
