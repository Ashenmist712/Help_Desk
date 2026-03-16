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