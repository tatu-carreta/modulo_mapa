<?php

session_start(); //comentar esta linea si no se trabaja con sesiones
//require_once (__DIR__) . '/funciones/sessionControl.php';

ini_set('default_charset', 'utf8');

date_default_timezone_set("America/Argentina/Buenos_Aires");

/*
  @Maximiliano
 */

/*
  if (isset($redirectAdmin)) {
  $_SESSION['redir_login'] = $redirectAdmin;
  }
 * 
 */

$localhost = true; //define si se esta trabajando a modo local o no

$proyecto = "MAPA";

if (!$localhost) {

    switch ($_SERVER['HTTP_HOST']) {
        case "":
            define("URL_TOTAL", "");

            break;
    }

    define("DB_USER", "");
    define("DB_PASS", "");
    define("DB_HOST", "");
    define("DB_SELECTED", "");
} else {

    define("URL_TOTAL", "http://localhost/modulo_mapa/");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_HOST", "localhost");
    define("DB_SELECTED", "modulo_mapa");
}

/*
 * paths para utilizar absoluto y permitir
 * url amigable a traves de .htaccess
 */

define("PATH_HOME", URL_TOTAL);
define("PATH_CSS", URL_TOTAL . "css/");
define("PATH_PHP", URL_TOTAL . "php/");
define("PATH_CONTROLLER", URL_TOTAL . "controller/");
define("PATH_HTML", URL_TOTAL . "html/");
define("PATH_JS", URL_TOTAL . "js/");
define("PATH_ADMIN", URL_TOTAL . "admin/");
define("PATH_IMAGES", URL_TOTAL . "images/");


require_once (__DIR__) . '/funciones/funcionesSeguridad.php';
