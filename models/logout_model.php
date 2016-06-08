<?php

class logout_model extends models {

    function __construct() {
        parent::__construct();
        $this->users = new users('guest');
    }

    function loadUserSession() {
        return $this->users->checkSessValidity();
    }

    function removeAuthFromDB($argUname) {
        $this->authentication->delAuthSessFromDB($argUname);
    }

    function getUserUname(){
        return $this->users->userUname;
    }
}
