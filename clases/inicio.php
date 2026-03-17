<?php
include 'conexion.php';

class inicio extends Conexion
{
    public function actulizarPersonales($datos)
    {
        $conexion = Conexion::conectar();
        $idUsuario = $datos['idUsuario'];


        $sql = "SELECT id_persona FROM t_usuarios WHERE id_usuario = '$idUsuario'";
        $result = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($result);
        $idPersona = $fila['id_persona'];


        $sql = "UPDATE t_persona 
                SET paterno = ?, 
                    materno = ?, 
                    nombre = ?, 
                    telefono = ?, 
                    correo = ?, 
                    fecha_nacimiento = ? 
                WHERE id_persona = ?";

        $query = $conexion->prepare($sql);

        $query->bind_param(
            "ssssssi",
            $datos['paterno'],
            $datos['materno'],
            $datos['nombre'],
            $datos['telefono'],
            $datos['correo'],
            $datos['fecha'],
            $idPersona
        );

        $respuesta = $query->execute();
        $query->close();

        return $respuesta;
    }
}
