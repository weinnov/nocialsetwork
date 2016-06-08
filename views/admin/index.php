
<div class='main-content'>
    <div class='message'>Welcome <?php echo $this->nom ?></div>
    <ul class='button'>
        <li><a href="/<?php URL ?>admin/deleteUsers" class="button">Delete All Users</a></li>
        <li><a href="/<?php URL ?>admin/delSessions" class="button">Delete All Sessions</a></li>
    </ul>
    <h2>The total member is: <?php echo $this->membersNum ?></h2>
    <ul id="users-data">
        <!-- Ajax content will be here-->
    </ul>





    <script>

    </script>

</div>