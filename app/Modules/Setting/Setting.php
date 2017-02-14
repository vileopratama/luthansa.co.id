<?php
namespace App\Modules\Setting;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class Setting extends Model{
	//use Sortable;
    protected $table = 'settings';
    protected $fillable = ['name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['id', 'key','value'];
	
	public static function get($key) {
		$query = self::where('key',$key)->first();
		if(!$query) {
			$value = '';
		} else {
			$value = $query->value;
		}
		return $value;
	} 

}