<?php
include "Conexion.php";

class Reportes extends Conexion
{
    public function agregarReporteCliente($datos)
    {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO t_reportes(id_usuario,
                                    id_equipo,
                                    descripcion_problema) 
                VALUES (?, ?, ?)";
        $query = $conexion->prepare($sql);
        $query->bind_param(
            'iis',
            $datos['idUsuario'],
            $datos['idEquipo'],
            $datos['problema']
        );
        $respuesta = $query->execute();
        $query->close();
        return $respuesta;
    }
    public function eliminarReporteCliente($idReporte)
    {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM t_reportes WHERE id_reporte = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('i', $idReporte);
        $respuesta = $query->execute();
        $query->close();
        return $respuesta;
    }
}
