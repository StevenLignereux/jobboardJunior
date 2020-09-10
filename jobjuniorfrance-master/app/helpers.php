<?php

use App\Models\Job;
use Illuminate\Support\Str;

if (!function_exists('getJobType')) {
    function getJobType(string $jobType): int
    {
        $jobId = 0;
        foreach (config('contracts') as $key => $contract) {
            if ($contract['type'] == $jobType) {
                $jobId = $key;
            }
        }

        if (strtoupper($jobType) == strtoupper('Internship')) {
            $jobId = 2;
        }
        if (strtoupper($jobType) == strtoupper('Fulltime')) {
            $jobId = 1;
        }

        return $jobId;
    }
}


if (!function_exists('getShortUrl')) {
    function getShortUrl(Job $job): string
    {
        $slug = Str::slug($job->title) . '-' . Str::slug($job->company_name) . '-' . Str::slug($job->city);
        return config('site.address') . '/s/' . $job->id . '-' . Str::random(6) . '-' . $slug;
    }
}


if (!function_exists('getSocialStatus')) {
    function getSocialStatus(Job $job): string
    {
        $status = "Nouveau Job sur " . config('site.address') . "\n";
        $status .= $job->city . " - #" . $job->company_name . "\n";
        if (!empty($job->link)) {
            $status .= "Lien direct:  " . getShortUrl($job) . "\n";
        }

        $status .= " #job #dev #junior ";
        foreach ($job->tags as $tag) {
            $status .= "#" . strtolower($tag->name) . " ";
        }

        return $status;
    }
}
