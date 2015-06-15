<?php

require_once (__DIR__) . '/../php/config.php';

$seccion = $_POST['section'];

switch ($seccion) {

    case 'login':
        yaEstaLogueado($localhost);

        require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
        require_once (__DIR__) . '/../admin/login.php';

        break;
    case 'logout':
        permisoLogueado($localhost);

        require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
        require_once (__DIR__) . '/../admin/logout.php';

        break;
    case 'agregar-local':
        permisoLogueado($localhost);

        require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
        require_once (__DIR__) . '/../admin/agregar-local.php';

        break;
    case 'editar-local':
        permisoLogueado($localhost);

        require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
        require_once (__DIR__) . '/../admin/editar-local.php';

        break;
    case 'borrar-local':
        permisoLogueado($localhost);

        require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
        require_once (__DIR__) . '/../admin/borrar-local.php';

        break;
    default :

        if ($localhost) {
            header("Location: " . PATH_CONTROLLER . "controladorAdmin.php?seccion=listado-locales");
        } else {
            header("Location: " . PATH_HOME . "admin/listado-locales");
        }


        break;
}
