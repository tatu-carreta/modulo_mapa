<?php

require_once (__DIR__) . '/../Twig-1.14.2/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$templateDir = (__DIR__) . "/../html";
$loader = new Twig_Loader_Filesystem($templateDir);
$twig = new Twig_Environment($loader);

$paths = array('PATH_HOME' => PATH_HOME,
    'PATH_CSS' => PATH_CSS,
    'PATH_PHP' => PATH_PHP,
    'PATH_CONTROLLER' => PATH_CONTROLLER,
    'PATH_HTML' => PATH_HTML,
    'PATH_JS' => PATH_JS,
    'PATH_ADMIN' => PATH_ADMIN,
    'PATH_IMAGES' => PATH_IMAGES,
);

$logueado = false;
$nombre_visible = null;
if (logueado()) {
    $logueado = true;
    $nombre_visible = sanearDatos($_SESSION['nombre_visible']);
}

$info = array(
    'paths' => $paths,
    'locales' => json_encode(array()),
    'logueado' => $logueado,
    'nombre_visible' => $nombre_visible,
);
