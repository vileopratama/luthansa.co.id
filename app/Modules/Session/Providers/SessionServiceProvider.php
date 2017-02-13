<?php
namespace App\Modules\Session\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
	/**
	 * Register the Session module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Session\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Session module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('session', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('session', base_path('resources/views/vendor/session'));
		View::addNamespace('session', realpath(__DIR__.'/../Resources/Views'));
	}
}
