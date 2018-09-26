<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use App\Transaction;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $transactions = Transaction::where('trans_date', '<', Carbon::now())->where('status', 'pending')->get();
            foreach ($transactions as $transaction) {
                $transaction->status = 'closed';
                $transaction->save();

                DB::statement("UPDATE `users` 
                                SET `balance` = `balance` - $transaction->sum 
                                WHERE `id` = $transaction->trans_from");
                DB::statement("UPDATE `users` 
                                SET `balance` = `balance` + $transaction->sum 
                                WHERE `id` = $transaction->trans_to");
            }
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
