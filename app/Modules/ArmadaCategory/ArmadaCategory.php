<?php
namespace App\Modules\ArmadaCategory;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class ArmadaCategory extends Model{
	//use Sortable;
    protected $table = 'armada_categories';
    protected $fillable = ['name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['id', 'name'];
	
	public static function list_dropdown() {
		$categories = self::where('is_active',1)->get();
		$list = array();
		if($categories) {
			foreach($categories as $key => $category) {
				$list[$category->id] = $category->name;
			}
		}
		return $list;
	} 

}