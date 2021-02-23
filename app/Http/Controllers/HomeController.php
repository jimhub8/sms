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

    public function waybill(Request $request, $waybill)
    {
        $org = $request->org;
        // $waybill = [];
        //     return view('track', compact('waybill'));
            try {

            $client = new Client();

            $url = 'http://webservice.logixerp.com/webservice/v2/MultipleWaybillTracking?SecureKey=D2AEC5FC91C7408DBB15DFD59D519DAB&WaybillNumber=' . $waybill;
            // $URI = 'http://mail.zoho.com/api/accounts/' . $AccountId . '/messages';
            $params['headers'] = ['Content-Type' => 'application/json'];
            // $params['form_params'] = array('fromAddress' => $FromAddress, 'toAddress' => $ToAddress, 'subject' => $Subject, 'content' => $Content);
            $response = $client->post($url, $params);

            $waybill = json_decode($response->getBody(), true);

            $waybill = $waybill['waybillTrackDetailList'][0];
            // return $waybill;

            return view('track', compact(['waybill', 'org']));

        } catch (\Exception $e) {
            // dd($e);

            abort(404, 'Something went wrong! Please try later');
            return $e->getMessage();
        }

        // $waybill = $request->waybill;
        // $waybill =
    }
}
