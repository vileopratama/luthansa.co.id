<?php
namespace App\Modules\Setting\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
	/**
	 * Register the Setting module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Setting\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Setting module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('setting', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('setting', base_path('resources/views/vendor/setting'));
		View::addNamespace('setting', realpath(__DIR__.'/../Resources/Views'));
	}
}
