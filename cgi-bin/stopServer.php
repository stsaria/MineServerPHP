<?php
    function stopServer(string $serverUuid, string $password){
        if (!inputIsPassword($serverUuid, $password)){return 1;}
        if (!runningServer($serverUuid)) {return 2;}
        exec("screen -S msp-mineserver-".$serverUuid." -X eval 'stuff \"save-all\\n\"'");
        exec("screen -S msp-mineserver-".$serverUuid." -X eval 'stuff \"stop\\n\"'");
        sleep(5);
        return 0;
    }