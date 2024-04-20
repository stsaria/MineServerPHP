<?php
    include "../cgi-bin/serverApi.php";
    function guidv4($data = null) {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function createServer(string $motd, string $verison, string $password){
        $serverVersion = $verison;
        $serverUuid = guidv4();
        if (str_replace(" ", "", $motd) === ""){
            $motd="Minecraft Server PHP";
        }
        if(!in_array($verison, getMinecraftVersionList())){return [1, $serverUuid];}
        $fp = fopen('../data/servers.csv', 'a');
        if (flock($fp, LOCK_EX)){
            fwrite($fp, $serverUuid.",".$serverVersion.",".hash('sha256', $password).",".$motd."\n");
            flock($fp, LOCK_UN);
        }else{
            return [2, $serverUuid];
        }
        exec("screen -DmS msp-".$serverUuid." python3 ../py-bin/server.py -create ".$serverUuid." ".$motd." ".$verison." >> ../log/python.log &");
        return [0, $serverUuid];
    }