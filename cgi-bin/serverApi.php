<?php
    function getMinecraftVersionList(){
        $jsonDict = json_decode(file_get_contents("https://mcversions.net/mcversions.json"), true)["stable"];
        return array_keys($jsonDict);
    }