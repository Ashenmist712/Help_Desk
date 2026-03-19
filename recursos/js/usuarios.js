

function abrirEditar(id, nombre, pat, mat, tel, correo, fecha) {
    document.getElementById('edit_id_persona').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_paterno').value = pat;
    document.getElementById('edit_materno').value = mat;
    document.getElementById('edit_telefono').value = tel;
    document.getElementById('edit_correo').value = correo;
    document.getElementById('edit_fecha_nac').value = fecha;

    document.getElementById('modalEditar').style.display = 'block';
    document.getElementById('fondoModal').style.display = 'block';
}

function cerrarModal() {
    document.getElementById('modalEditar').style.display = 'none';
    document.getElementById('fondoModal').style.display = 'none';
}


window.onclick = function(event) {
    let fondo = document.getElementById('fondoModal');
    if (event.target == fondo) {
        cerrarModal();
    }
}
$(document).ready(function() {
    
    $('#tablaUsuarios').DataTable({
        destroy: true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa-solid fa-copy"></i> Copiar', className: 'btn-dt-copy' },
            { extend: 'excelHtml5', text: '<i class="fa-solid fa-file-excel"></i> Excel', className: 'btn-dt-excel' },
            { extend: 'pdfHtml5', text: '<i class="fa-solid fa-file-pdf"></i> PDF', className: 'btn-dt-pdf' },
            { extend: 'print', text: '<i class="fa-solid fa-print"></i> Imprimir', className: 'btn-dt-print' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });
});


function eliminarUsuario(idUsuario, idPersona) {
    if (confirm("¿Estás seguro de eliminar este usuario? Esta acción borrará también sus datos personales.")) {
        $.ajax({
            type: "POST",
            data: { 
                id_usuario: idUsuario, 
                id_persona: idPersona 
            },
            url: "../../modulos/usuarios/eliminar.php",
            success: function(respuesta) {
                if (respuesta == 1) {
                    alert("¡Usuario eliminado con éxito!");
                    location.reload(); 
                } else {
                    alert("Error al eliminar: " + respuesta);
                }
            }
        });
    }
}


function obtenerDatosUsuario(idUsuario) {
    $.ajax({
        type: "POST",
        data: { id_usuario: idUsuario },
        url: "../../modulos/usuarios/obtenerDatos.php",
        success: function(respuesta) {
            let datos = JSON.parse(respuesta);
            
            
            $('#id_usuario_u').val(datos.id_usuario);
            $('#id_persona_u').val(datos.id_persona);
            $('#nombre_u').val(datos.nombre);
            $('#paterno_u').val(datos.paterno);
            $('#materno_u').val(datos.materno);
            $('#usuario_u').val(datos.usuario);
            $('#id_rol_u').val(datos.id_rol);
            
            abrirModalEditar(); 
        }
    });
}