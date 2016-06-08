<?php // require 'models/members_model.php' ?>



<div class='main-content'>
    <div class='message'>Welcome <?php echo $this->nom ?></div>
    <h2>All your followers</h2>
        <?php foreach ($this->arrayRelShips as $this->relShip): 
            if (($this->relShip['friendship'] == 'mutual') || ($this->relShip['friendship'] == 'follower') ):?>
                <li class='liste'>
                    <a href="/messages/view/<?php echo ($this->relShip['username']); ?>"><?php echo ($this->relShip['username']); ?></a>&nbsp;
                        <?php echo (friends_model::createMsgFromRel($this->relShip['friendship'])['relation']) ?>
                        [<a id="supr-
                            <?php echo ($this->relShip['username']); ?>" 
                            href="
                            <?php echo (friends_model::createMsgFromRel($this->relShip['friendship'])['actionlink']); ?>/<?php echo ($this->relShip['username']); ?>?return=friends">
                            <?php echo (friends_model::createMsgFromRel($this->relShip['friendship'])['actiontxt']); ?>
                        </a>]
                </li> 
            <?php endif; ?>
        <?php endforeach; ?> 
    
    <h2>Your are following</h2>
    
          <?php foreach ($this->arrayRelShips as $this->relShip): 
            if (($this->relShip['friendship'] == 'mutual') ||($this->relShip['friendship'] == 'followed')):?>
                <li class='liste'>
                    <a href="/messages/view/<?php echo ($this->relShip['username']); ?>"><?php echo ($this->relShip['username']); ?></a>&nbsp;
                        <?php echo (friends_model::createMsgFromRel($this->relShip['friendship'])['relation']) ?>
                        [<a id="supr-
                            <?php echo ($this->relShip['username']); ?>" 
                            href="
                            <?php echo (friends_model::createMsgFromRel($this->relShip['friendship'])['actionlink']); ?>/<?php echo ($this->relShip['username']); ?>?return=friends">
                            <?php echo (friends_model::createMsgFromRel($this->relShip['friendship'])['actiontxt']); ?>
                        </a>]
                </li> 
            <?php endif; ?>
        <?php endforeach; ?>   
</div>
