<!DOCTYPE HTML>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="/public/css/styles.css">
        <title><?php echo ($this->title.' >>'.SITE_TITLE) ?></title>
    </head>
    <body>
        <div id="page">
            <div id='header'>
                <img class='image-center' src='/public/images/logo.png'>
                <div>
                    <div id='status'>
                        <h1 id="msgHeader"><?php echo SITE_TITLE.' ('.$this->nom.')' ?></h1> 
                    </div>
                    <div>
                        <ul class='menu'>
                            <li><a href="/<?php echo URL ?>">Home</a></li>
                            <?php if (!(isset($this->dispAsConected) AND $this->dispAsConected == true)): ?>
                            <li><a href="/<?php echo URL ?>signup">Sign up</a></li>
                                <li><a href="/<?php echo URL ?>login">Log in</a></li>
                            <?php endif; ?>    
                            <li><a href="/<?php echo URL ?>members">Members</a></li>
                            <li><a href="/<?php echo URL ?>friends">My Friends</a></li>
                            <li><a href="/<?php echo URL ?>messages">My Status</a></li>
                            <li><a href="/<?php echo URL ?>profile">Edit Profile</a></li>
                            <?php if ((isset($this->dispAsConected) AND $this->dispAsConected == true)): ?>
                                <li><a href="/<?php echo URL ?>logout">Log out</a></li>
                            <?php endif; ?>
                            <li><a href="/<?php echo URL ?>admin">Admin</a></li>
                        </ul>
                    </div>
                </div>
            </div><!--Header ends here-->
            