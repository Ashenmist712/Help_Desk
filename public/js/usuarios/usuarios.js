$(document).ready(function() {
    
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
function agredarIdUsuarioReset(idUsuario){
    $('#idUsuarioReset').val(idUsuario);
}
function resetPassword(){
     $.ajax({
        type: "POST",
        data: $('#frmActualizaPassword').serialize(),
        url: "../procesos/usuarios/extras/resetPassword.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                $('#modalResetPassword').modal('hide'); 
                swal.fire(":D", "Cambio de password exitoso!", "success");
            } else {
                swal.fire(":(", "Error al actualizar password!" + respuesta, "error");
            }
        }
    });
    return false;
}

