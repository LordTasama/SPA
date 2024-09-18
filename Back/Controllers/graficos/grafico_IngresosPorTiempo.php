<?php
    include('../../Model/conexion.php');

    $conexion = new Conexion();

    $conexion -> conectar();

    try{
        $consulta = "SELECT DATE_FORMAT(fecha, '%M') AS mes, SUM(servicios.valor_Servicio) as total FROM citas INNER JOIN servicios ON id_Servicio = servicios.id GROUP BY mes ORDER BY FIELD(mes, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); ";
        $data = $conexion -> ConsultaCompleja($consulta);
        print json_encode($data);

    }catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }finally{
        $conexion -> Desconectar();
    }


?>