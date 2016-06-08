<?php

class admin extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->model->loadUserSession() && ($this->model->getUserRole() == 'admin')) {
            $this->views->title = "Admin area";

            $this->views->dispAsConected = true;
            $this->currUserData = $this->model->getUserData();
            $this->views->nom = $this->currUserData['fullname'];

            $this->views->authorization = 'admin';
            $this->views->membersNum = $this->model->getUsersNumber()[0]['COUNT(username)'];
            $this->views->jsFile = '../public/js/users_data.js';

            $this->views->render('header');
            $this->views->render('admin/index');
            $this->views->render('footer');
        } else {
            $this->views->title = "Forbiden access";
            $this->views->nom = "Non-admin user";
            $this->views->render('header');
            $this->views->render('admin/forbiden');
            $this->views->render('footer');
            exit;
        }
    }

    function outputAjaxXML() {
        $allUserData = $this->model->getAllUsersData();
        $allUserDataJson = json_encode($allUserData);
        echo $allUserDataJson;
    }

    function deleteUsers($argUname) {
        $this->model->deleteAllUsers($argUname);
        header('Location: /admin');
    }
    
    function delSessions(){
        $this->model->deleteAllSess($argUname);
        header('Location: /admin');
    }

}
