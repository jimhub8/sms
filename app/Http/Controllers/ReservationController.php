<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;

class ReservationController extends Controller
{
    public function store(Request $request, Reservation $reservation)
    {
        $response = new VoiceResponse();

        $reservation->update([
            'payment_confirmation' => $request['PaymentConfirmationCode']
        ]);

        $response->say('Thank you for your payment!');

        echo $response;
    }
}
