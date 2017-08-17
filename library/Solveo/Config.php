<?php

namespace Solveo;

class Config {

    public static function get(){
        $config = include APP_DIR . '/app/config/config.php';
        
        $configObj = new \stdClass();
        foreach ($config as $key=>$value){
            if(is_array($value)){
                $valueObject = (object) $value;               
                    $configObj->{$key} = $valueObject;
            }            
           
        }
         return $configObj;

        
    }
}
    