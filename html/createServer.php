<?php 
    include "../cgi-bin/loader.php";
    include "../cgi-bin/createServer.php";
    $_POST["version"] = htmlspecialchars($_POST["version"], ENT_QUOTES, 'UTF-8');
    $_POST["motd"] = htmlspecialchars($_POST["motd"], ENT_QUOTES, 'UTF-8');
    $_POST["password"] = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MinecraftServerPHP - ServerCreate</title>
        <!-- <link href="styles/style.css" rel="stylesheet"> --->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <div style="text-align: center;">
            <h2>Create Server</h2>
            <?php if (!(isset($_POST["version"]) && isset($_POST["motd"]) && isset($_POST["password"]))): ?>
                <h3 class="text-danger">Missing argument.</h3>
            <?php else: $result = createServer($_POST["motd"], $_POST["version"], $_POST["password"]);
                if($result[0] == 0): ?>
                <h3 class="text-success">Server is currently being created.</h3>
                <a href="./dashboard.php?serverId=<?php echo $result[1] ?>"><h3>Server management screen</h3></a>
            <?php elseif($result[0] == 1): ?>
                <h3 class="text-danger">There is no server version of it.</h3>
            <?php endif; endif;?>
            <a href="./"><h2>Back</h2></a>
        </div>
    </body>
</html>