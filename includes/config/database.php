<?php

function conectarDB() : mysqli{
    $db = new mysqli('localhost','root','root','bienesraices-crud');

    if(!$db){
        exit;
    }

    return $db;
}