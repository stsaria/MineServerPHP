<?php
    function Loader(){
        $createNum = intval(file_get_contents("../data/createNum.txt"));
        $ini = parse_ini_file("../config/config.ini", true);
        return [$ini, $createNum];
    }

    $ini = Loader()[0];
    $serverCreationLimitsNum = intval($ini["server"]["serverCreationLimitsNum"]);
    $serverMemXmsGiga = $ini["server"]["serverMemXmsGiga"];
    $serverMemXmxGiga = $ini["server"]["serverMemXmxGiga"]; 
    $createNum = Loader()[1];