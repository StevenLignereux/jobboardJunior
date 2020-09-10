<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DiscordPost implements ShouldQueue
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
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', config('services.discord.discord_hook_post'), [
                'verify' => false,
                'form_params' => [
                    'content' => $status,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending discord message');
            Log::error($e->getMessage());
        }
    }
}
