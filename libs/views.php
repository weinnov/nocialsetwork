<?php
class views {

    function __construct() {
        
    }
    function render($argFilePath){
        require 'views/'.$argFilePath.'.php';

    }
}
