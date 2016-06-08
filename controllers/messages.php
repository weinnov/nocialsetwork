<?php

class messages extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->views->title = "My status";
        if ($this->model->loadUserSession()) {
            $this->views->dispAsConected = true;
            $this->currUserData = $this->model->getUserData();
            $this->views->nom = $this->currUserData['fullname'];

            $this->views->messageData = $this->model->getAllMsgDatafor(
                    $this->model->getUserUname());
            $this->views->profilOwner = $this->model->getUserUname();
            $this->views->render('header');
            $this->views->render('messages/index');
        } else {
            $this->views->nom = "Guest user";
            $this->views->render('header');
            $this->views->render('members/notlogged');
        }
        $this->views->render('footer');
    }

    function view($argWallOwner) {
        if ($this->model->loadUserSession()) {
            $this->views->dispAsConected = true;
            $this->currUserData = $this->model->getUserData();
            $this->views->nom = $this->currUserData['fullname'];

            $this->views->messageData = $this->model->getAllMsgDatafor(
                    $argWallOwner);
            $this->views->profilOwner = $argWallOwner;
            $this->views->render('header');
            $this->views->render('messages/index');
        } else {
            $this->views->title = "Guest homepage";
            $this->views->nom = "Guest user";
            $this->views->render('header');
            $this->views->render('members/notlogged');
        }
        $this->views->render('footer');
    }

    function erase($argMsgId) {
        if ($this->model->loadUserSession()) {
            $this->currUserData = $this->model->getUserData();
            $this->model->deleteMsg($argMsgId);
            header('Location: /messages');
        } else {
            header('Location: /login');
        }
    }

    function submitto($argProfilOwner) {
        if ($this->model->loadUserSession()) {
            $this->formulaire = new formulaire;
            $this->formulaire->setPost('msgContent')
                    ->verifyField('minlenght')
                    ->setPost('private')
                    ->submit();
            //echo($this->formulaire->getPost('msgContent'));
            //echo($this->formulaire->getPost('private'));
            $this->model->saveMsg(
                    $argProfilOwner,
                    $this->formulaire->getPost('msgContent'),
                    $this->formulaire->getPost('private'));
            header("Location: /messages/view/$argProfilOwner");
        } else {
             header('Location: /login');
        }
    }

}
