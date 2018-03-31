<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

spl_autoload_register(function( $className ){

    if (file_exists( 'source/models' . strtolower( $className ) . '.php' ) )
    {
        require 'source/models/' . strtolower( $className ) . '.php';
    }elseif(file_exists( 'source/controllers/' . $className  . '.php' )){
        require 'source/controllers/' .  $className . '.php';
    }elseif(file_exists( 'source/models/' . strtolower( $className ) . '.php' )){
        require 'source/models' . strtolower( $className ) . '.php';
    }elseif(file_exists( 'source/helpers/' . strtolower( $className ) . '.php' )){
        require 'source/helpers/' . strtolower( $className ) . '.php';        
    }elseif(file_exists( 'source/config/' . strtolower( $className ) . '.php' )){
        require 'source/config/' . strtolower( $className ) . '.php';
    }else{        
        $message  = "Cannot load class: $className. ";
        $message .= "File '$className'.php not found!";
        throw new Exception( $message ); 
    }

    

});