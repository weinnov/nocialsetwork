<?php

class logout extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->views->title = "Logout";
        if ($this->model->loadUserSession()) {
            $this->model->removeAuthFromDB($this->model->getUserUname());
            $this->views->dispAsConected = false;
            
            $this->views->nom = "Guest";
            $this->views->message = "⇒You are now logged out";

            $this->views->render('header');
            $this->views->render('logout/index');
            $this->views->render('footer');
            sessions::closeSession();
        }else{
             header('Location: /login');
        }
    }

}
