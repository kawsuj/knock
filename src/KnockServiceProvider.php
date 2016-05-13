<?php 

namespace Knock;
 
use Illuminate\Support\ServiceProvider;

class KnockServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		if (! $this->app->routesAreCached()) {
	    	require __DIR__.'/Http/routes.php';
	    }	    
	    
		$this->loadViewsFrom(__DIR__.'/views', 'knock');
	
	    /* $this->publishes([
	        __DIR__.'/views' => resource_path('views/kawsuj/knock'),
	    ]); */
	   
	    $this->publishes([
	    		__DIR__.'/public' => public_path(),
	    ], 'knock'); 

	    $this->publishes([
	    		__DIR__.'/Http/middleware/' => app_path('Http/Middleware')
	    ], 'knock');	    
	
	    $this->publishes([
	    		__DIR__.'/database/migrations/' => database_path('migrations')
	    ], 'knock');	    
	
	    $this->publishes([
	    		__DIR__.'/database/seeds/' => database_path('seeds')
	    ], 'knock');	    
    
	    $this->publishes([
	    		__DIR__.'/App/' => app_path('/')
	    ], 'knock');
	     
	    $this->publishes([
	    		__DIR__.'/Config/knock.php' => config_path('knock.php')
	    ], 'knock');
	}
	
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind('knock', 'App\KnockDelegate');
	
		config([
				'config/knock.php',
		]);
	}
}
