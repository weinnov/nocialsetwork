<?php
class signup_model extends models{

    function __construct() {
        parent::__construct();
        $this->users = new users('guest');
    }

    function loadUserSession(){
        return $this->users->checkSessValidity();
    }
    
    function getUserData(){
        return $this->users->getUserDetails();
    }
    
    function isUnameOk($argUname){
        $arrayCond['username'] = $argUname;
        return (count($this->database->selectDB('usertable',$arrayCond)) > 0) 
                ? false 
                : true;
    }
    
    function saveUserData($ArgNewUserData){
        $ArgNewUserData['userhpass'] = HashTools::hashPassword($ArgNewUserData['password']);
        unset($ArgNewUserData['password']);
        $this->database->insertDB('usertable',$ArgNewUserData);
        
        $newUname = $ArgNewUserData['username'];
        $this->users = new users($newUname);
        $this->users->initialiseUser();
    }

}
