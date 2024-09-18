<?php
    include('../../Model/conexion.php');

    $conexion = new Conexion();

    $conexion -> conectar();

    try{
        $consulta = "SELECT servicios.descripcion_Servicio as descripcion, COUNT(*) as cantidad FROM citas INNER JOIN servicios on id_Servicio = servicios.id GROUP BY id_Servicio";
        $data = $conexion -> ConsultaCompleja($consulta);
        print json_encode($data);

    }catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }finally{
        $conexion -> Desconectar();
    }


?>