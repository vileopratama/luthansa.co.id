<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Modules\SalesInvoice\SalesInvoicePayment;
use Lang;
use Mail;

class MailAcceptPayment extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail_accept_payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail Accept Payment';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
		$sales_invoice_payments = SalesInvoicePayment::join('sales_invoices','sales_invoices.id','=','sales_invoice_payments.sales_invoice_id')
			->join('customers','customers.id','=','sales_invoices.customer_id')
			->join('accounts','accounts.id','=','sales_invoice_payments.account_id')
			->selectRaw("sales_invoice_payments.*,sales_invoices.total,DATE_FORMAT(sales_invoice_payments.payment_date,'%d %M %Y') as payment_date,customers.name as customer_name,customers.email as customer_email,accounts.account_no,accounts.account_name")
			->where('sales_invoice_payments.updated_at','=','0000-00-00 00:00:00')
			->get();
		
		foreach($sales_invoice_payments as $key => $row) {
			//$pid = Crypt::encrypt($row->id);
			//$customer_receipt_payment = new \App\Modules\Customer\Http\Controllers\CustomerController();
			//$pdf_attachment = $customer_receipt_payment->print_receipt($pid,'F','uploads');
			
			/*sent email*/
			Mail::send('emails.sales_invoice_accept_payment',array('data' => $row),function($message) use($row) {
				$message->from('no-reply@luthansa.co.id', Lang::get('global.receipt payment').' '.Lang::get('global.luthansa'));
				$message->to($row->customer_email);
				$message->subject(Lang::get('global.receipt payment'));
				$message->attach(public_path('uploads/invoice-'.$row->id.'.pdf'));
			});
			
			//update 
			//SalesInvoicePayment::where(['id' => $row->id])->update(['updated_at' => date("Y-m-d H:i:s")]);	
			
		}				
    }
	
	
	
}
