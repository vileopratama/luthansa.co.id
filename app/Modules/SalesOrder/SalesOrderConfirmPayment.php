<?php
namespace App\Modules\SalesOrder;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class SalesOrderConfirmPayment extends Model{
	//use Sortable;
    protected $table = 'sales_order_confirm_payments';
    protected $fillable = ['sales_invoice_id','payment_date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['sales_invoice_id'];

}