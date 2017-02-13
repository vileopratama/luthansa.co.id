<?php
namespace App\Modules\SalesInvoice\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SalesInvoiceServiceProvider extends ServiceProvider
{
	/**
	 * Register the Sales Invoice module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\SalesInvoice\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Sales Invoice module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('sales-invoice', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('sales-invoice', base_path('resources/views/vendor/sales-invoice'));
		View::addNamespace('sales-invoice', realpath(__DIR__.'/../Resources/Views'));
	}
}
