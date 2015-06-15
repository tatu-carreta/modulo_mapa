<?php

if (!isset($localhost)) {
    require_once (__DIR__) . '/../php/config.php';
}


permisoLogueado($localhost);

session_unset();
session_destroy();
session_regenerate_id(true);

if ($localhost) {
    header("Location:" . PATH_CONTROLLER . "controladorAdmin.php?seccion=mapa");
} else {
    header("Location:" . PATH_HOME);
}