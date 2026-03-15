$(document).ready(function() {
    $(tablaUsuariosLoad).load('usuarios/tablaUsuarios.php');
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
                $('#tablaUsuariosLoad')[0].reset();
            }else {
                swal.fire(":(", "Error al agregar!" + respuesta, "error");
            }
        }

    });
    return false;
}

function obtenerDatosUsuario (idUsuario){
    $.ajax({
        type: "POST",
        data: "idUsuario=" + idUsuario,
        url: "../procesos/usuarios/CRUD/obtenerDatosUsuario.php",
        success: function(respuesta) {
    respuesta = jQuery.parseJSON(respuesta);

    // El ID del input de HTML lleva "u", pero la respuesta del servidor NO
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
