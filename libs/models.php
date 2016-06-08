<?php
class models {
    public $database;
    function __construct() {
        try {/*
            $this->database = new Database('mysql:dbname='.DB_NAME.';host=localhost', DB_USERNAME, DB_PASSWORD);*/ $this->database = singlton::createDBInst();
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) { echo 'Connection failed: ' . $ex->getMessage();};
        $this->authentication = new authentication();
        //echo ('(Request number: '.singlton::$intanceNb.')'); 
    }
        
}