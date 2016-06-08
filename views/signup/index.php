<div class='main-content'>
    <div class='message'><?php echo $this->message ?></div>
    <form action="/signup/register" method="POST" autocomplete="off">
        <fieldset><legend>Your personal details:</legend>
            <div>
                <label for="iduname">Username: </label>
                <input type="text" name="username" id="iduname"/>
                <p class="notif" id="notif">Enter an username</p>
            </div>
            <div>
                <label for="idpass">Password: </label>
                <input type="password" name="password" id="idpass"/>
            </div>
            <div>
                <label for="idfullname">Full Name: </label>
                <input type="text" name="fullname" id="idfullname"/>
            </div>                            
        </fieldset>
        <input type="submit" value="Register"/>
    </form>
</div>