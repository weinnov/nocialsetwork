<?php

class profile extends Controller {

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
            $this->views->render('profile/index');
            $this->views->render('footer');
        } else {
            $this->views->title = "My profile";
            $this->views->nom = "Guest user";
            $this->views->render('header');
            $this->views->render('profile/notlogged');
            $this->views->render('footer');
            exit;
        }
    }

    public function updtProfile() {
        $this->formulaire = new formulaire;
        $this->formulaire->setPost('aboutMe')
                ->verifyField('minlenght')
                ->setPost('myTitle')
                ->verifyField('minlenght')
                ->saveImg('myAvatar')
                ->moveCurrentFile()
                ->submit();

        //$this->loadModel('index');
        $newProfileData = array(
            'username' => $this->model->getUserUname(),
            'avatar' => $this->formulaire->getFile('myAvatar'),
            'title' => $this->formulaire->getPost('myTitle'),
            'aboutMe' => $this->formulaire->getPost('aboutMe')
        );
        $this->model->updateProfile($newProfileData);
        header('Location: /profile');
    }
}
