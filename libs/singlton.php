<?php
class singlton {
    public static $intanceNb = 0;
    private static $currentConn = NULL;
    static function createDBInst(){
        if(!self::$currentConn){
            self::$currentConn = new Database('mysql:dbname='.DB_NAME.';host=localhost', DB_USERNAME, DB_PASSWORD);
        }else{
            //do nothing
        }
        self::$intanceNb++;
        return self::$currentConn;
    }
}    
    