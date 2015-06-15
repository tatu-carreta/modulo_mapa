<?php

/*
 * Función que comprueba que los datos de session estén cargados correctamente
 * y sean los correctos al momento de loguearse.
 * De no ser así se redirige al login con un texto de error.
 */

function permisoLogueado($localhost) {

    if (!isset($_SESSION['user_id']) || (!isset($_SESSION['user_ip'])) || ($_SESSION['user_ip'] != $_SERVER['REMOTE_ADDR']) || ($_SESSION['private'] != $_SESSION['private_alternative'])) {

        if ($localhost) {
            header("Location: " . PATH_CONTROLLER . "controladorAdmin.php?seccion=login&error=ok");
        } else {
            header("Location: " . PATH_HOME . "admin/login");
        }
        exit();
    }

    return true;
}

/*
 * Función que comprueba que la persona que intenta acceder a dicho 
 * archivo no esté logueado.
 */

function permisoNoLogueado() {
    $ok = false;
    if (!isset($_SESSION['user_id']) || (!isset($_SESSION['user_ip'])) || (!isset($_SESSION['private'])) || (!isset($_SESSION['private_alternative']))) {
        $ok = true;
    }

    return $ok;
}

/*
 * Función que comprueba que la persona esté logueada.
 */

function logueado() {
    $ok = false;
    if (isset($_SESSION['user_id']) && (isset($_SESSION['user_ip'])) && (isset($_SESSION['private'])) && (isset($_SESSION['private_alternative']))) {
        $ok = true;
    }

    return $ok;
}

/*
 * Función que comprueba que los datos de session estén cargados correctamente
 * y sean los correctos al momento de loguearse.
 * De no ser así se redirige al login con un texto de error.
 */

function yaEstaLogueado($localhost) {
    if (isset($_SESSION['user_id']) && ($_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) && ($_SESSION['private'] == $_SESSION['private_alternative'])) {
        if ($localhost) {
            header("Location: " . PATH_CONTROLLER . "controladorAdmin.php?seccion=listado-locales");
        } else {
            header("Location: " . PATH_HOME . "admin/listado-locales");
        }
        exit();
    }
}
