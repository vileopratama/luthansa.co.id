<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Modules\Customer\Customer;
use Lang;
use Mail;

class MailRequestPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail_request_password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail Request Password';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
		//get customer
		$customers = Customer::whereRaw("request_forgot_password = 1 and password_decrypt <> '' ")->get();
		if($customers) {
			foreach($customers as $key => $customer) {
				/*sent email*/
				Mail::send('emails.request-password',array('customer' => $customer),function($message) use($customer) {
					$message->from('no-reply@luthansa.co.id', Lang::get('global.request password').' '.Lang::get('global.luthansa'));
					$message->to($customer->email);
					$message->subject(Lang::get('global.request change password'));
				});
				//update renew password
				Customer::where(['id' => $customer->id])->update(['request_forgot_password' => 0,'password_decrypt' => ""]);
				
			}
		}	
    }
}
