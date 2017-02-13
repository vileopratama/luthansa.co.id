<?php
namespace App\Modules\SalesInvoice;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SalesInvoiceExpense extends Model{
	use Sortable;
    protected $table = 'sales_invoice_expense';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    public $sortable = ['sales_invoice_id', 'description','expense'];

}