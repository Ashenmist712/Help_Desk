$(document).ready(function(){
    $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php'); 
});

function eliminarReporteAdmin(idReporte){
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
                data: "idReporte=" + idReporte,
                url: "procesos/reportesAdmin/obtenerSolucion.php",
                success: function(respuesta) {
                    respuesta = respuesta.trim();
                    if (respuesta == 1) {
                        $('#tablaReporteClienteLoad').load('reportesCliente/tablaReportesCliente.php');
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

function obtenerDatosSolucion(idReporte) {
    $.ajax({
        type: "POST",
        data: "idReporte=" + idReporte,
        url: "../procesos/reportesAdmin/obtenerSolucion.php", 
        success: function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#idReporte').val(respuesta['idReporte']);
            $('#solucion').val(respuesta['solucion']);
            $('#estatus').val(respuesta[['estatus']]);
        }
    });
}

function agregarSolucionReporte() {
    $.ajax({
        type: "POST",
        data: $('#frmAgregarSolucionReporte').serialize(),
        url: "../procesos/reportesAdmin/actualizarSolucion.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();
            
            if (respuesta == 1) {
                
                $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');
                $('#modalAgregarSolucion').modal('hide');
                Swal.fire(":D", "Solución agregada con éxito", "success");
            } else {
                Swal.fire(":(", "Fallo al agregar solución: " + respuesta, "error");
            }
        }
    });

    return false; 
}