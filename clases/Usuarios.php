<?php
include "conexion.php";

class Usuarios extends Conexion
{
    public function loginUsuario($usuario, $password)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM t_usuarios 
                WHERE usuario = '$usuario' AND password = '$password'";
        $respuesta = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($respuesta) > 0) {
            $datosUsuario = mysqli_fetch_array($respuesta);
            $_SESSION['usuario']['nombre'] = $datosUsuario['usuario'];
            $_SESSION['usuario']['id'] = $datosUsuario['id_usuario'];
            $_SESSION['usuario']['rol'] = $datosUsuario['id_rol'];

            return 1;
        } else {
            return 0;
        }
    }

    public function agregaNuevoUsuario($datos)
    {
        $conexion = Conexion::conectar();
        $idPersona = self::agregarPersona($datos);

        if ($idPersona > 0) {

            $sql = "INSERT INTO t_usuarios (id_rol, 
                                            id_persona, 
                                            usuario, 
                                            password, 
                                            ubicacion) 
                    VALUES (?, ?, ?, ?, ?)";

            $query = $conexion->prepare($sql);


            $query->bind_param(
                "iisss",
                $datos['idRol'],
                $idPersona,
                $datos['usuario'],
                $datos['password'],
                $datos['ubicacion']
            );

            $respuesta = $query->execute();
            return $respuesta;
        } else {
            return 0;
        }
    }

    public function agregarPersona($datos)
    {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO t_persona (paterno, 
                                        materno, 
                                        nombre, 
                                        fecha_nacimiento, 
                                        sexo, 
                                        telefono, 
                                        correo) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $query = $conexion->prepare($sql);


        $query->bind_param(
            "sssssss",
            $datos['paterno'],
            $datos['materno'],
            $datos['nombre'],
            $datos['fechaNacimiento'],
            $datos['sexo'],
            $datos['telefono'],
            $datos['correo']
        );

        $respuesta = $query->execute();

        $idPersona = $conexion->insert_id;
        $query->close();

        return $idPersona;
    }
}
