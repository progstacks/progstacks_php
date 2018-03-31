<?php
if (!defined("app")) {
    die();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ConfigUtil{
    static function getAppConfig($name,$default){
        require 'source/config/appconfig.php';
        if(array_key_exists($name ,$config['app'])){
            return $config['app'][$name];
        }else{
            return $default;
        }
    }
}

?>
