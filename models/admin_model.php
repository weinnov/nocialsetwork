<?php
class admin_model extends models {
    private $usersNumber;

    function __construct() {
        parent::__construct();
        $this->users = new users('guest');
    }

    function loadUserSession() {
        return $this->users->checkSessValidity();
    }

    function getUserRole(){
        return $this->users->getTheRole();
    }    

    function getUserData() {
        return $this->users->getUserDetails();
    }

    function getAllUsersData() {
        $allUserName = $this->database->selectAllDB('usertable', 'username')['username'];
        foreach ($allUserName as $key => $value) {
            $this->users = new users($value);
            $allUsersData [$value] = $this->users->getAllCurrUserData();
        }
        return $allUsersData;
    }
    
    function getUsersNumber(){
        return $this->database->selectCountDB('usertable', 'username', NULL);   
    }
    
    function delAllDataFor($argUsername){
        return $this->users->delAllDataFor($argUsername);
    }
    
    function deleteAllUsers(){
        $this->database->emptyDB('friendship');
        $this->database->emptyDB('messages');
        $this->database->emptyDB('profile');
        $this->database->emptyDB('sessiontable');
        $this->database->emptyDB('usertable');
        
    }
    
    function deleteAllSess(){
        $this->database->emptyDB('sessiontable');  
    }
}
