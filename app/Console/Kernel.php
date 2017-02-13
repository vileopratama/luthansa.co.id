<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Lang;
use Mail;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
		Commands\MailRegisteredUser::class,
		Commands\MailForgotPassword::class,
		Commands\MailQueue::class,
		Commands\MailRequestPassword::class,
		Commands\MailConfirmPayment::class,
		//Commands\MailAcceptPayment::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
		$schedule
			->command('mail_registered_user')
			->everyMinute();
		$schedule
			->command('mail_forgot_password')
			->everyMinute();	
		$schedule
			->command('mail_queue')
			->everyMinute();
		$schedule
			->command('mail_request_password')
			->everyMinute();
		$schedule
			->command('mail_confirm_payment')
			->everyMinute();	
		/*$schedule
			->command('mail_accept_payment')
			->everyMinute();	
        */
    }
}
