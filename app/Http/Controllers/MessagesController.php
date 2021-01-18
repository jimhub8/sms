<?php

namespace App\Http\Controllers;

use App\Imports\MessageImport;
use App\Models\Messages;
use App\Models\Sms;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Messages::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        Excel::import(new MessageImport, $request->file);
        return 'uploaded';
    }

    public function messages_send()
    {
        $messages = Messages::all();

        foreach ($messages as $message) {
            $sms = new Sms();
            $message_ = 'Dear ' . $message->name  . ' We trust you are good. This is to register our utmost apology for not making your delivery today for the order you placed online for Electric vacuum foot cleaner. This is as a result of flight delay from Dubai hence goods are expected to arrive by Thursday, 21/01/2021. We therefore request to make your delivery between Friday, 22/01/2021 to Monday, 25/01/2020. Thank you.';
            // $sms->sms($message->phone, $message_);
        }
        return;
    }
}
