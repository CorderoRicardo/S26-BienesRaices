<?php
define('TEMPLATES_URL',__DIR__ . '/templates');
define('FUNCIONES_URL',__DIR__ . '/funciones.php');
define('CARPETA_IMAGENES',__DIR__.'/../imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false ){
    include TEMPLATES_URL . "/$nombre.php";
}

/**
 * Validates login credentials to access the CRUD pages
 */
function autenticacion(){
    session_start();

    if(!$_SESSION['login']){
        header('location: /S26-BienesRaices/index.php');
    }
}

/**
 * Prints the content of an object and stops the loading after it
 */
function debugging($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}