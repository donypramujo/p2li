<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use App\Contestant;

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
    	
    	
    	Validator::extend('nominate', function($attribute, $value, $parameters, $validator) {
    		$data = $validator->getData();
    		$contestant = Contestant::find($value);
    		dd($value);
    		return $contestant->nomination == TRUE ? FALSE : TRUE;
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
