<?php

function validarAgregarLocal() {
    $ok = false;
    $text = "";

    /*if (!isset($_POST['nombre']) || ($_POST['nombre'] == "")) {
        $text = "Problema en el nombre.";
    } else*/if (!isset($_POST['direccion']) || ($_POST['direccion'] == "")) {
        $text = "Problema en la dirección.";
    } elseif (!isset($_POST['latitud']) || ($_POST['latitud'] == "")) {
        $text = "Problema en las coordenadas.";
    } elseif (!isset($_POST['longitud']) || ($_POST['longitud'] == "")) {
        $text = "Problema en las coordenadas.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarModificarLocal() {
    $ok = false;
    $text = "";

    if (!isset($_POST['local']) || ($_POST['local'] == "") || (!is_numeric($_POST['local']))) {
        $text = "Problema en los datos ingresados. Intente nuevamente.";
    } /*elseif (!isset($_POST['nombre']) || ($_POST['nombre'] == "")) {
        $text = "Problema en el nombre.";
    } */elseif (!isset($_POST['direccion']) || ($_POST['direccion'] == "")) {
        $text = "Problema en la dirección.";
    } elseif (!isset($_POST['latitud']) || ($_POST['latitud'] == "")) {
        $text = "Problema en las coordenadas.";
    } elseif (!isset($_POST['longitud']) || ($_POST['longitud'] == "")) {
        $text = "Problema en las coordenadas.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarBorrarLocal() {
    $ok = false;
    $text = "";

    if (!isset($_POST['local']) || ($_POST['local'] == "") || (!is_numeric($_POST['local']))) {
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

function validarLocal() {
    $ok = false;
    $text = "";

    if (!isset($_POST['local']) || ($_POST['local'] == "") || (!is_numeric($_POST['local']))) {
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
