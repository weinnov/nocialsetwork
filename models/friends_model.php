<?php

class friends_model extends models {

    function __construct() {
        //nothing to add here (friends controller use members model)
    }

    static function createMsgFromRel($argRelShip) {
        switch ($argRelShip) {
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
                $msgFromRel['actiontxt'] = "See all friends";
                $msgFromRel['actionlink'] = "friends";
        }
        return $msgFromRel;
    }

}
