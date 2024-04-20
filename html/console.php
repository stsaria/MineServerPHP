<meta http-equiv="refresh" content="1;URL=console.php?serverId=<?=$_GET["serverId"]?>#end">
<div style="height: 100%;">
    <?php
        include "../cgi-bin/login.php";
        if (inputIsPassword($_GET["serverId"], $_COOKIE['password'])){
            echo "<pre>".file_get_contents("../minecraft/".$_GET["serverId"]."/logs/latest.log")."</pre>";
        }
    ?>
</div>
<div id="end"></div>