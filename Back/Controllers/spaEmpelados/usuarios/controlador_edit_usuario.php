<?php

include('../../../Model/conexion.php');


$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$id_Rol = $_POST['id_Rol'];

$conexion = new conexion();
$conexion->conectar();

try {
    $consulta = "UPDATE usuarios SET nombre =:nombre, apellido = :apellido, correo = :correo,  id_Rol = :id_Rol WHERE id =  :id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido',$apellido, PDO::PARAM_STR);
    $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
    $stmt->bindParam(':id_Rol',$id_Rol, PDO::PARAM_INT);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo "Consulta ejecutada correctamente";
    } else {
        echo "Error en la consulta";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conexion->Desconectar();
}
