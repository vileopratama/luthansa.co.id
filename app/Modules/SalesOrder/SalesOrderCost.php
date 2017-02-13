<?php
namespace App\Modules\SalesOrder;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SalesOrderCost extends Model{
	use Sortable;
    protected $table = 'sales_order_costs';
    protected $fillable = ['number','date'];
	protected $primaryKey = "id";
    public $timestamps = false;
    public $sortable = ['sales_order_id', 'description','cost'];

}