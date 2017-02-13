<?php
namespace App\Modules\Page\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
	/**
	 * Register the Page module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Page\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Page module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('page', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('page', base_path('resources/views/vendor/page'));
		View::addNamespace('page', realpath(__DIR__.'/../Resources/Views'));
	}
}
