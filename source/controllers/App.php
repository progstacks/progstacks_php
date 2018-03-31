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
 * Description of App
 *
 * @author Resti
 */
class App {

    const SERVER_HTTP_HOST = 'HTTP_HOST'; // => string 'localhost' (length=9)
    const SERVER_HTTP_USER_AGENT = 'HTTP_USER_AGENT'; //' => string 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:58.0) Gecko/20100101 Firefox/58.0' (length=73)
    const SERVER_HTTP_ACCEPT = 'HTTP_ACCEPT'; //' => string 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' (length=63)
    const SERVER_HTTP_ACCEPT_LANGUAGE = 'HTTP_ACCEPT_LANGUAGE'; //' => string 'en-US,en;q=0.5' (length=14)
    const SERVER_HTTP_ACCEPT_ENCODING = 'HTTP_ACCEPT_ENCODING'; //' => string 'gzip, deflate' (length=13)
    const SERVER_HTTP_CONNECTION = ''; //' => string 'keep-alive' (length=10)
    const SERVER_HTTP_UPGRADE_INSECURE_REQUESTS = 'HTTP_UPGRADE_INSECURE_REQUESTS'; //' => string '1' (length=1)
    const SERVER_HTTP_CACHE_CONTROL = 'HTTP_CACHE_CONTROL'; //' => string 'max-age=0' (length=9)
    const SERVER_PATH = 'PATH'; //' => string 'D:\dev\EasyPHP-DevServer-14.1VC9\binaries\php\php_runningversion;C:\WINDOWS\system32;C:\WINDOWS;C:\WINDOWS\System32\Wbem;C:\WINDOWS\System32\WindowsPowerShell\v1.0\;C:\Program Files\TortoiseHg\;C:\composer;C:\Program Files\nodejs\;C:\WINDOWS\system32\config\systemprofile\AppData\Local\Microsoft\WindowsApps' (length=307)
    const SERVER_SystemRoot = 'SystemRoot'; //' => string 'C:\WINDOWS' (length=10)
    const SERVER_COMSPEC = 'COMSPEC'; //' => string 'C:\WINDOWS\system32\cmd.exe' (length=27)
    const SERVER_PATHEXT = 'PATHEXT'; //' => string '.COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC' (length=53)
    const SERVER_WINDIR = 'WINDIR'; //' => string 'C:\WINDOWS' (length=10)
    const SERVER_SERVER_SIGNATURE = 'SERVER_SIGNATURE'; //' => string '&lt;address&gt;Apache/2.4.9 (Win64) PHP/5.5.12 Server at localhost Port 80&lt;/address&gt;' (length=91)
    const SERVER_SERVER_SOFTWARE = 'SERVER_SOFTWARE'; //' => string 'Apache/2.4.9 (Win64) PHP/5.5.12' (length=31)
    const SERVER_SERVER_NAME = 'SERVER_NAME'; //' => string 'localhost' (length=9)
    const SERVER_SERVER_ADDR = 'SERVER_ADDR'; //' => string '::1' (length=3)
    const SERVER_SERVER_PORT = 'SERVER_PORT'; //' => string '80' (length=2)
    const SERVER_REMOTE_ADDR = 'REMOTE_ADDR'; //' => string '::1' (length=3)
    const SERVER_DOCUMENT_ROOT = 'DOCUMENT_ROOT'; //' => string 'C:/wamp/www/' (length=12)
    const SERVER_REQUEST_SCHEME = 'REQUEST_SCHEME'; //' => string 'http' (length=4)
    const SERVER_CONTEXT_PREFIX = 'CONTEXT_PREFIX'; //' => string '' (length=0)
    const SERVER_CONTEXT_DOCUMENT_ROOT = 'CONTEXT_DOCUMENT_ROOT'; //' => string 'C:/wamp/www/' (length=12)
    const SERVER_SERVER_ADMIN = 'SERVER_ADMIN'; //' => string 'admin@example.com' (length=17)
    const SERVER_SCRIPT_FILENAME = 'SCRIPT_FILENAME='; //' => string 'C:/wamp/www/pabenta.ph/index.php' (length=32)
    const SERVER_REMOTE_PORT = 'REMOTE_PORT'; //' => string '62196' (length=5)
    const SERVER_GATEWAY_INTERFACE = 'GATEWAY_INTERFACE'; //' => string 'CGI/1.1' (length=7)
    const SERVER_SERVER_PROTOCOL = 'SERVER_PROTOCOL'; //' => string 'HTTP/1.1' (length=8)
    const SERVER_REQUEST_METHOD = 'REQUEST_METHOD'; //' => string 'GET' (length=3)
    const SERVER_QUERY_STRING = 'QUERY_STRING'; //' => string 'hello=world%27^!' (length=16)
    const SERVER_REQUEST_URI = 'REQUEST_URI'; //' => string '/pabenta.ph/index.php?hello=world%27^!' (length=38)
    const SERVER_SCRIPT_NAME = 'SCRIPT_NAME'; //' => string '/pabenta.ph/index.php' (length=21)
    const SERVER_PHP_SELF = 'PHP_SELF'; //' => string '/pabenta.ph/index.php' (length=21)
    const SERVER_REQUEST_TIME_FLOAT = 'REQUEST_TIME_FLOAT'; //' => string '1522426605.715' (length=14)
    const SERVER_REQUEST_TIME = 'REQUEST_TIME'; //' => string '1522426605' (length=10)

