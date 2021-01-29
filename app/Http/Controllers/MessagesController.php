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

    public function messages_send(Request $request)
    {
        $messages = Messages::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
        // $messages = Messages::all();

        foreach ($messages as $key => $message) {
            $sms = new Sms();
            $message_ = 'Dear ' . $message->name  . ', We would like to inform you that your package has arrived. Please call 020 760 8777/020 760 8778/020 760 8779 for delivery. We will deliver to your doorstep.';
            $sms->sms($message->phone, $message_);
            // if ($key < 5) {
            //     $sms->sms_sandbox($message->phone, $message_);
            // }
            // return ;
        }
        return;
    }

    public function filter_messages(Request $request)
    {
        return Messages::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
    }
}
