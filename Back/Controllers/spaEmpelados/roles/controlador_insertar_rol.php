<?php
include('../../../Model/conexion.php');

$descripcion = $_POST['descripcion'];

$conexion = new conexion();
$conexion->conectar();


try {
    $consulta = "INSERT INTO roles (descripcion) VALUES (:descripcion)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo "Descripcion Creada Exitosamente";
    } else {
        echo "Error en la consulta";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conexion->Desconectar();
}