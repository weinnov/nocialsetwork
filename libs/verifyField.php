<?php
class verifyField {

    function __construct() {
        
    }
    function minlenght($argFieldVal){
        if(strlen($argFieldVal)>10){
            return false;
        }
        else{
            return "Some field contents are not long enough";
        }
    }
    function validEmail($argFieldVal){
        if(true){
            return false;
        }else{
            return "$argFieldVal is no a valid email";
        }
    }

}