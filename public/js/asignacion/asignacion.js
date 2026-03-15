$(document).ready(function(){
    $('#tablaAsignacionesLoad').load('asignacion/tablaAsignacion.php');
}); 

function asignarEquipo() {
    $.ajax({
        type: "POST",
        data: $('#frmAsignarEquipo').serialize(),
        url: "../procesos/asignacion/asignar.php",
        success: function(respuesta) {
            respuesta=respuesta.trim();
            if (respuesta == 1) {
                $('#frmAsignarEquipo')[0].reset(),
                $('#tablaAsignacionesLoad').load('asignacion/tablaAsignacion.php');
                Swal.fire(":D", "Asignado con Exito!","success");
            }else{
                Swal.fire(":(", "Fallo al asignar"+respuesta, "success");
            }

        }
    });
    return false;
}
function eliminarAsignacion(idAsignacion) {
    Swal.fire({
        title: '¿Estás seguro de eliminar esta asignación?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                data: "idAsignacion=" + idAsignacion,
                url: "../procesos/asignacion/eliminarAsignacion.php",
                success: function(respuesta) {
                    respuesta = respuesta.trim();
                    if (respuesta == 1) {
                        $('#tablaAsignacionesLoad').load('asignacion/tablaAsignacion.php');
                        Swal.fire(
                            '¡Eliminado!',
                            'La asignación ha sido borrada.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            ':(',
                            'Error al eliminar: ' + respuesta,
                            'error'
                        );
                    }
                }
            });
        }
    });
}