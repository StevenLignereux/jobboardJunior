<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsLetterEmail extends Mailable
{
    use  SerializesModels;


    public $jobs;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobs, $token)
    {
        $this->jobs = $jobs;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('site.contact'))
            ->subject("Les jobs de la semaine")
            ->view('emails.newsletter', ['jobs' => $this->jobs, 'token' => $this->token]);
    }
}
