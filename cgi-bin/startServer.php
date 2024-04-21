<?php
    function startServer(string $serverUuid, string $password){
        if (!inputIsPassword($serverUuid, $password)){return 1;}
        if (runningServer($serverUuid)) {return 2;}
        exec("screen -DmS msp-mineserver-".$serverUuid." python3 ../py-bin/server.py -start ".$serverUuid." &");

        return 0;
    }