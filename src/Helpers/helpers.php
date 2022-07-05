<?php
use Delgont\Cms\Models\Option\Option;



//returns a single option
if(!function_exists('option')){
    function option($option_key = null, $default = null){
        if($option_key != null){
            if(cache($option_key) != null){
                return cache($option_key);
            }else{
                $value = Option::findOption('option_key', $option_key)->first();
                return ($value) ? $value->option_value : $default;
            }
        }else{
            return $default;
        }
    }
}
