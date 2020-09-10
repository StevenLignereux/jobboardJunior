<?php

namespace App\Http\Managers;

use App\Models\Job;
use App\Jobs\TweeterPost;
use App\Jobs\DiscordPost;

class SocialManager
{
    /**
     * Manage social request -> use queue
     * 
     * @param Job $job
     */
    public static function socialRequest(Job $job)
    {
        if (config('app.env') == "production") {
            TweeterPost::dispatch($job);
            DiscordPost::dispatch($job);
        }
    }
}
