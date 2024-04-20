<?php
    include "../cgi-bin/login.php";
    include "../cgi-bin/server.php";
    include "../cgi-bin/startServer.php";
    include "../cgi-bin/stopServer.php";

    if (isset($_GET["serverId"]) && isset($_COOKIE["password"])){
        if (inputIsPassword($_GET["serverId"], $_COOKIE["password"])){
            if (!runningServer($_GET["serverId"])){
                $result = startServer($_GET["serverId"], $_COOKIE["password"]);
                if ($result != 0){
                    header("Location: dashboard.php?serverId=".$_GET["serverId"]."&Failed=".strval($result));
                    exit;
                } else {
                    header("Location: dashboard.php?serverId=".$_GET["serverId"]);
                    exit;
                }
            } else {
                $result = stopServer($_GET["serverId"], $_COOKIE["password"]);
                if ($result != 0){
                    header("Location: dashboard.php?serverId=".$_GET["serverId"]."&Failed=".strval($result));
                    exit;
                } else {
                    header("Location: dashboard.php?serverId=".$_GET["serverId"]);
                    exit;
                }
            }
        }
    }

    header("Location: dashboard.php?serverId=".$_GET["serverId"]."&Failed=".strval($result));
    exit;

    