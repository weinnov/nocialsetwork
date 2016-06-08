<?php

class signup extends Controller {
    private $formulaire;
    private $newUserData;
    private $currUserData;

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->views->title = "Sign Up";
        if ($this->model->loadUserSession()) {
            $this->views->dispAsConected = true;
            $this->currUserData = $this->model->getUserData();
            $this->views->nom = $this->currUserData['fullname'];
            $this->views->render('header');
            $this->views->render('signup/logged'); 
        }else{
            $this->views->message = "Fill the form below to signup";
            $this->views->nom = "Guest";
            $this->views->jsFile = '../public/js/check_uname.js'; 
            $this->views->render('header');
            $this->views->render('signup/index');
        }
        $this->views->render('footer');           
    }

    function ajaxChekUname($uNameValue) {
        echo $this->model->isUnameOk($uNameValue);
    }

    function register() {
        $this->formulaire = new formulaire;
        $this->formulaire->setPost('username')
                ->verifyField('minlenght')
                ->setPost('password')
                ->verifyField('minlenght')
                ->setPost('fullname')
                ->verifyField('minlenght')
                ->submit();
        
        $this->newUserData = array(
            'username'=> $this->formulaire->getPost('username'),
            'password'=> $this->formulaire->getPost('password'),
            'fullname'=> $this->formulaire->getPost('fullname')
        );
        $this->model->saveUserData($this->newUserData);
        header('Location: /login');
    }

}
