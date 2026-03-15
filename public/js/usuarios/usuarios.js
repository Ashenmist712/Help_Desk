$(document).ready(function() {
    // Agregué las comillas y el # que faltaban aquí
    $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
});

function agregarNuevoUsuario(){
    $.ajax({
        type: "POST",
        data: $('#frmAgregarUsuario').serialize(),
        url: "../procesos/usuarios/CRUD/agregarUsuario.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
                swal.fire(":D", "Agregado con exito!", "success");
                
                // CORRECCIÓN: El reset es para el FORMULARIO, no para la tabla
                $('#frmAgregarUsuario')[0].reset(); 
            } else {
                swal.fire(":(", "Error al agregar!" + respuesta, "error");
            }
        }
    });
    return false;
}

function obtenerDatosUsuario(idUsuario){
    $.ajax({
        type: "POST",
        data: "idUsuario=" + idUsuario,
        url: "../procesos/usuarios/CRUD/obtenerDatosUsuario.php",
        success: function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#paternou').val(respuesta['paterno']);
            $('#maternou').val(respuesta['materno']);
            $('#nombreu').val(respuesta['nombrePersona']);
            $('#fechaNacimientou').val(respuesta['fechaNacimiento']);
            $('#sexou').val(respuesta['sexo']);
            $('#telefonou').val(respuesta['telefono']);
            $('#correou').val(respuesta['correo']);
            $('#usuariou').val(respuesta['nombreUsuario']);
            $('#idRolu').val(respuesta['idRol']);
            $('#ubicacionu').val(respuesta['ubicacion']);
            $('#idUsuariou').val(respuesta['id_usuario']); 
        }
    });
}

function actualizarUsuario(){
    $.ajax({
        type: "POST",
        data: $('#frmActualizarUsuario').serialize(),
        url: "../procesos/usuarios/CRUD/actualizarUsuario.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                
                $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
                $('#modalActualizarUsuarios').modal('hide'); 
                $('.btn-close').click(); 
                $('.close').click(); 
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                swal.fire(":D", "Actualizado con exito!", "success");
                $('#frmActualizarUsuario').trigger("reset");
            } else {
                swal.fire(":(", "Error al actualizar!" + respuesta, "error");
            }
        }
    });
    return false;
}

