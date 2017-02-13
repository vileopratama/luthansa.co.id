<?php
namespace App\Modules\SalesInvoice;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SalesInvoiceArmada extends Model{
	use Sortable;
    protected $table = 'sales_invoice_armada';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    public $sortable = ['sales_invoice_id', 'booking_from_date','booking_to_date'];

}