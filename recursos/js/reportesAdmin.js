$(document).ready(function() {
    $('#tablaReportesAdmin').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            { extend: 'excelHtml5', text: 'Excel', className: 'btn-dt-excel' },
            { extend: 'pdfHtml5', text: 'PDF', className: 'btn-dt-pdf' },
            { extend: 'print', text: 'Imprimir', className: 'btn-dt-print' }
        ],
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }
    });
});

function obtenerDatosSolucion(idReporte) {
    $('#id_reporte_s').val(idReporte);
    document.getElementById('modalSolucion').style.display = 'block';
    document.getElementById('fondoSolucion').style.display = 'block';
}

function eliminarReporte(id) {
    if(confirm("¿Seguro que quieres borrar este reporte?")){
        $.ajax({
            type: "POST",
            data: { id_reporte: id },
            url: "../../modulos/reportes/eliminarReporte.php",
            success: function(r){ if(r==1) location.reload(); }
        });
    }
}