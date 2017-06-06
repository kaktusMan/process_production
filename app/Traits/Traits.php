<?php

namespace App\Traits;

trait OptionsArray 
{
    public static function getOptionsArray($attribute = 'nume') 
    {	
    	return self::orderBy($attribute, 'asc')->pluck($attribute, 'id')->all();
    }
}