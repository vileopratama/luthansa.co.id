<?php
namespace App\Modules\Customer\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Modules\AccountBank\AccountBank;
use App\Modules\Customer\Customer;
use App\Modules\SalesInvoice\SalesInvoice;
use App\Modules\SalesInvoice\SalesInvoiceArmada;
use App\Modules\SalesInvoice\SalesInvoiceCost;
use App\Modules\SalesInvoice\SalesInvoiceDetail;
use App\Modules\SalesInvoice\SalesInvoiceExpense;
use App\Modules\SalesInvoice\SalesInvoicePayment;
use App\Modules\SalesOrder\SalesOrder;
use App\Modules\SalesOrder\SalesOrderDetail;
use App\Modules\SalesOrder\SalesOrderCost;
use App\Modules\SalesOrder\SalesOrderConfirmPayment;
use Auth;
use Config;
use Crypt;
use Input;
use Lang;
use Mail;
use PDF;
use Request;
use Response;
use Setting;
use Theme;
use Validator;

class CustomerController extends Controller {
	public function index(SalesOrder $sales_order) {
		$user_id = Auth::user()->id;
		$order_date_from = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("order_date_from"));
		$order_date_to = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("order_date_to"));
		//$sales_order = $sales_order->where(['status' => 2,'customer_id' => $user_id]);
		
		$sales_order = SalesOrder::join('customers','customers.id','=','sales_orders.customer_id')
			->where(['sales_orders.status' => 2,'sales_orders.customer_id' => $user_id])
			->selectRaw("sales_orders.*,DATE_FORMAT(order_date,'%d/%m/%Y') as order_date,DATE_FORMAT(sales_orders.booking_from_date,'%d %M %Y') as booking_from_date,DATE_FORMAT(sales_orders.booking_to_date,'%d %M %Y') as booking_to_date,customers.name as customer_name,customers.email as customer_email,customers.address as customer_address,customers.city as customer_city,customers.zip_code as customer_zip_code");
		
		if($order_date_from && $order_date_to) {
			$sales_order = $sales_order->where('order_date','>=',$order_date_from)
			->where('order_date','<=',$order_date_to);
		}
		
		return Theme::view('customer::index',array(
			'sales_orders' => $sales_order
				->paginate(Config::get('site.limit_pagination'))
		));
	}
	
	public function view($id,SalesOrder $sales_order,SalesOrderDetail $sales_order_details) {
		$id = Crypt::decrypt($id);
		$user_id = Auth::user()->id;
		return Theme::view('customer::view',array(
			'sales_order' => $sales_order
				->selectRaw("*,DATE_FORMAT(order_date,'%d/%m/%Y') as order_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
				->selectRaw("DATE_FORMAT(booking_from_date,'%d/%m/%Y') as booking_from_date,DATE_FORMAT(booking_to_date,'%d/%m/%Y') as booking_to_date")
				->where(['id' =>$id,'customer_id' => $user_id])->first(),
			'sales_order_details' => $sales_order_details->where(['sales_order_id'=>$id])->get(),
		));
	}
	
	public function sales_order(SalesOrder $sales_order) {
		$user_id = Auth::user()->id;
		$order_date_from = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("order_date_from"));
		$order_date_to = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("order_date_to"));
		$sales_order = $sales_order->where(['status' => 0,'customer_id' => $user_id]);
		if($order_date_from && $order_date_to) {
			$sales_order = $sales_order->where('order_date','>=',$order_date_from)
			->where('order_date','<=',$order_date_to);
		}
		
		
		return Theme::view('customer::sales-order-index',array(
			'sales_orders' => $sales_order
				->selectRaw("sales_orders.*,DATE_FORMAT(order_date,'%d/%m/%Y') as order_date")
				->selectRaw("DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
				->paginate(Config::get('site.limit_pagination'))
		));
	}
	
	public function view_sales_order($id,SalesOrder $sales_order,SalesOrderDetail $sales_order_details,SalesOrderCost $sales_order_cost,SalesOrderConfirmPayment $sales_order_confirm_payment) {
		$id = Crypt::decrypt($id);
		$user_id = Auth::user()->id;
		
		return Theme::view('customer::view-sales-order',array(
			'sales_order' => $sales_order
				->join('customers','customers.id','=','sales_orders.customer_id')
				->selectRaw("sales_orders.*,customers.name as customer_name,customers.email as customer_email")
				->selectRaw("DATE_FORMAT(order_date,'%d/%m/%Y') as order_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
				->selectRaw("DATE_FORMAT(booking_from_date,'%d/%m/%Y') as booking_from_date,DATE_FORMAT(booking_to_date,'%d/%m/%Y') as booking_to_date")
				->where(['sales_orders.id' =>$id,'sales_orders.customer_id' => $user_id])
				->first(),
			'sales_order_details' => $sales_order_details
				->join('armada_categories','armada_categories.id','=','sales_order_details.armada_category_id')
				->selectRaw("sales_order_details.*,armada_categories.name as armada_category_name")
				->where(['sales_order_id'=>$id])
				->get(),
			'sales_order_costs' => $sales_order_cost->where(['sales_order_id'=>$id])->get(),
			'sales_order_confirm_payments' => $sales_order_confirm_payment
				->join('accounts','accounts.id','=','sales_order_confirm_payments.account_id')
				->selectRaw("*,DATE_FORMAT(payment_date,'%d/%m/%Y') as payment_date,CONCAT(account_no,' ',account_name) as bank_account")
				->where(['sales_order_id' =>$id])
				->get(),
			'account_banks' => AccountBank::join('banks','banks.id','=','accounts.bank_id')->where(['accounts.is_active' => 1])->get(),
		));
	}
	
	public function download_invoice_sales_order($id) {
				$id = Crypt::decrypt($id);
		$margin_left = 15;
		$sales_order = SalesOrder::join('customers','customers.id','=','sales_orders.customer_id')
			->select(['sales_orders.*','customers.name as customer_name','customers.address as customer_address','customers.phone_number','customers.mobile_number'])
			->selectRaw("DATE_FORMAT(order_date,'%d/%m/%Y') as order_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
			->selectRaw("DATE_FORMAT(booking_from_date,'%d %M %Y') as booking_from_date,DATE_FORMAT(booking_to_date,'%d %M %Y') as booking_to_date")
			->where(['sales_orders.id' => $id])
			->first();
			
		$sales_order_details = SalesOrderDetail::join('armada_categories','armada_categories.id','=','sales_order_details.armada_category_id')
			->select(['sales_order_details.*','armada_categories.name as armada_category_name'])
			->selectRaw("(price * qty * days) as subtotal")
			->where(['sales_order_id' => $id])
			->get();
			
		$sales_order_cost = SalesOrderCost::where(['sales_order_id' => $id])
			->get();	
			
		$account_banks = AccountBank::join('banks','banks.id','=','accounts.bank_id')->where(['accounts.is_active' => 1])->get();	
				
			
		PDF::SetTitle(Lang::get('global.invoice'));
		PDF::AddPage('P', 'A4');
		PDF::SetFont('Helvetica','',8,'','false');
		PDF::setJPEGQuality(100);
		PDF::SetFillColor(255, 255, 255);
		PDF::Image(asset('vendor/luthansa/img/logo.png'), 15, 10, 70, 25, 'PNG', 'http://www.luthansa.co.id', '', true, 150, '', false, false, 0, false, false, false);
		
		$x=$margin_left;$y=35;
		PDF::SetFont('Helvetica','B',9,'','false');
		PDF::SetXY($x,$y=$y);
		PDF::Cell(180,10,strtoupper(Setting::get('company_name')),0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetFont('Helvetica','',8,'','false');
        PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_address').' '.Setting::get('company_city').' '.Setting::get('company_zip_code'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_telephone_number').' ('.Lang::get('global.hunting').')',0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_email'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_website'),0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetFont('Helvetica','B',14,'','false');
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(180,10,strtoupper(Lang::get('global.invoice')),0,0,'C',false,'',0,10,'T','M');
		//column date & invoice
		PDF::SetFont('Helvetica','',8,'','false');
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(90,10,strtoupper(Lang::get('global.invoice')).' #'.$sales_order->number,0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+100,$y=$y);
		PDF::Cell(90,10,Lang::get('printer.to sir'),0,0,'L',false,'',0,10,'T','M');
		
		/* Kepada Yth /**/
        $x=$x;$y=$y;
        PDF::SetLineStyle(array('width'=>0.3,'color'=>array(0,0,0)));
        PDF::Line($x+180,$y+2,135,$y+2); //top 
        PDF::Line($x+180,$y+25,135,$y+25); //bottom
        PDF::Line($x+120,$y+2,$x+120,$y+25); //left
		PDF::Line($x+180,$y+2,$x+180,$y+25); //right
		
		PDF::SetXY($x+120,$y=$y);
		PDF::Cell(90,10,$sales_order->customer_name,0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+120,$y+5);
		PDF::Cell(90,10,$sales_order->customer_address,0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+120,$y+15);
		PDF::Cell(90,10,$sales_order->phone_number.' '.$sales_order->mobile_number,0,0,'L',false,'',0,10,'T','M');
		/* Kepada Yth /**/

		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(20,10,Lang::get('printer.date'),0,0,'L',false,'',0,10,'T','M');
		PDF::Cell(10,10,":",0,0,'C',false,'',0,10,'T','M');
		PDF::Cell(30,10,$sales_order->order_date,0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(20,10,Lang::get('printer.due date'),0,0,'L',false,'',0,10,'T','M');
		PDF::Cell(10,10,":",0,0,'C',false,'',0,10,'T','M');
		PDF::Cell(30,10,$sales_order->due_date,0,0,'L',false,'',0,10,'T','M');
		
		
		$y=$y+20;
		$x=$margin_left;
		PDF::MultiCell(60,8,Lang::get('printer.booking from date').' : '.($sales_order->booking_from_date),1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+65;$y=$y;
		PDF::MultiCell(60,8,Lang::get('printer.booking to date').' : '.($sales_order->booking_to_date),1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+65;$y=$y;
		PDF::MultiCell(50,8,Lang::get('printer.booking total').' : '.($sales_order->booking_total_days .' '.Lang::get('printer.day')),1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		//coloumn header
		$y=$y+10;
		$x=$margin_left;
        PDF::MultiCell(50,8,Lang::get('printer.description'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+50;$y=$y;
        PDF::MultiCell(45,8,Lang::get('printer.car type'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        
		$x=$x+45;$y=$y;
        PDF::MultiCell(20,8,Lang::get('printer.qty unit'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        
		$x=$x+20;$y=$y;
        PDF::MultiCell(32,8,Lang::get('printer.price per unit'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        
		$x=$x+32;$y=$y;
        PDF::MultiCell(33,8,Lang::get('printer.quantity'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        

        $y+=8;
		$total = 0;
		//sales order details
		foreach($sales_order_details  as $key => $row){
			$x=$margin_left;
            $x=$x;$y=$y;
            PDF::MultiCell(50,8,$row->description,1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+50;$y=$y;
			PDF::MultiCell(45,8,$row->armada_category_name,1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+45;$y=$y;
			PDF::MultiCell(20,8,number_format($row->qty,0),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+20;$y=$y;
			PDF::MultiCell(32,8,number_format($row->price,0),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+32;$y=$y;
			PDF::MultiCell(33,8,number_format($row->subtotal,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			$y+=8;
			$total+=$row->subtotal;
		}
		
		//sales order cost
		foreach($sales_order_cost  as $key => $cost){
            $x=$margin_left;$y=$y;
            PDF::MultiCell(147,8,$cost->description,1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+147;$y=$y;
			PDF::MultiCell(33,8,number_format($cost->cost,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$y+=8;
			$total+=$cost->cost;
		}
		
		$x=$margin_left;$y=$y;
        PDF::MultiCell(147,8,Lang::get('printer.quantity rental price'),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+147;$y=$y;
		PDF::MultiCell(33,8,number_format($total,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$margin_left;$y=$y+8;
        PDF::MultiCell(147,8,Lang::get('printer.down payment'),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+147;$y=$y;
		PDF::MultiCell(33,8,number_format(0,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$margin_left;$y=$y+8;
        PDF::MultiCell(147,8,Lang::get('printer.total bill'),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+147;$y=$y;
		PDF::MultiCell(33,8,number_format($total,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$margin_left;$y=$y+10;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(30,8,Lang::get('printer.be regarded').' :',0,0,'L',false,'',0,8,'T','M');
		$x=$x+35;$y=$y;
		PDF::MultiCell(120,8,"## ".be_regarded($total)." ##",1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		PDF::SetFont('Helvetica','B',8,'','false');
		$x=$margin_left;$y=$y+10;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(180,10,'Mohon Pembayaran dapat ditransfer ke Rekening',0,0,'C',false,'',0,10,'T','M');
		
		if($account_banks) {
			PDF::SetFont('Helvetica','BI',8,'','false');
			$y = $y + 5;
			foreach($account_banks as $key => $account) {
				PDF::SetXY($x,$y);
				PDF::Cell(180,10,$account->name.' '.$account->account_no.' a.n '.$account->account_name,0,0,'C',false,'',0,10,'T','M');
				$y = $y + 5;
			}
		}
		
		PDF::SetXY($x,$y=$y);
		PDF::SetFont('Helvetica','',8,'','false');	
		PDF::Cell(180,10,'( Bukti transaksi harap dikirim ke email office@luthansa.co.id atau luthansagroup@gmail.com )',0,0,'C',false,'',0,10,'T','M');
		
		$y=$y+10;
		$x=$margin_left;
        PDF::MultiCell(180,8,'Sesuai dengan ketentuan yang berlaku, PT Anther Prima Persada mengatur bahwa Invoice ini terlah ditandatangani secara elektronik sehingga tidak diperlukan tanda tangan basah pada Invoice ini.',1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(180,10,Lang::get('printer.regards'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::SetFont('Helvetica','B',8,'','false');	
		PDF::Cell(180,10,Setting::get('company_name'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(30,10,"TTD",0,0,'C',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+10);
		PDF::SetFont('Helvetica','',8,'','false');	
		PDF::Cell(30,10,Setting::get('company_signature_name'),0,0,'C',false,'',0,10,'T','M');
		
		/* Disclamer /**/
        $x=$x;$y=$y;
        PDF::SetLineStyle(array('width'=>0.3,'color'=>array(0,0,0)));
        PDF::Line($x+40,$y+2,150,$y+2); //top 
        PDF::Line($x+40,$y+30,150,$y+30); //bottom
        PDF::Line($x+40,$y+2,$x+40,$y+30); //left
		PDF::Line($x+135,$y+2,$x+135,$y+30); //right
		
		PDF::SetXY($x+40,$y=$y);
		PDF::SetFont('Helvetica','B',6,'','false');	
		PDF::SetTextColor(255,0,0);
		PDF::Cell(90,10,Lang::get("printer.warning"),0,0,'L',false,'',0,10,'T','M');
		PDF::SetFont('Helvetica','',6,'','false');	
		PDF::SetTextColor(0,0,0);
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Pembayaran dengan Cek/Bilyet Giro/Transfer dianggap sah bila telah dicairkan ke rekening.",0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Harga Sewa SUDAH TERMASUK bahan bakar dan jasa pengemudi.",0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Harga sewa BELUM TERMASUK tiket masuk obyek wisata, biaya tol, parkir, retribusi daerah,",0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"  makan biaya penyebrangan serta TIPS pengemudi dan kenek.",0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Pemakaian melebihi pukul 22.00 WIB dikenakan OVERTIME CHARGE sebesar :",0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(60,10,"  - Commuter & Micro Bus Rp 150.000/Jam",0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x+100,$y=$y);
		PDF::Cell(60,10,"  - Bigbus Bus Rp 350.000/Jam",0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"  - Medium Bus Rp 250.000/JamB",0,0,'L',false,'',0,10,'T','M');
		/* Disclamer /**/
		
		/* QR CODE /**/
		
		$style = array(
			'border' => 2,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);
		
		// QRCODE,L : QR-CODE Low error correction
		PDF::write2DBarcode(url('/sales-order/feed/invoice/'.Crypt::encrypt($id)), 'QRCODE,L', $x+153, $y-19, 28, 28, $style, 'N');
		/* QR CODE /**/
		
		PDF::Output('invoice.pdf','D');
	}
	
	public function sales_invoice(SalesInvoice $sales_invoice) {
		$user_id = Auth::user()->id;
		$invoice_date_from = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("invoice_date_from"));
		$invoice_date_to = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("invoice_date_to"));
		$sales_invoice = $sales_invoice->where(['customer_id' => $user_id])
		->selectRaw("sales_invoices.*,DATE_FORMAT(invoice_date,'%d/%m/%Y') as invoice_date")
		->selectRaw("CASE WHEN status = 0 THEN '".Lang::get('global.new')."' WHEN status=1 THEN '".Lang::get('global.process')."' WHEN status=2 THEN '".Lang::get('global.paid')."' ELSE '".Lang::get('global.closed')."' END as status_string");
		
		if(Request::has("invoice_date_from")) {
			$sales_invoice = $sales_invoice->where('invoice_date','>=',preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("invoice_date_from")));
		}
		if(Request::has("invoice_date_to")) {
			$sales_invoice = $sales_invoice->where('invoice_date','<=',preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get("order_date_to")));
		}
		
		return Theme::view('customer::sales-invoice-index',array(
			'sales_invoices' =>  $sales_invoice->paginate(10),
			
		));
	}
	
	public function view_sales_invoice($id,SalesInvoice $sales_invoice,SalesInvoiceDetail $sales_invoice_details,SalesInvoiceCost $sales_invoice_cost,SalesInvoicePayment $sales_invoice_payment) {
		$id = Crypt::decrypt($id);
		$user_id = Auth::user()->id;
		return Theme::view('customer::view-sales-invoice',array(
			'sales_invoice' => $sales_invoice->where(['id' =>$id,'customer_id' => $user_id])->first(),
			'sales_invoice_details' => $sales_invoice_details->where(['sales_invoice_id'=>$id])->get(),
			'sales_invoice_costs' => $sales_invoice_cost->where(['sales_invoice_id'=>$id])->get(),
			'sales_invoice_payments' => $sales_invoice_payment->where(['sales_invoice_id'=>$id])->get(),
		));
	}
	
	public function download_invoice_sales_invoice($id) {
		$id = Crypt::decrypt($id);
		$margin_left = 15;
		$sales_order = SalesOrder::join('customers','customers.id','=','sales_orders.customer_id')
			->select(['sales_orders.*','customers.name as customer_name','customers.address as customer_address','customers.phone_number','customers.mobile_number'])
			->selectRaw("DATE_FORMAT(order_date,'%d/%m/%Y') as order_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
			->selectRaw("DATE_FORMAT(booking_from_date,'%d %M %Y') as booking_from_date,DATE_FORMAT(booking_to_date,'%d %M %Y') as booking_to_date")
			->where(['sales_orders.id' => $id])
			->first();
			
		$sales_order_details = SalesOrderDetail::join('armada_categories','armada_categories.id','=','sales_order_details.armada_category_id')
			->select(['sales_order_details.*','armada_categories.name as armada_category_name'])
			->selectRaw("(price * qty * days) as subtotal")
			->where(['sales_order_id' => $id])
			->get();
			
		$sales_order_cost = SalesOrderCost::where(['sales_order_id' => $id])
			->get();	
			
		$account_banks = AccountBank::join('banks','banks.id','=','accounts.bank_id')->where(['accounts.is_active' => 1])->get();	
				
			
		PDF::SetTitle(Lang::get('global.invoice'));
		PDF::AddPage('P', 'A4');
		PDF::SetFont('Helvetica','',8,'','false');
		PDF::setJPEGQuality(100);
		PDF::SetFillColor(255, 255, 255);
		PDF::Image(asset('vendor/luthansa/img/logo.png'), 15, 10, 70, 25, 'PNG', 'http://www.luthansa.co.id', '', true, 150, '', false, false, 0, false, false, false);
		
		$x=$margin_left;$y=35;
		PDF::SetFont('Helvetica','B',9,'','false');
		PDF::SetXY($x,$y=$y);
		PDF::Cell(180,10,strtoupper(Setting::get('company_name')),0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetFont('Helvetica','',8,'','false');
        PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_address').' '.Setting::get('company_city').' '.Setting::get('company_zip_code'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_telephone_number').' ('.Lang::get('global.hunting').')',0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_email'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,10,Setting::get('company_website'),0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetFont('Helvetica','B',14,'','false');
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(180,10,strtoupper(Lang::get('global.invoice')),0,0,'C',false,'',0,10,'T','M');
		//column date & invoice
		PDF::SetFont('Helvetica','',8,'','false');
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(90,10,strtoupper(Lang::get('global.invoice')).' #'.$sales_order->number,0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+100,$y=$y);
		PDF::Cell(90,10,Lang::get('printer.to sir'),0,0,'L',false,'',0,10,'T','M');
		
		/* Kepada Yth /**/
        $x=$x;$y=$y;
        PDF::SetLineStyle(array('width'=>0.3,'color'=>array(0,0,0)));
        PDF::Line($x+180,$y+2,135,$y+2); //top 
        PDF::Line($x+180,$y+25,135,$y+25); //bottom
        PDF::Line($x+120,$y+2,$x+120,$y+25); //left
		PDF::Line($x+180,$y+2,$x+180,$y+25); //right
		
		PDF::SetXY($x+120,$y=$y);
		PDF::Cell(90,10,$sales_order->customer_name,0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+120,$y+5);
		PDF::Cell(90,10,$sales_order->customer_address,0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+120,$y+15);
		PDF::Cell(90,10,$sales_order->phone_number.' '.$sales_order->mobile_number,0,0,'L',false,'',0,10,'T','M');
		/* Kepada Yth /**/

		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(20,10,Lang::get('printer.date'),0,0,'L',false,'',0,10,'T','M');
		PDF::Cell(10,10,":",0,0,'C',false,'',0,10,'T','M');
		PDF::Cell(30,10,$sales_order->order_date,0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(20,10,Lang::get('printer.due date'),0,0,'L',false,'',0,10,'T','M');
		PDF::Cell(10,10,":",0,0,'C',false,'',0,10,'T','M');
		PDF::Cell(30,10,$sales_order->due_date,0,0,'L',false,'',0,10,'T','M');
		
		
		$y=$y+20;
		$x=$margin_left;
		PDF::MultiCell(60,8,Lang::get('printer.booking from date').' : '.($sales_order->booking_from_date),1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+65;$y=$y;
		PDF::MultiCell(60,8,Lang::get('printer.booking to date').' : '.($sales_order->booking_to_date),1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+65;$y=$y;
		PDF::MultiCell(50,8,Lang::get('printer.booking total').' : '.($sales_order->booking_total_days .' '.Lang::get('printer.day')),1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		//coloumn header
		$y=$y+10;
		$x=$margin_left;
        PDF::MultiCell(50,8,Lang::get('printer.description'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+50;$y=$y;
        PDF::MultiCell(45,8,Lang::get('printer.car type'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        
		$x=$x+45;$y=$y;
        PDF::MultiCell(20,8,Lang::get('printer.qty unit'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        
		$x=$x+20;$y=$y;
        PDF::MultiCell(32,8,Lang::get('printer.price per unit'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        
		$x=$x+32;$y=$y;
        PDF::MultiCell(33,8,Lang::get('printer.quantity'),1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
        

        $y+=8;
		$total = 0;
		//sales order details
		foreach($sales_order_details  as $key => $row){
			$x=$margin_left;
            $x=$x;$y=$y;
            PDF::MultiCell(50,8,$row->description,1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+50;$y=$y;
			PDF::MultiCell(45,8,$row->armada_category_name,1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+45;$y=$y;
			PDF::MultiCell(20,8,number_format($row->qty,0),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+20;$y=$y;
			PDF::MultiCell(32,8,number_format($row->price,0),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+32;$y=$y;
			PDF::MultiCell(33,8,number_format($row->subtotal,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			$y+=8;
			$total+=$row->subtotal;
		}
		
		//sales order cost
		foreach($sales_order_cost  as $key => $cost){
            $x=$margin_left;$y=$y;
            PDF::MultiCell(147,8,$cost->description,1,'L',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$x=$x+147;$y=$y;
			PDF::MultiCell(33,8,number_format($cost->cost,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
			
			$y+=8;
			$total+=$cost->cost;
		}
		
		$x=$margin_left;$y=$y;
        PDF::MultiCell(147,8,Lang::get('printer.quantity rental price'),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+147;$y=$y;
		PDF::MultiCell(33,8,number_format($total,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$margin_left;$y=$y+8;
        PDF::MultiCell(147,8,Lang::get('printer.down payment'),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+147;$y=$y;
		PDF::MultiCell(33,8,number_format(0,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$margin_left;$y=$y+8;
        PDF::MultiCell(147,8,Lang::get('printer.total bill'),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$x+147;$y=$y;
		PDF::MultiCell(33,8,number_format($total,2),1,'R',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		$x=$margin_left;$y=$y+10;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(30,8,Lang::get('printer.be regarded').' :',0,0,'L',false,'',0,8,'T','M');
		$x=$x+35;$y=$y;
		PDF::MultiCell(120,8,"## ".be_regarded($total)." ##",1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		PDF::SetFont('Helvetica','B',8,'','false');
		$x=$margin_left;$y=$y+10;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(180,10,'Mohon Pembayaran dapat ditransfer ke Rekening',0,0,'C',false,'',0,10,'T','M');
		
		if($account_banks) {
			PDF::SetFont('Helvetica','BI',8,'','false');
			$y = $y + 5;
			foreach($account_banks as $key => $account) {
				PDF::SetXY($x,$y);
				PDF::Cell(180,10,$account->name.' '.$account->account_no.' a.n '.$account->account_name,0,0,'C',false,'',0,10,'T','M');
				$y = $y + 5;
			}
		}
		
		PDF::SetXY($x,$y=$y);
		PDF::SetFont('Helvetica','',8,'','false');	
		PDF::Cell(180,10,'( Bukti transaksi harap dikirim ke email office@luthansa.co.id atau luthansagroup@gmail.com )',0,0,'C',false,'',0,10,'T','M');
		
		$y=$y+10;
		$x=$margin_left;
        PDF::MultiCell(180,8,'Sesuai dengan ketentuan yang berlaku, PT Anther Prima Persada mengatur bahwa Invoice ini terlah ditandatangani secara elektronik sehingga tidak diperlukan tanda tangan basah pada Invoice ini.',1,'C',false,1,$x,$y,true,0,false,true,8,'M',false);
		
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(180,10,Lang::get('printer.regards'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+5);
		PDF::SetFont('Helvetica','B',8,'','false');	
		PDF::Cell(180,10,Setting::get('company_name'),0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+10);
		PDF::Cell(30,10,"TTD",0,0,'C',false,'',0,10,'T','M');
		PDF::SetXY($x,$y=$y+10);
		PDF::SetFont('Helvetica','',8,'','false');	
		PDF::Cell(30,10,Setting::get('company_signature_name'),0,0,'C',false,'',0,10,'T','M');
		
		/* Disclamer /**/
        $x=$x;$y=$y;
        PDF::SetLineStyle(array('width'=>0.3,'color'=>array(0,0,0)));
        PDF::Line($x+40,$y+2,150,$y+2); //top 
        PDF::Line($x+40,$y+30,150,$y+30); //bottom
        PDF::Line($x+40,$y+2,$x+40,$y+30); //left
		PDF::Line($x+135,$y+2,$x+135,$y+30); //right
		
		PDF::SetXY($x+40,$y=$y);
		PDF::SetFont('Helvetica','B',6,'','false');	
		PDF::SetTextColor(255,0,0);
		PDF::Cell(90,10,Lang::get("printer.warning"),0,0,'L',false,'',0,10,'T','M');
		PDF::SetFont('Helvetica','',6,'','false');	
		PDF::SetTextColor(0,0,0);
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Pembayaran dengan Cek/Bilyet Giro/Transfer dianggap sah bila telah dicairkan ke rekening.",0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Harga Sewa SUDAH TERMASUK bahan bakar dan jasa pengemudi.",0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Harga sewa BELUM TERMASUK tiket masuk obyek wisata, biaya tol, parkir, retribusi daerah,",0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"  makan biaya penyebrangan serta TIPS pengemudi dan kenek.",0,0,'L',false,'',0,10,'T','M');
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"* Pemakaian melebihi pukul 22.00 WIB dikenakan OVERTIME CHARGE sebesar :",0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(60,10,"  - Commuter & Micro Bus Rp 150.000/Jam",0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x+100,$y=$y);
		PDF::Cell(60,10,"  - Bigbus Bus Rp 350.000/Jam",0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x+40,$y=$y+3);
		PDF::Cell(90,10,"  - Medium Bus Rp 250.000/JamB",0,0,'L',false,'',0,10,'T','M');
		/* Disclamer /**/
		
		/* QR CODE /**/
		
		$style = array(
			'border' => 2,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);
		
		// QRCODE,L : QR-CODE Low error correction
		PDF::write2DBarcode(url('/sales-order/feed/invoice/'.Crypt::encrypt($id)), 'QRCODE,L', $x+153, $y-19, 28, 28, $style, 'N');
		/* QR CODE /**/
		
		PDF::Output('invoice.pdf','D');
	}
	
	public function profile(Customer $customer) {
		$user_id = Auth::user()->id;
		return Theme::view('customer::profile',array(
			'profile' => $customer->find($user_id)
		));
	}
	
	public function do_update_profile(Input $request) {
		$user_id = Auth::user()->id;
		$field = array (
            'name' => $request->get('name'),
			'mobile_number' => $request->get('mobile_number'),
			'address' => $request->get('address'),
			'city' => $request->get('city'),
        );
		
		$rules = array (
            'name' => 'required',
			'mobile_number' =>'required',
			'address' => 'required',
			'city' => 'required',
        );
		
		$messages = array(
			'name.required' => 'Nama Pribadi/Perusahaan wajib diisi',
			'mobile_number.required' => 'Nomor Handphone wajib diisi',
			'address.required' => 'Alamat Domisili wajib diisi',
			'city.required' => 'Kota Asal wajib diisi',
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			//update customer 
			$customer_update = Customer::where(['id' => $user_id])->update($field);
			$params ['success'] =  true;
			$params ['title'] =  "Update Profile";		
			$params ['message'] =  "Update Profile berhasil !";		
		}
		
		
		return Response::json($params);
	}
	
	
	public function change_password(Customer $customer) {
		$user_id = Auth::user()->id;
		return Theme::view('customer::change-password',array(
			
		));
	}
	
	public function do_update_password(Input $request) {
		$user_id = Auth::user()->id;
		$field = array (
            'password' => $request->get('password'),
			'confirm_password' => $request->get('confirm_password'),
			
        );
		
		$rules = array (
            'password' => 'required',
			'confirm_password' =>'required|same:password',
        );
		
		$messages = array(
			'password.required' => 'Password baru wajib diisi',
			'confirm_password.required' => 'Konfirmasi Password wajib diisi',
			'confirm_password.same' => 'Konfirmasi Password dan password harus sama',
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			//update customer 
			$customer_update = Customer::where(['id' => $user_id])->update(['password' => bcrypt($request->get('password'))]);
			$params ['success'] =  true;
			$params ['title'] =  "Update Password";		
			$params ['message'] =  "Ganti Password Baru berhasil !";		
		}
		
		
		return Response::json($params);
	}
	
	public function do_confirm_payment(Input $request) {
		$sales_order_id = Crypt::decrypt(Input::get('sales_order_id'));
		
		$field = array (
            'account_id' => $request->get('account_id'),
			'total_payment' => $request->get('total_payment'),
			'payment_date' => $request->get('payment_date'),
			'from_bank' => $request->get('from_bank'),
			'from_account_no' => $request->get('from_account_no'),
			'from_account_name' => $request->get('from_account_name'),
        );
		
		$rules = array (
            'account_id' => "required",
			'total_payment' => "required",
			'payment_date' => "required",
			'from_bank' => "required",
			'from_account_no' => "required",
			'from_account_name' => "required",
        );
		
		$messages = array(
			'account_id.required' => Lang::get('account is required'),
			'total_payment.required' => Lang::get('total payment is required'),
			'payment_date.required' => Lang::get('payment date is required'),
			'from_bank.required' => Lang::get('from bank is required'),
			'from_account_no.required' => Lang::get('from account no is required'),
			'from_account_name.required' => Lang::get('from account name is required'),
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray(),
				'redirect' => url('/'),
            );
		} else {
			//sales order 
			$sales_order = SalesOrder::find($sales_order_id);
			$total_bill = 0;
			if($sales_order) {
				$total_bill = $sales_order->total;
			}
			$balanced = $total_bill - $request->get('total_payment');
			//proccess 
			$sales_order_confirm_payment = new SalesOrderConfirmPayment();
			$sales_order_confirm_payment->sales_order_id = $sales_order_id;
			$sales_order_confirm_payment->payment_date = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', $request->get('payment_date'));
			$sales_order_confirm_payment->account_id = $request->get('account_id');
			$sales_order_confirm_payment->total_bill = $total_bill;
			$sales_order_confirm_payment->total_payment = $request->get('total_payment');
			$sales_order_confirm_payment->balanced = $balanced;
			$sales_order_confirm_payment->from_bank_name = $request->get('from_bank');
			$sales_order_confirm_payment->from_account_no = $request->get('from_account_no');
			$sales_order_confirm_payment->from_account_name = $request->get('from_account_name');
			$sales_order_confirm_payment->created_at = date("Y-m-d H:i:s");
			$sales_order_confirm_payment->save();
			
			$params = array(
                'success' => true,
                'message' => Lang::get('message.confirm payment has been successfully'),
				'redirect' => url('/customer/sales-order/view/'.Crypt::encrypt($sales_order_id)),
            );
		}	
		
		return Response::json($params);
	}
	
	public function print_receipt($id,$output='D',$folder='') {
		$id = Crypt::decrypt($id);
		$margin_left = 10;
		$start = 5;
		$sales_invoice_payment = SalesInvoicePayment::join('sales_invoices','sales_invoices.id','=','sales_invoice_payments.sales_invoice_id')
		->join("customers","customers.id",'=',"sales_invoices.customer_id")
		->selectRaw("sales_invoice_payments.*,sales_invoices.*,customers.name as customer_name,DATE_FORMAT(payment_date,'%d %M %Y') as payment_date")
		->where('sales_invoice_payments.id',$id)
		->first();
		
		PDF::SetTitle(Lang::get('global.receipt'));
		PDF::AddPage('L', 'A5');
		PDF::SetFont('Helvetica','',8,'','false');
		PDF::setJPEGQuality(100);
		PDF::SetFillColor(255, 255, 255);
		
		$x = $margin_left;
		$y = $start;
		
		PDF::Image(asset('vendor/luthansa/img/logo-medium.png'), $x, $y, 60, 20, 'PNG', 'http://www.luthansa.co.id', '', true, 100, '', false, false, 0, false, false, false);
		
		$x = $x + 140;$y=$y+2;
		PDF::SetFont('Helvetica','BU',18,'','false');
		PDF::SetTextColor(255,102,0);
		PDF::SetXY($x,$y=$y);
		PDF::Cell(180,10,strtoupper(Lang::get('printer.receipt')),0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetXY($x,$y=$y+15);
		PDF::SetFont('Helvetica','B',10,'','false');
		PDF::Cell(180,10,strtoupper(Lang::get('printer.number')).' : #'.$sales_invoice_payment->number,0,0,'L',false,'',0,10,'T','M');
		
		PDF::SetFont('Helvetica','',8,'','false');
		PDF::SetXY($x=$margin_left+5,$y=24);
		PDF::SetXY($x,$y=$y);
		PDF::Cell(180,8,strtoupper(Setting::get('company_name')),0,0,'L',false,'',0,8,'T','M');
	
        PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,8,Setting::get('company_address').' '.Setting::get('company_city').' '.Setting::get('company_zip_code'),0,0,'L',false,'',0,8,'T','M');
		
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,8,Setting::get('company_telephone_number').' ('.Lang::get('global.hunting').')',0,0,'L',false,'',0,8,'T','M');
		
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,8,Setting::get('company_email'),0,0,'L',false,'',0,8,'T','M');
		
		PDF::SetXY($x,$y=$y+5);
		PDF::Cell(180,8,Setting::get('company_website'),0,0,'L',false,'',0,8,'T','M');
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.5,'color'=>array(255,102,0)));
        PDF::Line($x,$y,$x+180,$y); //top
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.3,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+180,$y); //top
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.3,'color'=>array(105,105,105)));
        PDF::Line($x,$y+28,$x+180,$y+28); //bottom
		
		$x = $x;
		$y = $y-8;
		PDF::SetLineStyle(array('width'=>0.3,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x,$y+36); //left
		
		$x = $x;
		$y = $y;
		PDF::SetLineStyle(array('width'=>0.3,'color'=>array(105,105,105)));
        PDF::Line($x+180,$y,$x+180,$y+36); //right
		
		PDF::SetTextColor(105,105,105);
		
		$x = $margin_left+10;
		$y = $y;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(30,10,strtoupper(Lang::get('printer.receipt from')),0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+40,$y=$y);
		PDF::Cell(5,10,":",0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+45,$y=$y);
		PDF::Cell(90,10,strtoupper($sales_invoice_payment->customer_name),0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.1,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+40,$y); //top
		
		$x = $margin_left+10;
		$y = $y;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(30,10,strtoupper(Lang::get('printer.total money')),0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+40,$y=$y);
		PDF::Cell(5,10,":",0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+45,$y=$y);
		PDF::Cell(90,10,strtoupper(be_regarded($sales_invoice_payment->value)),0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.1,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+40,$y); //top
		
		$x = $margin_left+10;
		$y = $y;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(30,10,strtoupper(Lang::get('printer.percentage')),0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+40,$y=$y);
		PDF::Cell(5,10,":",0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+45,$y=$y);
		PDF::Cell(90,10,number_format($sales_invoice_payment->percentage,2).' %',0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.1,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+40,$y); //top
		
		$x = $margin_left+10;
		$y = $y;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(30,10,strtoupper(Lang::get('printer.for payment')),0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+40,$y=$y);
		PDF::Cell(5,10,":",0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y;
		PDF::SetXY($x+45,$y=$y);
		PDF::Cell(90,10,strtoupper($sales_invoice_payment->description ? $sales_invoice_payment->description : Lang::get('printer.payment invoice').' #'.$sales_invoice_payment->number ).' ',0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.1,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+40,$y); //top
		
		$x = $margin_left+5;
		$y = $y + 8;
		PDF::SetLineStyle(array('width'=>0.5,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+60,$y); //top
		
		$x = $x;
		$y = $y+10;
		PDF::SetLineStyle(array('width'=>0.5,'color'=>array(105,105,105)));
        PDF::Line($x,$y,$x+60,$y); //bottom
		
		$x = $x;
		$y = $y-10;
		PDF::SetFont('Helvetica','B',18,'','false');
		PDF::SetXY($x,$y=$y);
		PDF::Cell(60,10,"Rp. ".number_format($sales_invoice_payment->value,2),0,0,'L',false,'',0,10,'T','M');
		
		
		PDF::SetFont('Helvetica','B',8,'','false');
		$x = $x+130;
		$y = $y-5;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(60,10,Setting::get('company_city').', '.$sales_invoice_payment->payment_date,0,0,'L',false,'',0,10,'T','M');
		
		$x = $x;
		$y = $y+15;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(60,10,$sales_invoice_payment->customer_name,0,0,'C',false,'',0,10,'T','M');
		
		
		$x = $x;
		$y = $y+5;
		PDF::SetXY($x,$y=$y);
		PDF::Cell(60,10,"( ".Lang::get("printer.customer")." )",0,0,'C',false,'',0,10,'T','M');
		
		if($folder != '') {
			PDF::Output(public_path($folder.'/receipt-'.$sales_invoice_payment->id.'.pdf'),$output);
		} else {
			PDF::Output("receipt-".$sales_invoice_payment->id.".pdf",$output);
		}
	}
	
}