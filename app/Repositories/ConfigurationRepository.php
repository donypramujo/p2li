<?php
namespace App\Repositories;


use App\Configuration;

class ConfigurationRepository {
	
	public  function get($key){
		$config = Configuration::where('key',$key)->first();
		return $config->value;
	}
	
	public  function getConfig($key){
		$config = Configuration::where('key',$key)->first();
		return $config;
	}
	
}