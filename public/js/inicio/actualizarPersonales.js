function actualizarDatosPersonales(){
    $.ajax({
        type: "POST",
        data: $('#frmActualizarDatosPersonales').serialize(),
        url: "../procesos/inicio/actualizarDatosPersonales.php",
        success: function(respuesta) {

            respuesta=respuesta.trim();
            if (respuesta == 1) {
                if ($('#frmActualizarDatosPersonales').length > 0) {
                    $('#frmActualizarDatosPersonales')[0].reset();
                }
                Swal.fire(":D", "Actualizado con Exito!", "success").then(() => {
                    
                    location.reload();
                });
            }else{
                Swal.fire(":(", "Fallo al actualizar"+respuesta, "error");
            }

        }
    });
    return false;
}
function obtenerPersonalesInicio(idUsuario) {
    $.ajax({
        type: "POST",
        data: "idUsuario=" + idUsuario,
        url: "../procesos/usuarios/crud/obtenerDatosUsuario.php",
        success: function(respuesta) {
            
            respuesta = JSON.parse(respuesta.trim());

            
            $('#idUsuarioInicio').val(respuesta['idUsuario']); 
            $('#paternoInicio').val(respuesta['paterno']);
            $('#maternoInicio').val(respuesta['materno']);
            $('#nombreInicio').val(respuesta['nombrePersona']);
            $('#telefonoInicio').val(respuesta['telefono']);
            $('#correoInicio').val(respuesta['correo']);
            $('#fechaInicio').val(respuesta['fechaNacimiento']); 
        }
    });
}
