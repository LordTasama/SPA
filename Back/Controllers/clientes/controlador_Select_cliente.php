<?php
include('../../Model/conexion.php');

$conexion = new Conexion();

try {
    $consulta = "select id, nombre, apellido, direccion, correo from clientes;";
    $clientes = $conexion->ConsultaCompleja($consulta);
    echo json_encode($clientes);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
