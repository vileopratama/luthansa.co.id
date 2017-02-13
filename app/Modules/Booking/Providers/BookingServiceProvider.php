<?php
namespace App\Modules\Booking\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider
{
	/**
	 * Register the Booking module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Booking\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Booking module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('booking', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('booking', base_path('resources/views/vendor/booking'));
		View::addNamespace('booking', realpath(__DIR__.'/../Resources/Views'));
	}
}
