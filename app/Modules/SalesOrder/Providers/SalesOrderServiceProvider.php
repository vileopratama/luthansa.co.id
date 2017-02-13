<?php
namespace App\Modules\SalesOrder\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SalesOrderServiceProvider extends ServiceProvider
{
	/**
	 * Register the Sales Order module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\SalesOrder\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Sales Order module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('sales-order', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('sales-order', base_path('resources/views/vendor/sales-order'));
		View::addNamespace('sales-order', realpath(__DIR__.'/../Resources/Views'));
	}
}
