
<div class='main-content'>
    <div class='message <?php echo $this->otherMsgClass ?>'><?php echo $this->message ?></div>

    <div id="formContainer">
        <form action="/login/login" method="POST">
            <fieldset><legend>Your login details:</legend>
                <div>
                    <label for="iduname">Username: </label>
                    <input type="text" name="username" id="iduname"/>
                </div>
                <div>
                    <label for="idpass">Password: </label>
                    <input type="password" name="password" id="idpass"/>
                </div>                           
            </fieldset>
            <input type="submit" value="Login"/>
        </form>
    </div>
</div>

