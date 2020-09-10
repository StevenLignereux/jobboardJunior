<?php

namespace App\Jobs;

require 'vendor/autoload.php';

use App\Mail\NewsLetterEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsLetter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $jobs;
    public $token;
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $token, $jobs)
    {
        $this->email = $email;
        $this->token = $token;
        $this->jobs = $jobs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $newsLetterEmail =  new NewsLetterEmail($this->jobs, $this->token);

            Mail::to($this->email)->send($newsLetterEmail);
            Log::info('Email sent to : ' . $this->email);
        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
            Log::error(json_encode($e->getMessage()));
            Log::error("Error sending email to " . $this->email);
        }
    }
}
