<?php

class members extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->views->title = "Members";
        if ($this->model->loadUserSession()) {
            $this->views->dispAsConected = true;
            $this->currUserData = $this->model->getUserData();
            $this->views->nom = $this->currUserData['fullname'];

            $this->views->arrayRelShips = $this->model->getCurrUserRelships();
            $this->views->membersNum = count($this->model->getAllUsersData('username')['username']);

            $this->views->render('header');
            $this->views->render('members/index');
        } else {
            $this->views->nom = "Guest user";
            $this->views->render('header');
            $this->views->render('members/notlogged');
        }
        $this->views->render('footer');
    }

    function add($argAnyUser) {
        if ($this->model->loadUserSession()) {
            $this->model->addRelShip($argAnyUser);
            if (isset($_GET['return'])){header('Location: /friends');
            }else{header('Location: /members');}  
        } else {
            header('Location: /login');
        }
    }
    
    function remove($argAnyUser){
        if ($this->model->loadUserSession()) {
            $this->model->deleteRelShip($argAnyUser);
            
            if(isset($_GET['return'])){header('Location: /friends'); 
            }else{header('Location: /members'); }
                
        } else {
            header('Location: /login');
        }        
    }

}
