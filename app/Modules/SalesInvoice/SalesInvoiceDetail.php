<?php
namespace App\Modules\SalesInvoice;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SalesInvoiceDetail extends Model{
	use Sortable;
    protected $table = 'sales_invoice_details';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    public $sortable = ['sales_order_id', 'armada_category_id','price'];

}