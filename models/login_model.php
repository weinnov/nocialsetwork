<?php

class login_model extends models {

    private $userData = array();
    public $loginResult;

    function __construct() {
        parent::__construct();
    }
    
    function connectTheUser($argUsername, $argPassword){
        if ($this->authentication->sendAuthToken($argUsername, $argPassword)){
            $this->authentication->saveAuthToken();
            $this->users = new users($argUsername);
            $this->userData = $this->users->getUserData();
            $this->loginResult = true;
            header('Location: /members');
        }else{
            header('Location: /login?status=failed');
        }
        return $this->userData;
    }    

}
