<?php
class sessions {

    function __construct() {
        
    }
    static function setSession($sessionName,$value){
        $_SESSION[$sessionName] = $value;
        
        //$_SESSION['sessToken'];
    }
    static function getSession($sessionName){
        return $_SESSION[$sessionName];
    }
    static function closeSession(){
        session_destroy(); 
    }
    
    static function startSession(){
        session_start();
    }

}