    private $_get = array();
    private $_post = array();
    private $_server = array();
    private $_request = array();

    public function App() {
        foreach ($_GET as $key => $value) {
            $this->_request[$key] = htmlspecialchars($_GET[$key]);
            $this->_get[$key] = htmlspecialchars($_GET[$key]);
        }
        foreach ($_POST as $key => $value) {
            $this->_request[$key] = htmlspecialchars($_POST[$key]);
            $this->_post[$key] = htmlspecialchars($_POST[$key]);
        }

        foreach ($_SERVER as $key => $value) {
            $this->_request[$key] = htmlspecialchars($_SERVER[$key]);
            $this->_server[$key] = htmlspecialchars($_SERVER[$key]);
        }
        $query = explode("/", $this->_request[self::SERVER_QUERY_STRING]);
        $controller = 'SiteController';
        $actionMethod = 'indexAction';
        if (count($query) == 1) {
            if ($query[0] != '') {
                $controller = ucfirst($query[0]) . 'Controller';
            }
        } elseif (count($query) > 1) {
            $controller = ucfirst($query[0]) . 'Controller';
            $actionMethod = strtolower($query[1]) . 'Action';
        }
        $content=[];
        $ctrl = null;
        try {
            $ctrl = new $controller($this->_request);
            $f = $this->get_method_closure($ctrl, $actionMethod);
            if(!method_exists($ctrl,$actionMethod)){
                $f = $this->get_method_closure($ctrl, 'error404');
            }
            $content['body'] = $f();            
        } catch (Exception $exc) {
            $content['exception'] = $exc->getTraceAsString();
        }
        echo $ctrl->render('site/templates/page',$content);

    }

    function get_method_closure($object, $method_name) {
        if (method_exists(get_class($object), $method_name)) {
            $func = create_function('', '
                                $args            = func_get_args();
                                static $object    = NULL;
                               
                                /*
                                * Check if this function is being called to set the static $object, which
                                * containts scope information to invoke the method
                                */
                                if(is_null($object) && count($args) && get_class($args[0])=="' . get_class($object) . '"){
                                    $object = $args[0];
                                    return;
                                }

                                if(!is_null($object)){
                                    return call_user_func_array(array($object,"' . $method_name . '"),$args);
                                }else{
                                    return FALSE;
                                }'
            );

            //Initialize static $object
            $func($object);

            //Return closure
            return $func;
        } else {
            return false;
        }
    }
}
