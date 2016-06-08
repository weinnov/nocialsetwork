<?php

class members_model extends models {

    function __construct() {
        parent::__construct();
        $this->users = new users('guest');
    }

    function loadUserSession() {
        return $this->users->checkSessValidity();
    }

    function getUserData() {
        return $this->users->getUserDetails();
    }

    function getAllUsersData($strColLists) {
        return $this->database->selectAllDB('usertable', $strColLists);
    }

    function getCurrUserRelships() {
        $allUserData = $this->getAllUsersData('username,fullname');
        $allUserNames = $allUserData['username'];

        $index = 0;
        foreach ($allUserNames as $anUser) {
            $isFollower = $this->users->isFollowerOfThis($anUser);
            $isFollowed = $this->users->isFollowedByThis($anUser);


            if ($anUser == $this->users->userUname) {
                $friendShip = 'self';
            } else {

                if ($isFollower && $isFollowed) {
                    $friendShip = 'mutual';
                } elseif ($isFollower) {
                    $friendShip = 'follower';
                } elseif ($isFollowed) {
                    $friendShip = 'followed';
                } else {
                    $friendShip = 'noone';
                }
            }

            $arrayRelShips[$index]['username'] = $anUser;
            $arrayRelShips[$index]['friendship'] = $friendShip;
            $index ++;
        }
        return $arrayRelShips;
    }
    
    static function createMsgFromRel($argRelShip){
        switch ($argRelShip){
            case 'mutual':
                $msgFromRel['relation'] = "↔ is a mutual friend";
                $msgFromRel['actiontxt'] = "Drop";
                $msgFromRel['actionlink'] = "members/remove"; 
                break;
            case 'follower':
                $msgFromRel['relation'] = "→ is following you";
                $msgFromRel['actiontxt'] = "Recip";
                $msgFromRel['actionlink'] = "members/add";  
                break;
            case 'followed':
                $msgFromRel['relation'] = "← followed by Me"; //Me is $this->users
                $msgFromRel['actiontxt'] = "Drop";
                $msgFromRel['actionlink'] = "members/remove";
                break;
            case 'noone':
                $msgFromRel['relation'] = "✘ no relationship";
                $msgFromRel['actiontxt'] = "Follow";
                $msgFromRel['actionlink'] = "members/add";
                break;
            case 'self':
                $msgFromRel['relation'] = "It's you";
                $msgFromRel['actiontxt'] = "See friends message";
                $msgFromRel['actionlink'] = "/messages/view";                
        }
        return $msgFromRel;
    }

    function addRelShip($argAnyUser) {
        $this->users->follow($argAnyUser);
    }

    function deleteRelShip($argAnyUser) {
        $this->users->unfollow($argAnyUser);
    }

}
