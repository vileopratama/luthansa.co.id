<?php
namespace App\Modules\SalesInvoice\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\SalesInvoice\Database\Seeds\FoobarTableSeeder');
	}

}
