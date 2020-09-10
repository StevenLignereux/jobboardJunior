<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\Metric;
use Illuminate\Console\Command;

class SaveHistoryClicked extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:history-clicked';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sum clicked and saved to see each day the progression';

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
        $sumClicked = Job::where('status', 'valid')->whereNotNull('partner_name')->sum('views');
        $clicked = new Metric();
        $clicked->clicked = $sumClicked;
        $clicked->day = now();
        $clicked->save();
    }
}
