<?php
namespace App\Modules\Customer;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract {
	//use AuthenticatableContract, CanResetPasswordContract,Sortable;
    protected $table = 'customers';
    protected $fillable = ['name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
    //public $sortable = ['id', 'name','city','phone_number','mobile_number','city'];
	
	/**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */	
	public function getAuthId () {
		return $this->id;
	}
	
	 /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->id;
    }
	
	/**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
	
	/**
     * Get the token for the user.
     *
     * @return string
     */
    public function getRememberToken() {
        return $this->remember_token;
    }
	
	/**
     * Set the token for the user.
     *
     * @return string
     */
    public function setRememberToken($value) {
        $this->remember_token = $value;
    }
	
	/**
     * Get the Toke Name for the user.
     *
     * @return string
     */
    public function getRememberTokenName() {
        return 'remember_token';
    }
	
	/**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName() {
        // TODO: Implement getAuthIdentifierName() method.
    }
	
	public function getEmailForPasswordReset() {
		return $this->email;
	}
	
	public static function list_dropdown() {
		$customers = self::where('is_active',1)->get();
		$list = array();
		if($customers) {
			foreach($customers as $key => $customer) {
				$list[$customer->id] = $customer->name;
			}
		}
		return $list;
	} 

}