<?php

/*
 * Función de sanearDatos por posibles ataques XSS
 */

function sanearDatos($tags) {
    $tags = strip_tags($tags);
    $tags = stripslashes($tags);
    $tags = htmlentities($tags);
    return $tags;
}

/*
 * Función de encriptación aleatoria, cada vez que se ejecuta.
 */

function blow_crypt($input, $rounds = 7) {
    $salt = "";
    $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    for ($i = 0; $i < 22; $i++) {
        $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}

/*
 * Función de triple encriptación para contraseñas y usuarios seguros.
 */

function hashData($string) {
    $string = hash("haval224,4", md5(crypt($string, "$2a$%02d$")));
    return $string;
}

/*
 * Función para validación correcta de fecha, en base al un formato
 * pasado por parámetro o por defecto Y-m-d
 */

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function urlAmigable($string, $replacement = '-', $map = array()) {
    if (is_array($replacement)) {
        $map = $replacement;
        $replacement = '+';
    }
    $quotedReplacement = preg_quote($replacement, '/');

    $merge = array(
        '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
        '/\\s+/' => $replacement,
        sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
    );

    $_transliteration = array(
        '/ä|æ|ǽ/' => 'ae',
        '/ö|œ/' => 'oe',
        '/ü/' => 'ue',
        '/Ä/' => 'Ae',
        '/Ü/' => 'Ue',
        '/Ö/' => 'Oe',
        '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
        '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
        '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
        '/ç|ć|ĉ|ċ|č/' => 'c',
        '/Ð|Ď|Đ/' => 'D',
        '/ð|ď|đ/' => 'd',
        '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
        '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
        '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
        '/ĝ|ğ|ġ|ģ/' => 'g',
        '/Ĥ|Ħ/' => 'H',
        '/ĥ|ħ/' => 'h',
        '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
        '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
        '/Ĵ/' => 'J',
        '/ĵ/' => 'j',
        '/Ķ/' => 'K',
        '/ķ/' => 'k',
        '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
        '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
        '/Ñ|Ń|Ņ|Ň/' => 'N',
        '/ñ|ń|ņ|ň|ŉ/' => 'n',
        '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
        '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
        '/Ŕ|Ŗ|Ř/' => 'R',
        '/ŕ|ŗ|ř/' => 'r',
        '/Ś|Ŝ|Ş|Š/' => 'S',
        '/ś|ŝ|ş|š|ſ/' => 's',
        '/Ţ|Ť|Ŧ/' => 'T',
        '/ţ|ť|ŧ/' => 't',
        '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
        '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
        '/Ý|Ÿ|Ŷ/' => 'Y',
        '/ý|ÿ|ŷ/' => 'y',
        '/Ŵ/' => 'W',
        '/ŵ/' => 'w',
        '/Ź|Ż|Ž/' => 'Z',
        '/ź|ż|ž/' => 'z',
        '/Æ|Ǽ/' => 'AE',
        '/ß/' => 'ss',
        '/Ĳ/' => 'IJ',
        '/ĳ/' => 'ij',
        '/Œ/' => 'OE',
        '/ƒ/' => 'f'
    );

    $map = $map + $_transliteration + $merge;
    return preg_replace(array_keys($map), array_values($map), $string);
}

function invertirFecha($fecha) {
    // Invierte las que vienen con el formato dd-mm-aaaa
    $fechaInvertir = explode("-", $fecha);
    $fechaInvertida = $fechaInvertir[2] . "-" . $fechaInvertir[1] . "-" . $fechaInvertir[0];
    return $fechaInvertida;
}

function dateadd($date, $dd = 0, $mm = 0, $yy = 0, $hh = 0, $mn = 0, $ss = 0) {
    $date_r = getdate(strtotime($date));

    $date_result = date("Y-m-d h:i:s", mktime(($date_r["hours"] + $hh), ($date_r["minutes"] + $mn), ($date_r["seconds"] + $ss), ($date_r["mon"] + $mm), ($date_r["mday"] + $dd), ($date_r["year"] + $yy)));

    return $date_result;
}

function sumarRestarSobreFecha($fecha, $cant, $tipo = 'day', $accion = '+') {
    $nuevafecha = strtotime($accion . $cant . ' ' . $tipo, strtotime($fecha));
    $nuevafecha = date('Y-m-d', $nuevafecha);

    return $nuevafecha;
}

function encriptarPass($pass) {

    $pass_encriptada1 = md5($pass); //Encriptacion nivel 1

    $pass_encriptada2 = crc32($pass_encriptada1); //Encriptacion nivel 1

    $pass_encriptada3 = crypt($pass_encriptada2, "xtemp"); //Encriptacion nivel 2

    $pass_encriptada4 = sha1("xtemp" . $pass_encriptada3); //Encriptacion nivel 3



    return $pass_encriptada4;
}

function validar_clave($clave, &$error_clave) {
    if (strlen($clave) < 8) {
        $error_clave = "La clave debe tener al menos 8 caracteres.";
        return false;
    }
    if (strlen($clave) > 16) {
        $error_clave = "La clave no puede tener más de 16 caracteres.";
        return false;
    }
    if (preg_match('`[\?\¿\¡\'\"\!\ª\º\%\|\@\#\·\$\~\€\¬\&\/\(\)\=\[\]\}\{\.\:\,\;\<\>\^\`\+\*\¨\ç\Ç]`', $clave)) {
        $error_clave = "La clave que está queriendo ingresar contiene caracteres que no son permitidos.";
        return false;
    }
    if (!preg_match('`[a-z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra minúscula.";
        return false;
    }
    if (!preg_match('`[A-Z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra mayúscula.";
        return false;
    }
    if (!preg_match('`[0-9]`', $clave)) {
        $error_clave = "La clave debe tener al menos un caracter numérico.";
        return false;
    }
    if (!preg_match('`[\-\_]`', $clave)) {
        $error_clave = "La clave debe tener al menos un caracter especial.";
        return false;
    }

    $error_clave = "";
    return true;
}

function rellenarCeros($entero, $largo) {
    // Limpiamos por si se encontraran errores de tipo en las variables
    $entero = (int) $entero;
    $largo = (int) $largo;

    $relleno = '';

    /**
     * Determinamos la cantidad de caracteres utilizados por $entero
     * Si este valor es mayor o igual que $largo, devolvemos el $entero
     * De lo contrario, rellenamos con ceros a la izquierda del número
     * */
    if (strlen($entero) < $largo) {
        $relleno = str_pad((int) $entero, $largo, "0", STR_PAD_LEFT);
        return $relleno;
    }
    return $relleno . $entero;
}

function cambiarFechaaformatoBD($fecha) { // pasa de dd/mm/AAAA a AAAA-mm-dd
    if ($fecha != "") {
        $fechaaux = explode('/', $fecha);
        $fecha = $fechaaux[2] . "-" . $fechaaux[1] . "-" . $fechaaux[0];
    } else {
        $fecha = '0000-00-00';
    }
    return $fecha;
}

function cambiarFechaFormatoParaMostrar($fecha) { // pasa del AAAA-mm-dd a dd/mm/AAAA
    if ($fecha != "" && $fecha != "0000-00-00") {
        $fechaaux = explode('-', $fecha);
        $fecha = $fechaaux[2] . "/" . $fechaaux[1] . "/" . $fechaaux[0];
    } else {
        $fecha = "";
    }
    return $fecha;
}
