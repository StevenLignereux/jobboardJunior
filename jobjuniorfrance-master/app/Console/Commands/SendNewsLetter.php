<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\Junior;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send news letter to mailinglist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $juniors = Junior::select('email', 'token')->distinct()->where('has_cancelled', 0)->get();
        $jobsToSend = Job::where("sent_by_newsletter", false)->where('status', 'valid')->orderBy('city')->get();


        $jobsSorted = [];
        $city = "";
        foreach ($jobsToSend as $job) {
            if ($city != $job->city) {
                $city = $job->city;
                if ($city == "null ") {
                    $city = "N/A";
                }
                $jobsSorted[$city][] = $job;
            }
        }


        if (count($jobsSorted) > 0) {
            foreach ($juniors as $junior) {
                dispatch(new \App\Jobs\SendNewsLetter($junior->email, $junior->token, $jobsSorted));
            }
            foreach ($jobsToSend as $job) {
                $job->sent_by_newsletter = true;
                $job->save();
            }
        }
    }
}
