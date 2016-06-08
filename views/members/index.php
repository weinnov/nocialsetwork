
<div class='main-content'>
    <div class='message'>Welcome <?php echo $this->nom ?></div>
    <h2>The total member is: <?php echo $this->membersNum ?></h2>
    <ul id="listMembres">

        <?php foreach ($this->arrayRelShips as $this->relShip): ?>
            <li class='liste'>
                 <a href="/messages/view/<?php echo ($this->relShip['username']); ?>"><?php echo ($this->relShip['username']); ?></a>&nbsp;
                    <?php echo (members_model::createMsgFromRel($this->relShip['friendship'])['relation']) ?>
                    [<a id="supr-
                    <?php echo ($this->relShip['username']); ?>" 
                    href="
                        <?php echo (members_model::createMsgFromRel($this->relShip['friendship'])['actionlink']); ?>/<?php echo ($this->relShip['username']); ?>">
                        <?php echo (members_model::createMsgFromRel($this->relShip['friendship'])['actiontxt']); ?>
                    </a>]
            </li> 
        <?php endforeach; ?> 
    </ul>
</div>
