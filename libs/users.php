<?php

class users extends models {

    public $userUname;
    private $sessionStatus;

    function __construct($argUserUname) {
        parent::__construct();
        $this->userUname = $argUserUname;
    }

    function checkSessValidity() {
        if (isset($_SESSION['sessToken']) && isset($_SESSION['username'])) {
            $arrayCond = array('username' => sessions::getSession('username'), 'sessToken' => sessions::getSession('sessToken'));
            if ((count($this->database->selectDB('sessionTable', $arrayCond)) > 0)) {
                $this->sessionStatus = true;
                $this->userUname = sessions::getSession('username');
            } else {
                $this->sessionStatus = false;
                $this->userUname = "Guest";
            }

            return $this->sessionStatus;
        }
    }

    function getProfileContents() {
        $arrayCond ['username'] = $this->userUname;
        $profContents = $this->database->selectDB('profile', $arrayCond);
        return (!empty($profContents)) ? $profContents[0] : false;
    }

    function getUserData() {

        $arrayCond['username'] = $this->userUname;
        $this->userData = $this->database->selectDB('usertable', $arrayCond)[0];
        $this->userData['message'] = "⇒You are alredy logged in " . $this->userData['fullname'];
        $this->loginStatus = true;
        $this->authentication->saveAuthToken();
        return $this->userData;
    }

    //lignes suivant initialement dans index model
    function sendProfileToDb($newProfileData) {
        $affectRow = $this->database->insertDB('profile', $newProfileData);
        echo($affectRow);
    }

    function getUserDetails() {
        $arrayCond ['username'] = $this->userUname;
        return $this->database->selectDB('usertable', $arrayCond)[0];
    }

    function updateProfileDB($newProfileData) {
        $arrayCond['username'] = $this->userUname;
        $this->database->updateDB($newProfileData, 'profile', $arrayCond);
    }

    function isConnected() {
        return $this->authentication->checkAuthStatus();
    }

    function getSessionStatus() {
        return $this->sessionStatus;
    }

    function isFollowerOfThis($argAnyUser) {
        return ((count($this->database->selectDB('friendship', array('username' => $this->userUname, 'folowedby' => $argAnyUser)))) > 0) ? true : false;
    }

    function isFollowedByThis($argAnyUser) {
        return ((count($this->database->selectDB('friendship', array('username' => $argAnyUser, 'folowedby' => $this->userUname))) ) > 0) ? true : false;
    }

    function follow($argAnyUser) {
        $arrNewRelShip = array('username' => $argAnyUser, 'folowedby' => $this->userUname);
        $this->database->insertDB('friendship', $arrNewRelShip);
    }

    function unfollow($argAnyUser) {
        $arrRelToDelete = array('username' => $argAnyUser, 'folowedby' => $this->userUname);
        $this->database->deleteFromDB('friendship', $arrRelToDelete);
    }

    function initialiseUser() {

        $adminUname = ADMIN_USER;
        $this->follow($adminUname);

        require 'libs/messageClass.php';
        $currMsgObj = new messageClass(0);
        messageClass::$database = singlton::createDBInst();
        $currMsgObj->saveTheMsgToDB($adminUname, $this->userUname, DEFAULT_MESSAGE, 0);

        $newProfileData = array(
            'username' => $this->userUname,
            'avatar' => DEFAUL_AVATAR,
            'title' => DEFAULT_TITLE,
            'aboutMe' => DEFAULT_ABOUT
        );

        messageClass::$database->insertDB('profile', $newProfileData);

        list($this->userUname, $adminUname) = array($adminUname, $this->userUname);
        $this->follow($adminUname);
    }

    function getAllCurrUserData() {
        $arrayCond ['username'] = $this->userUname;

        $userTable = $this->database->selectDB('usertable', $arrayCond)[0];
        $allCurrUserData ['username'] = $this->userUname;
        $allCurrUserData ['fullname'] = $userTable['fullname'];

        $sessionTable = $this->database->selectDB('sessiontable', $arrayCond);
        $allCurrUserData ['loginDate'] = (isset($sessionTable[0])) 
                ? date("F j, Y, g:i a",$sessionTable[0]['loginDate']) 
                : '';

        $profileTable = $this->database->selectDB('profile', $arrayCond)[0];
        $allCurrUserData ['title'] = $profileTable['title'];

        $arrayCond2['receiver'] = $this->userUname;
        $messageTableCol = $this->database->selectDBgetCol('messages', $arrayCond2, 'msgID');
        $allCurrUserData ['incomMsg'] = count($messageTableCol['msgID']);

        $friedshipTableCol = $this->database->selectDBgetCol('friendship', $arrayCond, 'id');
        $allCurrUserData ['followers'] = count($friedshipTableCol['id']);

        return $allCurrUserData;
    }

    function delAllDataFor($argUname) {
        try {
            $arrayCond = array('username' => $argUname);
            $this->database->deleteFromDB('friendship', $arrayCond);
            $arrayCond2 = array('folowedby' => $argUname);
            $this->database->deleteFromDB('friendship', $arrayCond2);

            $arrayCond3 = array('sender' => $argUname);
            $this->database->deleteFromDB('messages', $arrayCond3);
            $arrayCond4 = array('receiver' => $argUname);
            $this->database->deleteFromDB('messages', $arrayCond4);

            $this->database->deleteFromDB('profile', $arrayCond);
            $this->database->deleteFromDB('sessiontable', $arrayCond);
            $this->database->deleteFromDB('usertable', $arrayCond);
        } catch (Exception $ex) {
            echo 'Caught exception: ',  $ex->getMessage(), "\n";
            die();
        }
        return true;
    }
    
    function getTheRole(){ 
        return $this->getUserDetails()['role'];
    }

}
