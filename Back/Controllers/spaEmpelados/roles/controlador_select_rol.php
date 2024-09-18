<?php
include('../../../Model/conexion.php');

$conexion = new Conexion();

try {
    $consulta = 'SELECT id, descripcion FROM roles ';
    $usuario = $conexion->ConsultaCompleja($consulta);
    echo json_encode($usuario);
} catch (PDOException $e) {
    echo 'error: ' . $e->getMessage();
}
