<?php
class HashTools {
    function __construct() {
        
    }
    static function hashPassword($argValue){
        return hash('ripemd128', PASS_SALT1.$argValue.PASS_SALT2);
    }
    
    static function createRandToken($argValue){
        return hash('ripemd128', TOKEN_SALT1.$argValue.rand(1,999));
    }

}