<?php
namespace App\Modules\AccountBank\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class AccountBankServiceProvider extends ServiceProvider
{
	/**
	 * Register the Account Bank module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\AccountBank\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Account Bank module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('account-bank', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('account-bank', base_path('resources/views/vendor/account-bank'));
		View::addNamespace('account-bank', realpath(__DIR__.'/../Resources/Views'));
	}
}
