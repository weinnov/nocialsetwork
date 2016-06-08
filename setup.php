<html>
    <?php
    if (isset($_POST['dbusername']) && isset($_POST['dbname']) && isset($_POST['dbpass'])) {
        try {
            // create htacess file files
            $htacessFile = fopen(".htaccess", "w") or die("Unable to edit the htaccess file");
            fwrite($htacessFile, "RewriteEngine On\n");
            fclose($htacessFile);
            $htacessFile = fopen(".htaccess", "a") or die("Unable to edit the htaccess file");
            fwrite($htacessFile, "RewriteCond %{REQUEST_FILENAME} !-d\n");
            fwrite($htacessFile, "RewriteCond %{REQUEST_FILENAME} !-f\n");
            fwrite($htacessFile, "RewriteCond %{REQUEST_FILENAME} !-l\n");
            fwrite($htacessFile, "RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]\n");
            fclose($htacessFile);

            // add database details to config file
            $dbname = $_POST['dbname'];
            $dbusername = $_POST['dbusername'];
            $dbpass = $_POST['dbpass'];
            
            copy('config/config_bacup.php', 'config/config.php');

            $configFile = fopen('config/config.php', "a") or die("Unable to edit the config file");
            fwrite($configFile, "\ndefine('DB_NAME', '$dbname');\n");
            fwrite($configFile, "define('DB_USERNAME', '$dbusername');\n");
            fwrite($configFile, "define('DB_PASSWORD', '$dbpass');\n");
            fclose($configFile);


            //Create table
            $rootConnec = new PDO('mysql:dbname=' . $_POST['dbname'] . ';host=localhost', $_POST['dbusername'], $_POST['dbpass']);

            $SQL1 = "CREATE TABLE friendship (username VARCHAR(30),folowedby VARCHAR(30),id SMALLINT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)";
            $rootConnec->exec($SQL1);
            $SQL2 = "CREATE TABLE messages (
                msgID SMALLINT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sender VARCHAR(30), receiver VARCHAR(30), msgCotent VARCHAR(300), MsgDate INT(20), private TINYINT(1))";
            $rootConnec->exec($SQL2);
            $SQL3 = "CREATE TABLE profile (username VARCHAR(30) PRIMARY KEY, avatar VARCHAR(100), aboutMe VARCHAR(500), title VARCHAR(100))";
            $rootConnec->exec($SQL3);
            $SQL4 = "CREATE TABLE sessiontable (sessID INT(11) AUTO_INCREMENT NOT NULL UNIQUE, username VARCHAR(30), sessToken VARCHAR(300), loginDate INT(11))";
            $rootConnec->exec($SQL4);
            $SQL5 = "CREATE TABLE usertable (username VARCHAR(30) PRIMARY KEY,
                userhpass VARCHAR(128), fullname VARCHAR(50), role ENUM('admin','user') DEFAULT 'user')";
            $rootConnec->exec($SQL5);

            $SQL6 = "INSERT INTO usertable (username,userhpass,fullname,role) VALUES ('admin','80014a87d0d33c03c59d139096eb5982','Admnistrator','admin')";
            $rootConnec->exec($SQL6);

            header('Location: /index');
        } catch (Exception $ex) {
            echo ("An error occured: " . $ex->getMessage());
            $htacessFile = fopen(".htaccess", "w") or die("Unable to edit the htaccess file");
            fwrite($htacessFile, "RewriteEngine On\n");
            fclose($htacessFile);
            $htacessFile = fopen(".htaccess", "a") or die("Unable to edit the htaccess file");
            fwrite($htacessFile, "RewriteRule ^$ setup.php");
            fclose($htacessFile);
            copy('config/config_bacup.php', 'config/config.php');
            echo('<br>Go back to the setup page and<a href="/"> try again<a/>');
        }
    } else {
        ?>
        <head>
            <link type="text/css" rel="stylesheet" href="/public/css/styles.css">
        </head>
        <body>
            <div id="page">
                <h1 id="msgHeader">
                    Welcome to the install wizard.
                </h1>
                <div>
                    <form method="POST" action="setup.php">
                        <fieldset><legend>Please provide below your database details:</legend>
                            <div>
                                <label for="dbusername">Mysql username:</label>
                                <input type="text" name="dbusername" value="admin">
                            </div>
                            <div>
                                <label for="dbname">Database name:</label>
                                <input type="text" name="dbname" value="mynetwork2">
                            </div>
                            <div>
                                <label for="dbpass">Database Pass:</label>
                                <input type="text" name="dbpass" value="sweetword">
                            </div>
                        </fieldset>

                        <input type="submit" value="install">
                    </form>
                </div>
            </div>
        </body>         
    <?php } ?>
</html>