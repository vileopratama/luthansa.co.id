<?php
namespace App\Modules\SalesOrder;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class SalesOrderDetail extends Model{
	//use Sortable;
    protected $table = 'sales_order_details';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['sales_order_id', 'armada_category_id','price'];

}