<?php 
    include "../cgi-bin/loader.php";
    include "../cgi-bin/serverApi.php";
    include "../cgi-bin/login.php";
    include "../cgi-bin/server.php";
?>
<?php if(!(isset($_COOKIE["password"]) && inputIsPassword($_GET["serverId"], $_COOKIE["password"]))): ?>
    <meta http-equiv="refresh" content="0;URL=login.php?serverId=<?=$_GET["serverId"]?>">
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MinecraftServerPHP - Dashboard</title>
        <!-- <link href="styles/style.css" rel="stylesheet"> --->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <?php include "header.html" ?>
        <p style="height: 10px;"></p>
        <div style="text-align: center;">
            <h2>Dashboard</h2>
        </div>
        <hr>
        <div class="container">

            <?php if(runningServer($_GET["serverId"])): ?>
                <a href="switchServer.php?serverId=<?=$_GET["serverId"]?>"><button>Server Off</button></a>
                <p class="text-success">Server is running</p>
                <h3>Console</h3>
                <iframe src="console.php?serverId=<?=$_GET["serverId"]?>" width="100%" height="500px"></iframe>
                <form action="command.php" method="get">
                    Command :&nbsp;
                    <input type="text" name="serverId" readonly hidden value="<?=$_GET["serverId"]?>"/>
                    <input type="text" name="command" required/>
                    <input type="submit" value="Submit"/>
                </form>
            <?php else: ?>
                <a href="switchServer.php?serverId=<?=$_GET["serverId"]?>"><button>Server On</button></a>
                <p class="text-danger">Server is not running</p>
            <?php endif; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>