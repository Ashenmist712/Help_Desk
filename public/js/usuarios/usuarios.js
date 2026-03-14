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