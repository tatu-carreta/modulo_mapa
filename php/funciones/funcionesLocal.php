<?php

function obtenerLocales() {
    $conect = conectar();

    $sql = "SELECT nombre, direccion, longitud, latitud
            FROM local
            WHERE estado = 'A'
            ORDER BY nombre";
    $stmt = $conect->query($sql);

    $datos = array();

    while ($result = $stmt->fetch_assoc()) {
        array_push($datos, $result);
    }

    return $datos;
}

function obtenerLocalesAdmin() {
    $conect = conectar();

    $sql = "SELECT id, nombre, direccion, longitud, latitud
            FROM local
            WHERE estado = 'A'
            ORDER BY nombre";
    $stmt = $conect->query($sql);

    $datos = array();

    while ($result = $stmt->fetch_assoc()) {
        array_push($datos, $result);
    }

    return $datos;
}

function obtenerLocalPorId($idLocal) {
    $conect = conectar();
    $sql = "SELECT id, nombre, direccion, longitud, latitud
            FROM  local
            WHERE id = ?";


    $stmt = $conect->prepare($sql);
    $stmt->bind_param('i', $idLocal);
    $stmt->execute();

    $stmt->bind_result($id, $nombre, $direccion, $longitud, $latitud);

    $stmt->store_result();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'estado' => true,
            'id' => $id,
            'nombre' => $nombre,
            'direccion' => $direccion,
            'longitud' => $longitud,
            'latitud' => $latitud,
        );
    } else {
        $result = array(
            'estado' => false,
        );
    }

    return $result;
}

/*
 * IMPACTO
 */

function realizarAgregacionLocal($nombre, $direccion, $longitud, $latitud) {
    $conect = conectar();

    $resultado = array('estado' => FALSE);
    try {

        /* Autocommit false para la transaccion */
        $conect->autocommit(FALSE);
        $estadoConsulta = TRUE;

        /* Insert local */
        $sql4 = "INSERT INTO local(nombre, direccion, longitud, latitud, estado, fecha_carga, usuario_id_carga) 
                VALUES (?,?,?,?, 'A', '" . date('Y-m-d H:i:s') . "', '1')";
        $stmt4 = $conect->prepare($sql4);
        $stmt4->bind_param('ssss', $nombre, $direccion, $longitud, $latitud);
        if (!$stmt4->execute()) {
            $estadoConsulta = FALSE;
        }

        $stmt4->close();

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            $conect->commit();
            desconectar($conect);

            $resultado['estado'] = TRUE;
            return $resultado;
        } else {
            $conect->rollback();
            desconectar($conect);
            return $resultado;
        }
    } catch (mysqli_sql_exception $e) {
        $conect->rollback();
        desconectar($conect);
        return $resultado;
    }
}

function realizarBajaLocal($idLocal) {
    $conect = conectar();

    $resultado = array('estado' => FALSE);
    try {

        /* Autocommit false para la transaccion */
        $conect->autocommit(FALSE);
        $estadoConsulta = TRUE;

        /* Insert local */
        $sql4 = "UPDATE local SET estado = 'B', fecha_baja = '" . date('Y-m-d H:i:s') . "', usuario_id_baja = '1'
                WHERE id = ?";
        $stmt4 = $conect->prepare($sql4);
        $stmt4->bind_param('i', $idLocal);
        if (!$stmt4->execute()) {
            $estadoConsulta = FALSE;
        }

        $stmt4->close();

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            $conect->commit();
            desconectar($conect);

            $resultado['estado'] = TRUE;
            return $resultado;
        } else {
            $conect->rollback();
            desconectar($conect);
            return $resultado;
        }
    } catch (mysqli_sql_exception $e) {
        $conect->rollback();
        desconectar($conect);
        return $resultado;
    }
}

function realizarModificacionLocal($nombre, $direccion, $longitud, $latitud, $idLocal) {
    $conect = conectar();

    $resultado = array('estado' => FALSE);
    try {

        /* Autocommit false para la transaccion */
        $conect->autocommit(FALSE);
        $estadoConsulta = TRUE;

        /* Insert local */
        $sql4 = "UPDATE local SET nombre = ?, direccion = ?, longitud = ?, latitud = ?, fecha_modificacion = '" . date('Y-m-d H:i:s') . "', usuario_id_modificacion = '1'
                WHERE id = ?";
        $stmt4 = $conect->prepare($sql4);
        $stmt4->bind_param('ssssi', $nombre, $direccion, $longitud, $latitud, $idLocal);
        if (!$stmt4->execute()) {
            $estadoConsulta = FALSE;
        }

        $stmt4->close();

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            $conect->commit();
            desconectar($conect);

            $resultado['estado'] = TRUE;
            return $resultado;
        } else {
            $conect->rollback();
            desconectar($conect);
            return $resultado;
        }
    } catch (mysqli_sql_exception $e) {
        $conect->rollback();
        desconectar($conect);
        return $resultado;
    }
}
