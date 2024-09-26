<?php

session_start();

date_default_timezone_set("America/Bogota");

$date = date("Y/m/d");

$fecha = new DateTime($date);

$fecha->add(new DateInterval('P1D'));

$fecha = $fecha->format("Y/m/d");

require_once '../../config/mysql.php';

$mysql = new Mysql;

if (
    isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
    isset($_SESSION['login'])
) {
    $id = $_SESSION['id'];
    $mysql->conectar();
    $rol = $_SESSION['rol'];

    $stmt = $mysql->consulta("SELECT id_rol, estado FROM usuario where id = ?", [$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (count($result) == 2) {
        if ($result['estado'] == 1 && ($result['id_rol'] == 1)) {

            $mysql->conectar();


            //Gráficas
            if (isset($_GET["query"])) {
                $query = $_GET["query"];

                if ($query == 1) {
                    $stmt = $mysql->consulta("SELECT servicio.nombre as x, COUNT(id_servicio) as y 
                                              FROM cita 
                                              INNER JOIN servicio ON id_servicio = servicio.id 
                                              WHERE servicio.estado = 1 
                                              GROUP BY id_servicio 
                                              ORDER BY y DESC", []);
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                
                } else if ($query == 2) {
                    $stmt = $mysql->consulta("SELECT servicio.nombre as x, SUM(servicio.precio) as y 
                                              FROM cita 
                                              INNER JOIN servicio ON id_servicio = servicio.id 
                                              WHERE servicio.estado = 1 
                                              GROUP BY id_servicio 
                                              ORDER BY y DESC", []);
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                
                } else if ($query == "clientes") {
                    $stmt = $mysql->consulta("SELECT id_cliente, nombres, apellidos, servicio.nombre, COUNT(servicio.nombre) as 'Frecuencia del servicio'  
                                              FROM cita 
                                              INNER JOIN cliente ON cita.id_cliente = cliente.id 
                                              INNER JOIN servicio ON cita.id_servicio = servicio.id 
                                              WHERE cita.estado = 1 
                                              GROUP BY servicio.nombre", []);
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                
                } else if ($query == "ocupacion") {
                    $stmt = $mysql->consulta("SELECT usuario.nombres, usuario.apellidos, COUNT(asignacion_servicio.id_usuario) as 'veces solicitadas', usuario.horario 
                                              FROM asignacion_servicio  
                                              INNER JOIN usuario on asignacion_servicio.id_usuario = usuario.id 
                                              WHERE asignacion_servicio.estado = 1", []);
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                
                } else if ($query == "ingresos") {
                    $fechaInicio = $_GET["fechaInicio"];
                    $fechaFin = $_GET["fechaFin"];
                    $stmt = $mysql->consulta("SELECT servicio.nombre as Servicio, SUM(servicio.precio) as Total 
                                              FROM cita 
                                              INNER JOIN servicio ON id_servicio = servicio.id  
                                              WHERE estado = 1 AND fecha BETWEEN '" . $fechaInicio . "' and '" . $fechaFin . "' 
                                              GROUP BY id_servicio", []);
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                
                } else if ($query == "inventario") {
                    $stmt = $mysql->consulta("SELECT 
    COALESCE(producto.id, servicio.id) AS id,
    COALESCE(producto.nombre, servicio.nombre) AS Nombre,
    COALESCE(producto.stock, 0) AS stock, 
    SUM(detalle_factura.cantidad) AS Utilizados
FROM detalle_factura
LEFT JOIN producto ON detalle_factura.id_producto = producto.id
LEFT JOIN servicio ON detalle_factura.id_servicio = servicio.id
GROUP BY id, Nombre, stock;
;
", []);
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                
                } else {
                    echo "[]";
                }}
                
        } else {
          
            header("Location: ./login.php");
            exit;
        }
    } else {
        session_destroy();
        header("Location: ./login.php");
        exit;
    }
} else {
    header("Location:./login.php");
    exit;
}
