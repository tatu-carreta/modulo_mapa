<?php

if (!isset($localhost)) {
    require_once (__DIR__) . '/../php/config.php';
}

permisoLogueado($localhost);

require_once (__DIR__) . '/../php/funciones/funcionesLocal.php';
require_once (__DIR__) . '/../php/funciones/funcionesPhp.php';
require_once (__DIR__) . '/../php/validate/validateLocal.php';


$infoValidate = validarModificarLocal();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $nombre = sanearDatos($_POST['nombre']);
    $direccion = sanearDatos($_POST['direccion']);
    $longitud = sanearDatos($_POST['longitud']);
    $latitud = sanearDatos($_POST['latitud']);
    $idLocal = sanearDatos($_POST['local']);

    $estadoAgregacion = realizarModificacionLocal($nombre, $direccion, $longitud, $latitud, $idLocal);

    if ($estadoAgregacion['estado']) {
        $texto = "El local se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al realizar la modificación del local. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $estadoAgregacion = false;
    $texto = $infoValidate['texto'];
}

$result = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto
);

echo json_encode($result);
