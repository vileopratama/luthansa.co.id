<?php
namespace App\Modules\SalesInvoice;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class SalesInvoice extends Model{
	//use Sortable;
    protected $table = 'sales_invoices';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['id', 'order_date','due_date'];
	
	/**
	* Status
	* 0 = New
	  1 = Process
	  2 = Paid 
	  3 = Closed 
	**/
	

}