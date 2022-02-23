<?php
require_once "config/config.php";
// Cargar librerias
require_once "libraries/Core.php";
require_once "libraries/Controller.php";
require_once "libraries/Database.php";
require_once "helpers/url_helper.php";
require_once "helpers/session_helper.php";

// autoload de librerias esta funcion registra una funcion

/*
https://www.php.net/manual/es/ref.spl.php
*/

spl_autoload_register(function($className){
    require_once ('libraries/'.$className.'.php');
});
?>