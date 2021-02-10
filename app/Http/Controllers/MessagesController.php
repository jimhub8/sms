<?php

namespace App\Http\Controllers;

use App\Imports\MessageImport;
use App\Models\Messages;
use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function messages_send(Request $request)
    {
        // return $request->all();



        $messages = Messages::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
        // $messages = Messages::all();

        foreach ($messages as $key => $message) {
            $raw_message = $request->message;

            $raw_message = str_replace("{{ Client Name }}", $message->name, $raw_message);
            $raw_message = str_replace("{{ Client Address }}", $message->address, $raw_message);
            $raw_message = str_replace("{{ Client Phone }}", $message->phone, $raw_message);
            // return $raw_message;
            // Log::debug('************');
            // Log::debug($raw_message);
            // Log::debug('************');
            $sms = new Sms();
            $message_ = $raw_message;
            $sms->sms($message->phone, $message_);
            // if ($key < 5) {
            //     $sms->sms_sandbox($message->phone, $message_);
            // }
            // return;
        }
        return;
    }

    public function filter_messages(Request $request)
    {
        return Messages::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
    }
}
