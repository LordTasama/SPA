<?php
    include('../../Model/conexion.php');

    $conexion = new Conexion();
    $conexion -> conectar();
    try {
        $consulta = "SELECT * FROM productos";
        $stmt = $conexion -> ConsultaCompleja($consulta);
        $resultado = $stmt;
        $data = array();
        foreach ($resultado as $row)
        {
            $data[] = $row;
        }
        print json_encode($data);
    }
    catch (PDOException $e){
        echo 'error: ' . $e->getMessage();
        $conexion -> Desconectar();
    }

?>