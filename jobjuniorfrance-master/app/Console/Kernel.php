<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\SendNewsLetter',
        'App\Console\Commands\FetchNeuvoo'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:newsletter')->weeklyOn(5, '11:30');

        $schedule->command('fetch:neuvoo bulk')->dailyAt('07:00');
        $schedule->command('fetch:neuvoo premium')->dailyAt('07:10');

        $schedule->command('repair:slug')->dailyAt('05:00');
        // $schedule->command('save:history-clicked')->dailyAt('23:59');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
