<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost','root','root','bienesraices-crud');

    if(!$db){
        exit;
    }

    return $db;
}