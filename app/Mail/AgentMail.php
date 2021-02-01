<?php

namespace App\Mail;

use App\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $agent, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agent $agent, $password)
    {
        $this->agent = $agent;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails/Agent')->subject('Welcome')->to($this->agent->email);
    }
}
