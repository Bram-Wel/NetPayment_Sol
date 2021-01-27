<?php

namespace App\Console;

use App\Console\Commands\CheckPayment;
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
        CheckPayment::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:payment')
            ->withoutOverlapping(3)
            ->everyTwoMinutes();

        $schedule->command('check:scheduler')
            ->withoutOverlapping(10)
            ->everySixHours();

        $schedule->command('add:movies')
            ->withoutOverlapping(10)
            ->everySixHours();

        $schedule->command('convert:movies')
            ->withoutOverlapping(10)
            ->everyThreeHours();

        $schedule->command('movie:payment')
            ->withoutOverlapping(10)
            ->everyFourMinutes();

        $schedule->command('unsubscribe:movie')
            ->withoutOverlapping(10)
            ->everyFourMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
