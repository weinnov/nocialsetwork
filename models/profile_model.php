<?php

class profile_model extends models {

    function __construct() {
        parent::__construct();
        $this->users = new users('guest');
        $this->users->checkSessValidity();
    }
    
    function loadUserSession(){
        return $this->users->checkSessValidity();
    }
    
    function getCurrentProfile(){
        return $this->users->getProfileContents();    
    }
    
    function getUserData(){
        return $this->users->getUserDetails();
    }
    
    function getUserUname(){
        return $this->users->userUname;
    }
    

    function updateProfile($NewProfileData) {
        $this->users->updateProfileDB($NewProfileData, $this->users->userUname);
    }
    
}
