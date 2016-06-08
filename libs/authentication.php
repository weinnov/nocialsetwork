<?php
class authentication{
    private $createdSession = array();

    function __construct() {
        try {
            $this->database = singlton::createDBInst();
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) { echo 'Connection failed: ' . $ex->getMessage();};
        //echo (singlton::$intanceNb);            
    }
  
    function sendAuthToken($argUsername,$argPassword){ 
        $arrayCond = array('username'=> $argUsername , 'userhpass'=> HashTools::hashPassword($argPassword));
        if (count( $this->database->selectDB('usertable',$arrayCond) ) > 0){
            $this->username = $argUsername;
            $this->sessToken = HashTools::createRandToken($argPassword);
            $this->createdSession = array(
                'username' => $argUsername,
                'sessToken' => HashTools::createRandToken($argPassword),
                'loginDate' => time());
            
            sessions::setSession('username', $this->createdSession['username']);
            sessions::setSession('sessToken',$this->createdSession['sessToken']);       
            return true;
        }else{
            return false;
        }
    } 
    
    function saveAuthToken(){
        if(isset($this->createdSession['username'])){
            $this->delAuthSessFromDB($this->createdSession['username']); //delete all previous session
            return $this->database->insertDB('sessiontable',$this->createdSession);    
        }
        return false;
    }
    
    function delAuthSessFromDB($argUname){
        return $this->database->deleteFromDB('sessiontable', array('username'=>$argUname));
    }
        
}