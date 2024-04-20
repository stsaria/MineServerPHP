<?php
    include "../cgi-bin/login.php";
    include "../cgi-bin/server.php";
    $_GET["command"] = htmlspecialchars($_GET["command"], ENT_QUOTES, "utf-8");
    if (!inputIsPassword($_GET["serverId"], $_COOKIE["password"])){return 1;}
    if (!runningServer($_GET["serverId"])) {return 2;}
    exec("screen -S msp-mineserver-".$_GET["serverId"]." -X eval 'stuff \"".$_GET["command"]."\\n\"'");
    header("Location: dashboard.php?serverId=".$_GET["serverId"]);