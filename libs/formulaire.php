<?php
class formulaire {
    private $postData;
    private $filesData = array();
    private $currentField;
    private $verifyField;
    private $currentUpload = array(); //file name
    private $error = array();
    
    function __construct() {
        require 'libs/verifyField.php';
        $this->verifyField = new verifyField();
        
    }
    function setPost($argChamp){
        $this->postData[$argChamp] = $_POST[$argChamp];
        $this->currentField = $argChamp;
        return $this;
    }

    function saveImg($argChamp){
        switch ($_FILES[$argChamp]['type']) {
            case 'image/jpeg':
                $ext = 'jpeg';
                break;
            case 'image/png':
                $ext = 'png';
                break;
            default:
                $ext = '';
                break;
        }
        //print_r($_FILES);
        //die();
        if($_FILES[$argChamp]['type']){
            $this->currentUpload['filepath'] = $_FILES[$argChamp]['tmp_name'];
            $this->currentUpload['name'] = explode('.', $_FILES[$argChamp]['name'])[0];
            $this->currentUpload['extension'] = $ext;
            $this->currentField = $argChamp;
        }else{
            $this->error[] = "Fichier non valide";
        }
        return $this;
    }
    
    function moveCurrentFile(){
        $newLocation = UPLOAD_FOLDER.'uploadIMG_'.$this->currentUpload['name'].'.'.$this->currentUpload['extension'];
        move_uploaded_file ( $this->currentUpload['filepath'],$newLocation);
        $this->filesData[$this->currentField] = $newLocation;
        return $this;
    }
    
    function getPost($argChamp){
        return $this->postData[$argChamp];
    }
    function getFile($argChamp){
        return $this->filesData[$argChamp];
    }
    function getError(){
        $errorMsg = '';
        foreach ($this->error as $key => $value) {
            $errorMsg .= "$value <br>";
        }
        return $errorMsg;
    }
    
    function verifyField($typeOfValidat){
         if ($noError = $this->verifyField->$typeOfValidat($this->postData[$this->currentField]))
             $this->error[] = $noError;    
         
        return $this;
    }
    
    function submit(){
        if(empty($this->error)){
            return true;
        }else{
            return false;
        }
    }

}