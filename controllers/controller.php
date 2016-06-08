<?php
class Controller {

    function __construct() {
        $this->views = new views();
        
    }
    function loadModel($argModelName){
       $modelName = $argModelName."_model";
       require "models/$modelName".".php";
       $this->model = new $modelName(); 
    }
    
}
