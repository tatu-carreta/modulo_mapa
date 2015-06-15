<?php

function validarDatosLogin() {
    $ok = false;
    $text = "";

    if (!isset($_POST['usuario']) || ($_POST['usuario'] == "")) {
        $text = "Problema en los datos ingresados. Intente nuevamente.";
    } elseif (!isset($_POST['clave']) || ($_POST['clave'] == "")) {
        $text = "Problema en los datos ingresados. Intente nuevamente.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}
