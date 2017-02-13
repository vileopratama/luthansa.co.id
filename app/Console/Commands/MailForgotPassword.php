<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Modules\Customer\Customer;
use Lang;
use Mail;

class MailForgotPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail_forgot_password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail Forgot Password';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
		//get customer
		$customers = Customer::whereRaw("request_forgot_password = 1 and password_decrypt = '' ")->get();
		if($customers) {
			foreach($customers as $key => $customer) {
				/*sent email*/
				Mail::send('emails.forgot-password',array('customer' => $customer),function($message) use($customer) {
					$message->from('no-reply@luthansa.co.id', Lang::get('global.forgot password').' '.Lang::get('global.luthansa'));
					$message->to($customer->email);
					$message->subject(Lang::get('global.forgot password'));
				});
				//update request forgot password 
				Customer::where(['id' => $customer->id])->update(['request_forgot_password' => 0]);
				$this->info('forgot password link has been sent to email : '.$customer->email);
			}
		}	
    }
}
