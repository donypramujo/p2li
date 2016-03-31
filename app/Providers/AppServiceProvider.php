<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Blade::directive('sortablelink', function ($expression) {
    		return "<?php echo \App\Traits\Sortable::link(array {$expression});?>";
    	});
    	
    	
    	Validator::extend('total_rate', function($attribute, $value, $parameters, $validator) {
    		$data = array_except($validator->getData(), ['_token','name','id']);
    		$result = collect($data)->sum();
    		return $result == 100;
    	});
    	
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	
    }
}
