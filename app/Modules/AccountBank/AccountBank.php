<?php
namespace App\Modules\AccountBank;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class AccountBank extends Model{
	//use Sortable;
    protected $table = 'accounts';
    protected $fillable = ['account_no','account_name','bank_id'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['id', 'account_no','account_name'];
	
	public static function list_dropdown() {
		$account_banks = self::join('banks','banks.id','=','accounts.bank_id')
		->selectRaw("accounts.id,CONCAT(banks.name,' ',accounts.account_no,' a/n ',accounts.account_name) as name")
		->where('accounts.is_active',1)
		->get();
		$list = array();
		$list[0] = "";
		if($account_banks) {
			foreach($account_banks as $key => $account) {
				$list[$account->id] = $account->name;
			}
		}
		return $list;
	} 

}