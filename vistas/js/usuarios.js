/**capturar ruta*/

var rutaActual = location.href;

$(".btnIngreso").click(function() {
    localStorage.setItem("rutaActual", rutaActual);
})



/**FORMATEAR IMPUTS */
$("input").focus(function() {
    $(".alert").remove();
})


/**validar email repetido */
var validarEmailRepetido = false;

$("#regEmail").change(function() {
    var email = $("#regEmail").val();

    var datos = new FormData();
    datos.append("validarEmail", email);


    $.ajax({
        url: rutaOculta + "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {

            if (respuesta == "false") {
                $(".alert").remove();
                validarEmailRepetido = false;

            } else {
                var modo = JSON.parse(respuesta).modo;
                console.log(modo);
                if (modo == "directo") {

                    modo = "esta página";

                }
                $("#regEmail").parent().before('<div class="alert alert-warning"><strong>Error:</strong> el correo electrónico ya esta registrado con otra cuenta. Se registro a traves de ' + modo + ' , ingresa uno diferente.</div>');
                validarEmailRepetido = true;
            }


        }


    })


})

/**VALIDACION DEL REGISTRO DEL USUARIO */

function registroUsuario() {
    /**VALIDAR nombre */

    var nombre = $("#regUsuario").val();

    if (nombre != "") {

        var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
        if (!expresion.test(nombre)) {
            $("#regUsuario").parent().before('<div class="alert alert-danger"><strong>Error:</strong> no se permineten números ni caracteres especiales</div>')
            return false;
        }

    } else {
        $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Atencion:</strong> campo obligatorio</div>')
        return false;
    }


    /**VALIDAR correo */

    var email = $("#regEmail").val();

    if (email != "") {

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

        if (!expresion.test(email)) {

            $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>')

            return false;

        }

        if (validarEmailRepetido) {

            $("#regEmail").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>')

            return false;

        }

    } else {

        $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')

        return false;
    }

    /**VALIDAR CONTRASEÑA */

    var password = $("regPassword").val();

    if (password != "") {

        var expresion = /^[a-zA-Z0-9]*$/;
        if (!expresion.test(password)) {
            $("#regPassword").parent().before('<div class="alert alert-danger"><strong>Error:</strong> escribir direccion de correo valida</div>')
            return false
        }

    } else {
        $("#regPassword").parent().before('<div class="alert alert-warning"><strong>Atencion:</strong> campo obligatorio</div>')
        return false;
    }

    /**VALIDAR POLITICAS */
    var politicas = $("#regPoliticas:checked").val();
    if (politicas != "on") {

        $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>Atencion:</strong> debes aceptar las condiciones de uso y las politicas de privacidad</div>')
        return false;
    }


    return true;
}

/**CAMBIAR FOTO */

$("#btnCambiarFoto").click(function() {
    $("#imgPerfil").toggle();
    $("#subirImagen").toggle();
})
$("#datosImagen").change(function() {
    var imagen = this.files[0];

    /**VALIDARFORMATO FOTO */

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $("#datosImagen").val("");

        swal({
                title: "Error al subir la imagen",
                text: "La imagen debe estar en formato JPG o PNG",
                type: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location = rutaOculta + "perfil";
                }
            });
    } else if (Number(imagen["size"]) > 2000000) {
        $("#datosImagen").val("");

        swal({
                title: "Error al subir la imagen",
                text: "La imagen no debe pesar más de 2 MB",
                type: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location = rutaOculta + "perfil";
                }
            });
    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);

        })

    }

})

$("#eliminarUsuario").click(function() {

    var id = $("#idUsuario").val();

    if ($("#modoUsuario").val() == "directo") {
        if ($("#fotoUsuario").val() != "") {
            var foto = $("#fotoUsuario").val();
        }
    }

    swal({
            title: "¿Está seguro(a) de eliminar su cuenta?",
            text: "Al eliminar esta cuenta ya no se pueden recuperar los datos",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Borrar",
            closeOnConfirm: false
        },
        function(isConfirm) {
            if (isConfirm) {
                window.location = "index.php?ruta=perfil&id=" + id + "&foto=" + foto;
            }
        });
    window.location = "index.php?ruta=perfil&id=" + id + "&foto=" + foto;

})