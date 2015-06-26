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
        case "http://hedaly.com.ar/":
            define("URL_HEDALY", "http://hedaly.com.ar/");
            define("URL_TOTAL", "http://hedaly.com.ar/modulo_mapa/");

            break;
        case "http://www.hedaly.com.ar/":
            define("URL_HEDALY", "http://www.hedaly.com.ar/");
            define("URL_TOTAL", "http://www.hedaly.com.ar/modulo_mapa/");

            break;
        default :
            define("URL_HEDALY", "http://hedaly.com.ar/");
            define("URL_TOTAL", "http://hedaly.com.ar/modulo_mapa/");
            
            break;
    }

    define("DB_USER", "hedaly12_md_mp");
    define("DB_PASS", "H12_md_MP");
    define("DB_HOST", "10.0.10.24");
    define("DB_SELECTED", "hedaly12_md_mp");
} else {

    define("URL_HEDALY", "http://hedaly.com.ar/");
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

define("PATH_HEDALY", URL_HEDALY);
define("PATH_HOME", URL_TOTAL);
define("PATH_CSS", URL_TOTAL . "css/");
define("PATH_PHP", URL_TOTAL . "php/");
define("PATH_CONTROLLER", URL_TOTAL . "controller/");
define("PATH_HTML", URL_TOTAL . "html/");
define("PATH_JS", URL_TOTAL . "js/");
define("PATH_ADMIN", URL_TOTAL . "admin/");
define("PATH_IMAGES", URL_TOTAL . "images/");


require_once (__DIR__) . '/funciones/funcionesSeguridad.php';
