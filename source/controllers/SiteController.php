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
 * Description of SiteController
 *
 * @author guay
 */
class SiteController extends BaseController{

    function indexAction(){
        return $this->render('site/index_page',[]);
    }
    function contactsAction(){
        return "contactsAction";
    }
    function signupAction(){
        return "signupAction";
    }
    function signinAction(){
        return "signinAction";
    }
}