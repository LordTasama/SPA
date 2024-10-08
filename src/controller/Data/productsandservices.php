<?php
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;

if (
    isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
    isset($_SESSION['login'])
) {
    $id = $_SESSION['id'];
    $mysql->conectar();
    $rol = $_SESSION['rol'] ;

    $stmt = $mysql->consulta("SELECT id_rol, estado FROM usuario where id = ?", [$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (count($result) == 2) {
        if ($result['estado'] == 1 && ($result['id_rol'] == 1 || $result['id_rol'] == 2)) {
        
        $mysql->conectar();
        $list = "LIMIT 60";
        if(isset($_GET["all"])){
        $list = "";
        }
        $stmt = $mysql->consulta("SELECT * FROM servicio ".$list,[]);
        if(isset($_GET["id"])){
         $id = $_GET["id"];
         $stmt = $mysql->consulta("SELECT * FROM servicio where id = ?",[$id]);
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
