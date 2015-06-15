<?php

function obtenerUsuarioPorNombreClave($nombreUsuario, $clave) {
    $conect = conectar();
    
    $nombreUsuario = encriptarPass($nombreUsuario);
    $clave = encriptarPass($clave);
    
    $sql = "SELECT id, nombre_visible
            FROM usuario
            WHERE nombre = ?
            AND clave = ?
            AND estado = 'A'";
    $stmt = $conect->prepare($sql);
    $stmt->bind_param('ss', $nombreUsuario, $clave);
    $stmt->execute();

    $stmt->bind_result($id, $nombre_visible);

    $stmt->store_result();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'estado' => true,
            'id' => $id,
            'nombre_visible' => $nombre_visible,
        );
    } else {
        $result = array(
            'estado' => false
        );
    }

    return $result;
}

function registrarIngresoUsuario($idUsuario) {
    $conect = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $resultado = array('estado' => FALSE);
    try {

        /* Autocommit false para la transaccion */
        $conect->autocommit(FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO usuario_acceso(usuario_id, fecha, ip)
                VALUES (?, '" . date("Y-m-d H:i:s") . "', '" . $_SERVER['REMOTE_ADDR'] . "')";
        $stmt = $conect->prepare($sql);
        $stmt->bind_param('i', $idUsuario);
        if (!$stmt->execute()) {
            $estadoConsulta = FALSE;
        }

        $stmt->close();

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
