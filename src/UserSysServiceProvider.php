<?php

namespace Qumonto\UserSys;

use Illuminate\Support\ServiceProvider;

class UserSysServiceProvider extends ServiceProvider {

	/**
	 * Register the bindings
	 * 
	 * @return void
	 **/
	public function register()
	{
		# code...
	}

	/**
	 * Post registration booting of services.
	 * 
	 * @return void
	 **/
	public function boot()
	{
		if(!$this->app->routesAreCached()) {
			require __DIR__.'/Http/routes.php';	
		}

		$this->loadViewsFrom(__DIR__.'/views', 'usersys');

		$this->publishes([
				__DIR__.'/config/usersys.php' => config_path('usersys.php')
			], 'config');

		$this->publishes([
				__DIR__.'/migrations/' => database_path('migrations')
			], 'migrations');

		$this->publishes([
				__DIR__.'/assets/css/' => public_path('css/')
			], 'assets');
	}
}