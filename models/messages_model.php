<?php

class messages_model extends models {

    function __construct() {
        parent::__construct();
        $this->users = new users('guest');

        require 'libs/messageClass.php';
        messageClass::$database = singlton::createDBInst();
    }

    function loadUserSession() {
        return $this->users->checkSessValidity();
    }

    function getUserUname() {
        return $this->users->userUname;
    }

    function getAllMsgDatafor($argUserName) {
        $allMsgIds = messageClass::getAllMsgIdFor($argUserName);
        
        if ($allMsgIds) {
            foreach ($allMsgIds as $key => $iDvalue) {
                $currMsgObj = new messageClass($iDvalue);
                
                $allMsgData[$iDvalue] = $currMsgObj->loadTheMsgFromDB();
                $allMsgData[$iDvalue]['ownership'] = ($allMsgData[$iDvalue]['sender']== $this->users->userUname) 
                        ? true 
                        : false;
                
            }
            return $allMsgData;
        } else {
            return false;
        }
    }

    function getUserData() {
        return $this->users->getUserDetails();
    }
    
    function deleteMsg($argMsgId){
        
        $currMsgObj = new messageClass($argMsgId);
        $msgOwner = $currMsgObj->loadTheMsgFromDB()['sender'];
        if($msgOwner == $this->users->userUname){
            return $currMsgObj->deleteMessage();
        }else{
            die("You can only delete your own message");
        } 
    }
    
    function saveMsg($argReceiver,$argMsgCotent,$argPrivate){
        $currMsgObj = new messageClass(0);
        $currMsgObj->saveTheMsgToDB($this->users->userUname,$argReceiver,$argMsgCotent,$argPrivate);
    }
}
