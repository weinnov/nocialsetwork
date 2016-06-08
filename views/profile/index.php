
<div class='main-content'>
    <div class='message'>Welcome <?php echo $this->nom ?></div>
    <h2><?php echo $this->title ?></h2>
    <div>
        <img src="<?php echo $this->userPic ?>" style="float: left; margin-right: 20px">
        <p> <?php echo $this->userDesc ?> </p>
    </div>
    
    <form method="POST" action="/profile/updtProfile" enctype="multipart/form-data">
        <div>
            <p>Tell us about yourself: Image: </p>
            <input type="text" name="myTitle"/> <br><br> Your profile image: <input type="file" name="myAvatar"/>
        </div>
        <textarea name="aboutMe"></textarea>
        <div>
            <input type="submit" value="UPDATE DETAILS"></div>
    </form>         


</div>

