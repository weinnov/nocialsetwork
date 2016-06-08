<?php
class login extends Controller{
    private $passWord;
    private $currUserData;

    function __construct() {
        parent::__construct();

    }
    function index(){
        $this->views->dispAsConected = false;
        $this->views->title = "Login";
        if(isset($_GET['status'])){
            $this->views->message = "Login failed";
            $this->views->otherMsgClass = "warningTxt";
        }else{
            $this->views->message = "Welcome, please enter your login details bellow";
        }
        
        $this->views->nom = "Guest";
        
        $this->views->render('header');
        $this->views->render('login/index');
        $this->views->render('footer');
    }
    function login(){
        $this->formulaire = new formulaire();
        $this->formulaire->setPost('username')
                ->verifyField('minlenght')
                ->setPost('password')
                ->verifyField('minlenght')
                ->submit();
        
        $this->logUserName = $this->formulaire->getPost('username');
        $this->logPassWord = $this->formulaire->getPost('password');
        $currUserData = $this->model->connectTheUser($this->logUserName,$this->logPassWord);
         
    }

}
