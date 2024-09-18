<?php
    include('../../Model/conexion.php');

    $conexion = new Conexion();

    $conexion -> conectar();

    try{
        $consulta = "SELECT descripcion_Servicio as descripcion , valor_Servicio as valor FROM servicios";
        $data = $conexion -> ConsultaCompleja($consulta);
        print json_encode($data);

    }catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }finally{
        $conexion -> Desconectar();
    }


?>