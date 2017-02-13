<?php
namespace App\Modules\SalesOrder\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\SalesOrder\Database\Seeds\FoobarTableSeeder');
	}

}
