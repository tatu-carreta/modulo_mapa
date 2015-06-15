<?php

require_once (__DIR__) . '/../php/funciones/funcionesPhp.php';
require_once (__DIR__) . '/../php/config.php';
require_once (__DIR__) . '/../php/configTwigPhp.php';

$seccion = $_GET['seccion'];

switch ($seccion) {

    case 'login':
        if (logueado()) {
            $info['texto'] = "Usted ya está logueado.";

            $url = "pagina-error.twig";
        } else {
            if (isset($_GET['error']) && ($_GET['error'] == 'ok')) {
                $info['error'] = "Los datos ingresados son incorrectos. Vuelva a intentarlo.";
            }

            $url = "login.twig";
        }
        break;
    case 'mapa':
        require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
        require_once (__DIR__) . '/../php/funciones/funcionesLocal.php';

        $locales = obtenerLocales();

        foreach ($locales as $local => $key) {
            $locales[$local]['nombre'] = utf8_encode($locales[$local]['nombre']);
            $locales[$local]['direccion'] = utf8_encode($locales[$local]['direccion']);
        }

        $info['locales'] = $locales;

        $url = "mapa.twig";

        break;
    case 'agregar-local':

        if (logueado()) {
            $url = "agregar-local.twig";
        } else {
            $info['texto'] = "Para acceder a esta sección, debe loguearse previamente.";

            $url = "pagina-error.twig";
        }

        break;
    case 'editar-local':
        if (logueado()) {
            require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
            require_once (__DIR__) . '/../php/funciones/funcionesLocal.php';
            require_once (__DIR__) . '/../php/validate/validateLocal.php';

            $infoValidate = validarLocal();

            if ($infoValidate['estado']) {

                $idLocal = sanearDatos($_POST['local']);

                $datosLocal = obtenerLocalPorId($idLocal);

                if ($datosLocal['estado']) {

                    $datosLocal['nombre'] = utf8_encode($datosLocal['nombre']);
                    $datosLocal['direccion'] = utf8_encode($datosLocal['direccion']);

                    $info['datosLocal'] = $datosLocal;

                    $url = "editar-local.twig";
                } else {
                    $info['texto'] = "El local que intenta editar no existe. Vuelva a intentarlo.";

                    $url = "pagina-error.twig";
                }
            } else {
                $info['texto'] = "Hubo un error en los datos recibidos. Vuelva a intentarlo.";

                $url = "pagina-error.twig";
            }
        } else {

            $info['texto'] = "Para acceder a esta sección, debe loguearse previamente.";

            $url = "pagina-error.twig";
        }

        break;
    case 'listado-locales':
        if (logueado()) {
            require_once (__DIR__) . '/../php/funciones/funcionesConector.php';
            require_once (__DIR__) . '/../php/funciones/funcionesLocal.php';

            $locales = obtenerLocalesAdmin();

            foreach ($locales as $local => $key) {
                $locales[$local]['nombre'] = utf8_encode($locales[$local]['nombre']);
                $locales[$local]['direccion'] = utf8_encode($locales[$local]['direccion']);
            }

            $info['locales'] = $locales;

            $url = "listado-locales.twig";
        } else {
            $info['texto'] = "Para acceder a esta sección, debe loguearse previamente.";

            $url = "pagina-error.twig";
        }

        break;
    default :
        $url = "pagina-error.twig";

        break;
}

/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate($url);

/* Pasaje del arreglo a la vista .twig */
$template->display($info);
