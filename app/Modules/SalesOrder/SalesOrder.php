<?php
namespace App\Modules\SalesOrder;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class SalesOrder extends Model{
	//use Sortable;
    protected $table = 'sales_orders';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['id', 'order_date','due_date'];

}