$(document).ready(function() {
    $('#tablaAsignacion').DataTable({
        destroy: true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            { 
                extend: 'copyHtml5', 
                text: '<i class="fa-solid fa-copy"></i> Copiar', 
                className: 'btn-dt-copy' 
            },
            { 
                extend: 'excelHtml5', 
                text: '<i class="fa-solid fa-file-excel"></i> Excel', 
                className: 'btn-dt-excel' 
            },
            { 
                extend: 'pdfHtml5', 
                text: '<i class="fa-solid fa-file-pdf"></i> PDF', 
                className: 'btn-dt-pdf' 
            },
            { 
                extend: 'print', 
                text: '<i class="fa-solid fa-print"></i> Imprimir', 
                className: 'btn-dt-print' 
            }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });
});

function eliminarAsignacion(id) {
    if(confirm("¿Estás seguro de retirar este equipo de la persona?")){
        $.ajax({
            type: "POST",
            data: { id_asignacion: id },
            url: "../../modulos/asignacion/eliminarAsignacion.php",
            success: function(r){
                if(r == 1){
                    alert("¡Asignación eliminada con éxito!");
                    location.reload();
                } else {
                    alert("Error al eliminar la asignación.");
                }
            }
        });
    }
}