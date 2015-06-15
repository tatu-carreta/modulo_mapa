<?php

if (!isset($localhost)) {
    require_once (__DIR__) . '/../php/config.php';
}

permisoLogueado($localhost);

require_once (__DIR__) . '/../php/funciones/funcionesLocal.php';
require_once (__DIR__) . '/../php/funciones/funcionesPhp.php';
require_once (__DIR__) . '/../php/validate/validateLocal.php';

$infoValidate = validarBorrarLocal();
//$infoValidate['estado'] = true;
$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idLocal = sanearDatos($_POST['local']);

    $estadoAgregacion = realizarBajaLocal($idLocal);

    if ($estadoAgregacion['estado']) {
        $texto = "El local se ha borrado correctamente.";
    } else {
        $texto = "Hubo un error al realizar la baja del local. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $estadoAgregacion['estado'] = false;
    $texto = $infoValidate['texto'];
}

$result = array(
    'estado' => $estadoAgregacion['estado'],
    'texto' => $texto
);

echo json_encode($result);
