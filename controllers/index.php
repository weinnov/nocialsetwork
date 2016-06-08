<?php

class index extends Controller {

    protected $views;
    private $formulaire;
    private $currUserData;
    
    function __construct() {
        parent::__construct();   
    }

    public function index() {
        
        if ($this->model->loadUserSession()){ 
            
            $this->views->dispAsConected = true;
            $profileData = $this->model->getCurrentProfile();
            $this->views->title = $profileData['title'];
            $this->views->userPic = $profileData['avatar'];
            $this->views->userDesc = $profileData['aboutMe'];

            $this->currUserData = $this->model->getUserData();
            $this->views->nom = $this->currUserData['fullname'];

            $this->views->render('header');
            $this->views->render('index/index');
            $this->views->render('footer');
        } else {
            $this->views->title = "Guest homepage";
            $this->views->nom = "Guest user";
            $this->views->render('header');
            $this->views->render('index/notlogged');
            $this->views->render('footer');
            exit;
        }
    }
}
