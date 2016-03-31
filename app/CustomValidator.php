<?php
namespace App;
class  CustomValidator {
    public function rate($attribute, $value, $parameters, $validator){
    	dd($validator->getData());
    	
    	
    	
    	
    	return $value == 'foo';
    }
}