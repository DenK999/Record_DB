<?php

namespace Solveo;

class Config {    
    
    public static function get() {
        $config = include APP_DIR . '/app/config/config.php';
        
        echo '<pre>';
        
        $configObj = new \stdClass();
        
        Config::recArray($config, $configObj);
        
        return $configObj;
    }
    
    public static function recArray($array, $configObj){
        
        foreach ($array as $key =>$value) {            
            if (is_array($value)) {                 
                $configObj->{$key} = (object) $value;
                Config::recArray($value, $configObj->{$key});                  
            }            
        }          
    }

}
