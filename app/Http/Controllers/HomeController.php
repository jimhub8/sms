<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('sms');
    }
    public function portal()
    {
        $user = Auth::user();
        return view('welcome', compact('user'));
    }

    public function waybill(Request $request)
    {


        // dd('track');

        // return $request->all();
        $waybill = $request->waybill;
        $org = $request->org;
        // $org = 'speedball';

        // $waybill = [];
        //     return view('track', compact('waybill'));
        try {
            $client = new Client();
            if ($org == 'speedball') {
                $url = env('API_URL_SPEEDBALL') . '/order/' . $waybill;
            } elseif ($org == 'mft') {
                $url = env('API_URL_MFT') . '/order/' . $waybill;
            } elseif ($org == '360') {
                $url = env('API_URL_360') . '/order/' . $waybill;
            }
            // return $url;
            // $URI = 'http://mail.zoho.com/api/accounts/' . $AccountId . '/messages';
            $params['headers'] = ['Content-Type' => 'application/json'];
            // $params['form_params'] = array('fromAddress' => $FromAddress, 'toAddress' => $ToAddress, 'subject' => $Subject, 'content' => $Content);
            $response = $client->get($url);
            // dd($response);

            $waybill = json_decode($response->getBody(), true);

            // dd($waybill);

            // $waybill = $waybill['waybillTrackDetailList'][0];
            return $waybill;

            return view('track', compact(['waybill', 'org']));
        } catch (\Exception $e) {
            // dd($e);

            abort(404, $e->getMessage());
            return $e->getMessage();
        }

        // $waybill = $request->waybill;
        // $waybill =



        return view('track', compact(['waybill', 'org']));
    }


    public function track(Request $request)
    {
        $org = $request->org;
        $tracking_no = $request->tracking_no;
        return view('track', compact('org', 'tracking_no'));
    }
    public function speedball_track(Request $request)
    {
        $org = $request->org;
        $tracking_no = $request->tracking_no;
        return view('track_2', compact('org', 'tracking_no'));
    }
}


