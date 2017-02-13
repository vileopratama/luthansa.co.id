<?php
namespace App\Modules\Home\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Modules\SalesInvoice\SalesInvoicePayment;
use Crypt;
use File;
use Lang;
use Mail;
use Theme;

class HomeController extends Controller {
	public function index() {
		return Theme::view('home::index');
	}
}
