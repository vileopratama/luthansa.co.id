<?php
namespace App\Modules\SalesInvoice;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SalesInvoiceCost extends Model{
	use Sortable;
    protected $table = 'sales_invoice_costs';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    public $sortable = ['sales_invoice_id', 'description','cost'];

}