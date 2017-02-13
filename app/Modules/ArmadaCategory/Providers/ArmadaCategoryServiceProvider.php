<?php
namespace App\Modules\ArmadaCategory\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ArmadaCategoryServiceProvider extends ServiceProvider
{
	/**
	 * Register the Armada Category module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\ArmadaCategory\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Armada Category module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('armada-category', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('armada-category', base_path('resources/views/vendor/armada-category'));
		View::addNamespace('armada-category', realpath(__DIR__.'/../Resources/Views'));
	}
}
