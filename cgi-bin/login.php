<?php
    function inputIsPassword(string $serverUuid, string $password){
        try{
            $inputIsPassword = false;
            $fp = fopen("../data/servers.csv", "r");
            while($csv = fgetcsv($fp)){
                if ($serverUuid === $csv[0] && hash('sha256', $password) === $csv[2]){
                    $inputIsPassword = true;
                }
            }
            fclose($fp);
            if (!$inputIsPassword){return false;}
            return true;
        } catch(Exception){return false;}
    }
    function login(string $serverUuid, string $password){
        try{
            if(inputIsPassword($serverUuid, $password)){
                setcookie("password",$password,time()+60*60*24*7);
            } else {return 2;}
            return 0;
        } catch(Exception){return 1;}
    }