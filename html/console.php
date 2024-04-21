<?php if (!$_GET["all"] == "yes"): ?>
<meta http-equiv="refresh" content="3;URL=console.php?serverId=<?=$_GET["serverId"]?>#end">
<?php endif; ?>
<div style="height: 100%;">
    <?php
        include "../cgi-bin/login.php";
        if (inputIsPassword($_GET["serverId"], $_COOKIE['password'])){
            $log = file_get_contents("../minecraft/".$_GET["serverId"]."/logs/latest.log");
            if (!$_GET["all"] == "yes"){
                $log = implode("\n", array_slice(explode("\n", $log), -23, -1));
            }
            echo "<pre>".$log."</pre>";
        }
    ?>
</div>
<div id="end"></div>