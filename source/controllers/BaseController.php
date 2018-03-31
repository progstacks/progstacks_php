<?php
if (!defined("app")) {
    die();
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author Resti
 */
abstract class BaseController {
    protected $_request=array();
    public function BaseController($request){
        $this->_request=$request;
    }
    public function error404(){
        echo 'Opps! Page "' . $this->_request[App::SERVER_QUERY_STRING] . '" not found.' ;
    }
    
    public function render($template, $param){
        ob_start();
        include('source/views/'.$template.'.php');
        $ret = ob_get_contents();
        ob_end_clean();
        return $ret;
    }
     
}
