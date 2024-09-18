<?php
include('../../../Model/conexion.php');

$id = $_POST['id'];


$conexion = new conexion();
$conexion->conectar();

try {
    $consulta = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo "Registro eliminado correctamente";
    } else {
        echo "Error al eliminar el registro";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conexion->Desconectar();
}
