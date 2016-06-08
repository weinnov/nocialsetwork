<?php
sessions::startSession();
if(isset($_GET['url'])){
  $url = rtrim($_GET['url'], '/');
  $url = filter_var($url, FILTER_SANITIZE_URL);
  $url = explode('/', $url);  
}else{
    $url = null;
}


if(empty($url)){
    require 'controllers/index.php';
    $controller = new index();
    $controller->loadModel('index');
    $controller->index();
    exit;
}


$filepath = 'controllers/'.$url[0].'.php';
if(file_exists($filepath)){
    require $filepath;
    $controller = new $url[0](); //load controler
    $controller->loadModel($url[0]); //load all models including current $url[1] MODEL NAME = CONTROLER NAME
}else{
    die("Le fichier class $url[0].php n'existe pas");
    exit;
}


$length = count($url);
switch ($length) {
    case 3: //class + methode + argument
        $controller->$url[1]($url[2]);
        break;
    case 2: //with meth but no argument
        if(method_exists($url[0], $url[1])){
            $controller->$url[1]();
        }else{
            die("Methode $url[1]() n'existe pas");
        }
        break;
    case 1: //class only 
        $controller->index();
        break;
    default:
        //error;
}
