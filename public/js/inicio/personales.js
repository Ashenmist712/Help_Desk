function datosPersonalesInicio(idUsuario) {
    $.ajax({
        type: "POST",
    
        data: { "idUsuario": idUsuario }, 
        url: "../procesos/usuarios/CRUD/obtenerDatosUsuario.php",
        success: function(respuesta) {
            
            respuesta = JSON.parse(respuesta.trim());
            
            $('#paterno').text(respuesta['paterno']);
            $('#materno').text(respuesta['materno']);
            $('#nombre').text(respuesta['nombrePersona']);
            $('#telefono').text(respuesta['telefono']);
            $('#correo').text(respuesta['correo']);
            $('#edad').text(respuesta['fechaNacimiento']);
            
        }
    });
}