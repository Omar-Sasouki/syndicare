<?php

namespace App\Console;

use App\Models\User;
use App\Notifications\PaymentReminderNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            $users = User::where('paymentSyndic', 1)->get();

            foreach ($users as $user) {
                $user->paymentSyndic = 0;
                $user->save();

                $user->notify(new PaymentReminderNotification());
            }
        })->everyMinute();

    }
   /*  protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::table('users')->update(['paymentSyndic' => 0]);
        })->cron('0 0 6 * *');
    } */
    
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
