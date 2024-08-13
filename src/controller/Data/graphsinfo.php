<?php

session_start();

date_default_timezone_set("America/Bogota");

$date = date("Y/m/d");

$fecha = new DateTime($date);

$fecha->add(new DateInterval('P1D'));

$fecha = $fecha->format("Y/m/d");



require_once '../../config/mysql.php';

$mysql = new Mysql;


try{
    if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
        isset($_SESSION['login'])){
        $id = $_SESSION['id'];
        $mysql->conectar();
        $stmt = $mysql->consulta("SELECT estado FROM usuario where id = ?",[$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        
        if (count($result) == 1){
        if($result[0] != 1){
        session_destroy();
        echo '{"data":"Su estado es inactivo","response":"error"}';
        exit;
        }
        else{
            $mysql->conectar();


            //Gráficas
        if(isset($_GET["query"])){
        $query = $_GET["query"];   
  

        if($query == 1){
        $stmt = $mysql->consulta("SELECT servicio.nombre as x, COUNT(id_servicio) as y FROM cita  INNER JOIN servicio ON id_servicio = servicio.id GROUP BY id_servicio  ORDER BY y DESC",[]); 
        echo json_encode($stmt -> fetchAll(PDO::FETCH_ASSOC));
        }
        else if($query == 2){
        $stmt = $mysql->consulta("SELECT servicio.nombre as x, SUM(servicio.precio) as y FROM cita  INNER JOIN servicio ON id_servicio = servicio.id GROUP BY id_servicio  ORDER BY y DESC",[]); 
        echo json_encode($stmt -> fetchAll(PDO::FETCH_ASSOC));
        }
        //Reportes
        else if($query == "clientes"){
        $stmt = $mysql->consulta("SELECT id_cliente,nombres,apellidos,servicio.nombre,COUNT(servicio.nombre) as 'Frecuencia del servicio'  FROM cita INNER JOIN cliente ON cita.id_cliente = cliente.id INNER JOIN servicio ON cita.id_servicio = servicio.id GROUP by servicio.nombre",[]); 
        echo json_encode($stmt -> fetchAll(PDO::FETCH_ASSOC));
        }
        else if($query == "ocupacion"){
        $stmt = $mysql->consulta("SELECT usuario.nombres, usuario.apellidos, COUNT(asignacion_servicio.id_usuario) as 'veces solicitadas', usuario.horario FROM `asignacion_servicio`  INNER JOIN usuario on asignacion_servicio.id_usuario = usuario.id",[]); 
        echo json_encode($stmt -> fetchAll(PDO::FETCH_ASSOC));
        }
        else if($query == "ingresos"){
        $fechaInicio = $_GET["fechaInicio"];
        $fechaFin = $_GET["fechaFin"];
        $stmt = $mysql->consulta("SELECT servicio.nombre as Servicio, SUM(servicio.precio) as Total FROM cita INNER JOIN servicio ON id_servicio = servicio.id  WHERE fecha BETWEEN '".$fechaInicio."' and '".$fechaFin."' GROUP BY id_servicio",[]); 
        echo json_encode($stmt -> fetchAll(PDO::FETCH_ASSOC));
        }
        else if($query == "inventario"){
        $stmt = $mysql->consulta("SELECT  producto.nombre,producto.stock, SUM(detalle_sesion.cantidad) as Utilizados FROM detalle_sesion INNER JOIN producto ON detalle_sesion.id_producto = producto.id GROUP by detalle_sesion.id_producto",[]); 
        echo json_encode($stmt -> fetchAll(PDO::FETCH_ASSOC));
        }
        else{
        echo "[]";
        }
        }else{
        echo "[]";   
        }

    }

    }

    else{

        session_destroy();

        echo '{"data":"¿Cómo accediste aquí?, vete.","response":"error"}';

        exit;

        }

    }

    else{

        session_destroy();

        echo '{"data":"No deberías estar aquí, vete e inicia sesión correctamente...","response":"error"}';

        exit;

        }

}

catch(Exception $e){

    echo '{"data":"Algo inesperado ocurrió...","response":"error"}'.$e; 

    exit;



}