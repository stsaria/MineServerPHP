<?php 
    include "../cgi-bin/loader.php";
    include "../cgi-bin/serverApi.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MinecraftServerPHP - Home</title>
        <!-- <link href="styles/style.css" rel="stylesheet"> --->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <?php include "header.html" ?>
        <p style="height: 10px;"></p>
        <div style="text-align: center;">
            <?php if($serverCreationLimitsNum > $createNum): ?>
                <h3 class="text-success">You can now create a server!<h2>
            <?php else: ?>
                <h3 class="text-danger">You can't now create a server.......</h2>
            <?php endif; ?>
        </div>
        <hr>
        <div class="container">
            <h3>Create Server</h3>
            <form action="createServer.php" method="post">
                Server Version :&ensp;&thinsp;&thinsp; 
                <select name="version" required>
                    <?php
                        foreach (getMinecraftVersionList() as $minecraftVersion){
                            if ($minecraftVersion === "1.1"){break;} else{
                                echo "<option value=".$minecraftVersion.">".$minecraftVersion."</option>\n";
                            }
                        }
                    ?>
                </select>
                </br>
                Server Motd :&emsp;&emsp;<input type="text" name="motd" style="width: 280px;" required/></br>
                Server Password : <input type="password" name="password" style="width: 280px;" required/>
                <input type="submit" value="Create Server"/>
            </form>
            <h3>Server List</h3>
            <ul>
                <?php 
                    $fp = fopen("../data/servers.csv", "r");
                    while($csv = fgetcsv($fp)): ?>
                    <li>
                        <h5>ServerID : <a href="dashboard.php?serverId=<?=$csv[0]?>"><?=$csv[0]?></a></h5>
                        <p>Motd : <?=$csv[3]?></p>
                    </li>
                    <?php endwhile; ?>
            </ul>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>