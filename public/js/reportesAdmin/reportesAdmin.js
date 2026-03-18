function obtenerDatosSolucion(idReporte) {
    $.ajax({
        type: "POST",
        data: "idReporte=" + idReporte,
        url: "../procesos/reportesAdmin/obtenerSolucion.php", 
        success: function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#idReporte').val(respuesta['idReporte']);
            $('#solucion').val(respuesta['solucion']);
            $('#estatus').val(respuesta['estatus']); 
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
                $('#modalAgregarSolucionReporte').modal('hide'); 
                Swal.fire(":D", "Solución agregada con éxito", "success");
            } else {
                Swal.fire(":(", "Fallo al agregar solución: " + respuesta, "error");
            }
        }
    });
    return false; 
}