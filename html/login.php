<?php
    include "../cgi-bin/login.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MinecraftServerPHP - Login</title>
        <!-- <link href="styles/style.css" rel="stylesheet"> --->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <?php include "header.html" ?>
        <p style="height: 10px;"></p>
        <div style="text-align: center;">
            <h2>Login</h2>
            <?php if($_SERVER["REQUEST_METHOD"] == "GET"):?>
                <form action="" method="post">
                    ServerID :&ensp;&thinsp;<input type="text" name="serverId" value="<?= htmlspecialchars($_GET["serverId"], ENT_QUOTES, "utf-8") ?>" style="width: 280px;" required/></br>
                    Password : <input type="password" name="password" style="width: 280px;" required/></br>
                    <input type="submit" value="Login"/>
                </form>
            <?php elseif($_SERVER["REQUEST_METHOD"] == "POST"):?>
            <?php $result = login($_POST["serverId"], $_POST["password"]); if($result == 0): ?>
                <meta http-equiv="refresh" content="0;URL=dashboard.php?serverId=<?=$_POST["serverId"]?>">
            <?php else:?>
                <p class="text-danger">Login is failed. code : <?=strval($result)?></p>
            <?php endif; endif;?>
        </div>
        <hr>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>