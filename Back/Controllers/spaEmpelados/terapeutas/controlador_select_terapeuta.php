<?php
    include('../../../Model/conexion.php');

    $conexion = new Conexion();

    $conexion -> conectar();
    try {
        $consulta = "SELECT * FROM terapeutas";
        $citas = $conexion->ConsultaCompleja($consulta);
        $data = array();
        foreach ($citas as $row)
        {
            $data[] = $row;
        }
        print json_encode($data);
    } catch (PDOException $e) {
        echo 'error: ' . $e->getMessage();
    }
    finally{
        $conexion -> Desconectar();
    }
?>