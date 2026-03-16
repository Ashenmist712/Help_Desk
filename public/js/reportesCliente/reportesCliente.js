$(document).ready(function(){
$('#tablaReporteClienteLoad').load('reportesCliente/tablaReportesCliente.php');
});

function agregarNuevoReporte() {
    $.ajax({
        type: "POST",
        data: $('#frmNuevoReporte').serialize(),
        url: "../procesos/reportesCliente/agregarNuevoReporte.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                $('#tablaReportesClienteDataTable').DataTable().ajax.reload();
                $('#frmNuevoReporte')[0].reset(); 
                Swal.fire("¡Listo!", "Reporte creado con éxito", "success");
            } else {
                Swal.fire("Error", "No se pudo crear el reporte", "error");
            }
        }
    });
    return false;
}
function eliminarReporteCliente(idReporte){
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
                url: "../procesos/reportesCliente/eliminarReporteCliente.php",
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