
<div class='main-content'>
    <div class='message'>Welcome <?php echo $this->nom ?></div>

    <?php if ($this->messageData): ?>
        <h2>There are <?php echo count($this->messageData); ?> messages</h2>
        <div id="msgsContainer">
            <?php foreach ($this->messageData as $key => $this->curentMsgData): ?>
                <?php if (($this->curentMsgData['private'] == 0 ) || ($this->curentMsgData['ownership'] == true)): ?>

                    <p><?php echo date("F j, Y, g:i a", $this->curentMsgData['MsgDate']); ?>: 
                        <a href="/messages/view/<?php echo $this->curentMsgData['sender']; ?>"><?php echo $this->curentMsgData['sender']; ?></a>
                        <?php echo $this->curentMsgData['private'] ? 'whispered' : 'wrote'; ?>: <?php echo $this->curentMsgData['msgCotent']; ?>
                        <?php if ($this->curentMsgData['ownership'] == true): ?>
                            <span class="eraseLink">
                                [ <a href="/messages/erase/<?php echo $this->curentMsgData['msgID']; ?>">erase</a> ]
                            </span>
                        <?php endif; ?> 
                    </p>

                <?php endif; ?>    

            <?php endforeach; ?> 
        <?php endif; ?>
    </div>  
    <hr> 
    <h2>Send a message to <?php echo $this->profilOwner ?></h2>
    <form method="POST" action="/messages/submitto/<?php echo $this->profilOwner ?>" enctype="application/x-www-form-urlencoded">
        <textarea name="msgContent"></textarea>
        <label>
            Public<input type="radio" name="private" value="0" checked="checked"/>
        </label>
        <label>
            Private<input type="radio" name="private" value="1"/>
        </label>
        <input type="submit" value="POST MESSAGE">
    </form>
</div>

