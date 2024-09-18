<?php
include('../../../Model/conexion.php');

$conexion = new Conexion();

try {
    $consulta = 'SELECT usuarios.id, nombre, apellido, correo, roles.descripcion FROM usuarios INNER JOIN roles ON usuarios.id_Rol = roles.id;';
    $usuario = $conexion->ConsultaCompleja($consulta);
    echo json_encode($usuario);
} catch (PDOException $e) {
    echo 'error: ' . $e->getMessage();
}
