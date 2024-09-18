<?php
include('../../Model/conexion.php');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$id_Servicio = $_POST['id_Servicio'];

$conexion = new conexion();
$conexion->conectar();


try {
    $consulta = "INSERT INTO clientes (nombre, apellido, direccion, correo, id_Servicio) VALUES (:nombre, :apellido, :direccion, :correo, :id_Servicio)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->bindParam(':id_Servicio', $id_Servicio, PDO::PARAM_INT);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo $nombre." ".$apellido." Creado Exitosamente";
    } else {
        echo "Error en la consulta";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conexion->Desconectar();
}