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
    public function obtenerSolucion($idReporte)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT id_reporte, 
                   solucion_problema, 
                   estatus
            FROM t_reportes 
            WHERE id_reporte = '$idReporte'";

        $respuesta = mysqli_query($conexion, $sql);
        $reporte = mysqli_fetch_array($respuesta);

        $datos = array(
            "idReporte" => $reporte['id_reporte'],
            "estatus" => $reporte['estatus'],
            "solucion" => $reporte['solucion_problema']
        );

        return $datos;
    }
    public function actualizarSolucion($datos)
    {
        $conexion = Conexion::conectar();
        $sql = "UPDATE t_reportes 
        SET solucion_problema = ?,
            estatus = ?,
            id_usuario_tecnico = ?
        WHERE id_reporte = ?";

        $query = $conexion->prepare($sql);
        $query->bind_param(
            'siii',
            $datos['solucion'],
            $datos['estatus'],
            $datos['idUsuario'],
            $datos['idReporte']
        );
        $respuesta = $query->execute();
        $query->close();
        return $respuesta;
    }
}
