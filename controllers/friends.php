<?php

class friends extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->views->title = "My friends";
        require 'models/members_model.php';
        $this->modelFromMembers = new members_model;
        
        
        if ($this->modelFromMembers->loadUserSession()) {
            $this->views->dispAsConected = true;
            $this->currUserData = $this->modelFromMembers->getUserData();
            $this->views->nom = $this->currUserData['fullname'];
            $this->views->arrayRelShips = $this->modelFromMembers->getCurrUserRelships() ;
           
            $this->views->render('header');
            $this->views->render('friends/index');
        } else {
            $this->views->nom = "Guest user";
            $this->views->render('header');
            $this->views->render('friends/notlogged');
        }
        $this->views->render('footer');
    }

}
