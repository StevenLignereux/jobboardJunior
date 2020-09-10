<?php

namespace App\Console\Commands;

use App\Models\Job;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveBadJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:bad-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set job to invalid';

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
        $jobs = Job::whereNotNull('partner_name')->where('status', config('status.waiting'));
        $i = 0;
        $bar = $this->output->createProgressBar($jobs->count());
        $bar->start();

        foreach ($jobs->get() as $job) {
            if (!$job->hasJunior($job->title, $job->description)) {
                $job->status = config('status.invalid');
                $job->save();
                $i++;
                $bar->advance();
                Log::info('Remove jobs -  set to invalid id :  ' . $job->id);
            }
        }
        $this->info('Number of jobs set to invalid status : ' . $i);
        $bar->finish();
    }
}
