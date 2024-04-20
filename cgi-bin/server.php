<?php
    function runningServer(string $serverUuid){
        exec("screen -ls", $output);
        if (strstr(implode("\n", $output), "msp-mineserver-".$serverUuid) !== false){return true;}
        else{return false;}
    }