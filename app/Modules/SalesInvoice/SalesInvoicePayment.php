<?php
namespace App\Modules\SalesInvoice;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SalesInvoicePayment extends Model{
	use Sortable;
    protected $table = 'sales_invoice_payments';
    protected $fillable = ['sales_invoice_id','payment_date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    public $sortable = ['sales_invoice_id', 'description','payment_date'];

}