<?php 

include('../../Model/conexion.php');

$conexion = new Conexion();

$fecha = $_POST['fecha'];
$hora_inicio = $_POST['hora_Inicio'];
$hora_fin = $_POST['hora_Fin'];
$id_Cliente = $_POST['id_Cliente'];
$id_Servicio = $_POST['id_Servicio'];

try {
    $consulta = 'SELECT * FROM citas';
    $citas = $conexion->ConsultaCompleja($consulta);
    echo json_encode($citas);
} catch (PDOException $e) {
    echo 'error: ' . $e->getMessage();
}