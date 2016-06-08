</div>
<div id="footer">
    <ul class='menu-footer'>
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
    <p>You are logged as <?php echo $this->nom ?> | (c) 2015</p>
</div>
<?php if (isset($this->jsFile)): ?>
    <script src="<?php echo $this->jsFile ?>" type='text/javascript'></script> 
<?php endif; ?>
</body>
</html>
