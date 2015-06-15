<?php

if (!isset($localhost)) {
    require_once (__DIR__) . '/../php/config.php';
}

require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
require_once (__DIR__) . '/../php/funciones/funcionesUsuario.php';
require_once (__DIR__) . '/../php/funciones/funcionesPhp.php';
require_once (__DIR__) . '/../php/validate/validateUsuario.php';

/*
 * Si está logueado no tiene acceso.
 */
yaEstaLogueado($localhost);

$infoValidate = validarDatosLogin();
//$infoValidate['estado'] = true;
$estado = false;
$continue = PATH_CONTROLLER . "controladorAdmin.php?seccion=login&error=ok";
if ($infoValidate['estado']) {

    $nombreUsuario = sanearDatos($_POST['usuario']);
    $clave = sanearDatos($_POST['clave']);

    $datosUsuario = obtenerUsuarioPorNombreClave($nombreUsuario, $clave);

    if ($datosUsuario['estado']) {

        $log = registrarIngresoUsuario($datosUsuario['id']);

        $_SESSION['user_id'] = $datosUsuario['id'];
        $_SESSION['nombre_visible'] = $datosUsuario['nombre_visible'];
        $_SESSION['user_mac'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['private'] = blow_crypt("C9l1n3s9s39m9", 4);
        $_SESSION['private_alternative'] = $_SESSION['private'];
        $_SESSION['user_last_activity'] = time();

        $estado = true;
        $texto = "Usted se ha logueado correctamente.";
        $continue = PATH_CONTROLLER . "controladorAdmin.php?seccion=listado-locales";
    } else {
        $texto = "Error al iniciar sesión. El nombre de usuario o la contraseña son inválidos.";
    }
} else {
    $texto = $infoValidate['texto'];
}

$data = array(
    "estado" => $estado,
    "texto" => $texto,
);

//echo json_encode($data);

header("Location: " . $continue);
