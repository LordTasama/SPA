<?php
include('../../Model/conexion.php');

$conexion = new Conexion();

$conexion -> conectar();

try {
    $consulta = "SELECT DATE_FORMAT(fecha, '%D') AS Dia , DATE_FORMAT(fecha, '%m') AS Mes , DATE_FORMAT(fecha, '%Y') AS Year, sum(servicios.valor_Servicio) as ingreso FROM citas INNER JOIN servicios ON id_Servicio = servicios.id GROUP BY fecha
;";
    $data = $conexion->ConsultaCompleja($consulta);
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
