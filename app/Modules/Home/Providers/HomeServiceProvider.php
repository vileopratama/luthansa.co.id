<?php
namespace App\Modules\Home\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
	/**
	 * Register the Home module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Home\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Home module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('home', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('home', base_path('resources/views/vendor/home'));
		View::addNamespace('home', realpath(__DIR__.'/../Resources/Views'));
	}
}
