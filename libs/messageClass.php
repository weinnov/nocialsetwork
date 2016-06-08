<?php

class messageClass {

    private $author;
    private $receiver;
    private $contents;
    private $id = 0;
    static $database;

    function __construct($argId) {
        $this->id = $argId;
    }

    static function getAllMsgIdFor($argOwnerUname) {
        $arrayCond = array('receiver' => $argOwnerUname);
        //$AllMsgId = self::$database->selectDB('messages',$arrayCond);
        $AllMsgId = self::$database->selectDBgetCol('messages', $arrayCond, 'msgID');
        //print_r($AllMsgId);
        return empty($AllMsgId) ? false : $AllMsgId['msgID'];
    }

    function loadTheMsgFromDB() {
        //$this->id = $ardMsgId;
        $arrayCond = array('msgID' => $this->id);
        $allFoundMsg = self::$database->selectDB('messages', $arrayCond);
        return $allFoundMsg[0];
    }

    function deleteMessage() {
        $arrayCond = array('msgID' => $this->id);
        return self::$database->deleteFromDB('messages', $arrayCond);
    }

    function saveTheMsgToDB($argSender,$argReceiver,$argMsgCotent,$argPrivate) {
        $newMsgData = array(
            'sender'=> $argSender ,
            'receiver'=> $argReceiver,
            'msgCotent'=> $argMsgCotent,
            'private'=> $argPrivate,
            'MsgDate'=> time());
        return self::$database->insertDB('messages', $newMsgData);
    }

}
