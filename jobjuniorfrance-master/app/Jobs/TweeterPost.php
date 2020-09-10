<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Thujohn\Twitter\Facades\Twitter;
use Illuminate\Support\Facades\Log;

class TweeterPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $opportunity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->opportunity = $job;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $status = getSocialStatus($this->opportunity);

        try {
            Twitter::postTweet(
                ['status' => $status, 'format' => 'json']
            );
        } catch (\Exception $e) {
            Log::error('Error sending tweet');
            Log::error($e->getMessage());
        }
    }
}
