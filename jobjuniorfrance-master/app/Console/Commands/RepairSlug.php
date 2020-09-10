<?php

namespace App\Console\Commands;

use App\Models\Job;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class RepairSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:slug {jobId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add slug into job that havent one';

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

        if ($this->argument('jobId')) {
            $job = Job::where('id', $this->argument('jobId'))->first();
            $job->slug = getShortUrl($job);
            $job->save();
            $this->info('Repaired slug for job id : ' . $job->id  . ' slug : ' . $job->slug);
            Log::info('Repaired slug for job id : ' . $job->id);
        } else {
            $jobs = Job::whereNull('slug')->where('status', 'valid')->whereNotNull('link')->get();
            $bar = $this->output->createProgressBar(count($jobs));
            $bar->start();
            foreach ($jobs as $job) {
                $job->slug = getShortUrl($job);
                $job->save();
                $bar->advance();
                Log::info('Repaired slug for job id : ' . $job->id);
            }
            $bar->finish();
        }
    }
}
