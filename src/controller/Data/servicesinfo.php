<?php
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;
try{
    if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
        isset($_SESSION['login'])){
        $id = $_SESSION['id'];
        $mysql->conectar();
        $rol = $_SESSION['rol'] ?? '';
       
        if ($rol == '') {
        session_destroy();
        echo '{"data":"Rol no está definido","response":"error"}';
        exit;
        }
        $table = $rol == 1 ? 'usuario' : 'terapeuta';
        $stmt = $mysql->consulta("SELECT estado FROM $table where id = ?",[$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if (count($result) == 1){
        if($result[0] != 1){
        session_destroy();
        echo '{"data":"Su estado es inactivo","response":"error"}';
        exit;
        }
    else{
        $mysql->conectar();
        $list = "LIMIT 60";
        if(isset($_GET["all"])){
        $list = "";
        }
        $stmt = $mysql->consulta("SELECT * FROM servicio ".$list,[]);
        if(isset($_GET["id"])){
         $id = $_GET["id"];
         $stmt = $mysql->consulta("SELECT * FROM servicio where id LIKE ?",["%$id%"]);
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
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
    echo '{"data":"Algo inesperado ocurrió...","response":"error"}'; 
    exit;
}