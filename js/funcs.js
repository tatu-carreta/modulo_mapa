function validarAltaLocal() {
    var ok = false;

    var nombre = $("input[name='nombre']");
    var direccion = $("input[name='direccion']");
    var longitud = $("input[name='longitud']");
    var latitud = $("input[name='latitud']");

    if (nombre.val() == "")
    {
        alert("El nombre está vacío.");
        nombre.focus();
    }
    else if (direccion.val() == "")
    {
        alert("La dirección está vacía.");
        direccion.focus();
    }
    else if ((longitud.val() == "") || (latitud.val() == ""))
    {
        alert("Problema en las coordenadas.");
    }
    else
    {
        ok = true;
    }

    return ok;
}

function validarEditarLocal() {
    var ok = false;

    var local = $("input[name='local']");
    var nombre = $("input[name='nombre']");
    var direccion = $("input[name='direccion']");
    var longitud = $("input[name='longitud']");
    var latitud = $("input[name='latitud']");

    if ((local.val() == "") || (isNaN(local.val()))) {
        alert("Problema en los datos recibidos.");
    }
    else if (nombre.val() == "")
    {
        alert("El nombre está vacío.");
        nombre.focus();
    }
    else if (direccion.val() == "")
    {
        alert("La dirección está vacía.");
        direccion.focus();
    }
    else if ((longitud.val() == "") || (latitud.val() == ""))
    {
        alert("Problema en las coordenadas.");
    }
    else
    {
        ok = true;
    }

    return ok;
}

function f_submit_replace(form, validar, path_replace) {
    var post_url = form.attr("action");
    var post_data = form.serialize();

    if (validar) {
        console.log($.ajax({
            type: 'POST',
            url: post_url,
            data: post_data,
            dataType: "json",
            success: function (registro) {
                alert(registro.texto);
                if (registro.estado)
                {
                    window.location.replace(path_replace);
                }
            }
        }));
    }
    return false;
}

function f_eliminar_reload(form, confirmar) {
    var post_url = form.attr("action");
    var post_data = form.serialize();

    if (confirmar) {
        console.log($.ajax({
            type: 'POST',
            url: post_url,
            data: post_data,
            dataType: "json",
            success: function (registro) {
                if (registro.estado)
                {
                    alert("HOLI");
                    window.location.reload();
                }
                else
                {
                    alert(registro.texto);
                }
            }
        }));
    }
    return false;
}

$(function () {
    $("#agregar-local").submit(function (e) {
        e.preventDefault();

        var form = $(this);

        var path_replace_local = PATH_CONTROLLER + "controladorAdmin.php?seccion=listado-locales";
        //var path_replace_www = PATH_HOME + "/../gestion";
        var f_validar = validarAltaLocal();
        //var f_validar = true;

        console.log(f_submit_replace(form, f_validar, path_replace_local));

        return false;
    });
});

$(function () {
    $("#editar-local").submit(function (e) {
        e.preventDefault();

        var form = $(this);

        var path_replace_local = PATH_CONTROLLER + "controladorAdmin.php?seccion=listado-locales";
        //var path_replace_www = PATH_HOME + "/../gestion";
        var f_validar = validarEditarLocal();
        //var f_validar = true;

        f_submit_replace(form, f_validar, path_replace_local);

        return false;
    });
});

$(function () {
    $(".borrar-local").click(function (e) {
        e.preventDefault();

        var form = $("#form-borrar-local-" + $(this).attr("data"));

        var f_confirmar = confirm("¿Está seguro que desea eliminar el local seleccionado?");

        f_eliminar_reload(form, f_confirmar);

        return false;
    });
});

function borrarLocal(data)
{
    var form = $("#form-borrar-local-" + data);

    var f_confirmar = confirm("¿Está seguro que desea eliminar el local seleccionado?");

    var post_url = form.attr("action");
    var post_data = form.serialize();

    if (f_confirmar) {
        console.log($.ajax({
            type: 'POST',
            url: post_url,
            data: post_data,
            dataType: "json",
            success: function (registro) {
                if (registro.estado)
                {
                    window.location.reload();
                }
                else
                {
                    alert(registro.texto);
                }
            }
        }));
    }

    return false;
}