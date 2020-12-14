<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\User as AppUser;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;

class ProcessIVRDigitsController extends Controller
{

    public function __invoke(Request $request)
    {
        $user = AppUser::whereCellPhone($request['From'])->first();

        $reservation = $user->getLatestReservation();

        $response = new VoiceResponse();

        switch ($request['Digits']) {
            case 1:
                $reservation->delete();
                $response->say('Your reservation has been canceled. Have a great day!');
                break;
            case 2:
                $response->pay([
                    'charge_amount' => $reservation->dollar_amount,
                    'action' => secure_url('/twilio/incoming/payment', $reservation )

                ]);
                break;
            default:
                $response->say("Sorry, {$user->first_name}. You can only press 1 to cancel your reservation, or 2 to pay for your reservation.");
                break;
        }

        echo $response;
    }
}
