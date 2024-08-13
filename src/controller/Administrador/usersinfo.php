<?php
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;
try{
if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
    isset($_SESSION['login'])){
    $id = $_SESSION['id'];
    $mysql->conectar();
    $stmt = $mysql->consulta("SELECT estado,id_rol FROM usuario where id = ?",[$id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    
    if (count($result) == 2){
    if($result[0] != 1){
    session_destroy();
    echo '{"data":"Su estado es inactivo","response":"error"}';
    exit;
    }
    if($result[1] != 1){
    echo "[]";
    exit;
    }
    else{
        $mysql->conectar();
        $list = "LIMIT 60";
        $rol = 0;
        if(isset($_GET["all"])){
        $list = "";
        }
        if(isset($_GET["rol"])){
        $rol = $_GET["rol"];
        }
          switch($rol){
            case 2:
            case 3:
            $stmt = $mysql->consulta("SELECT * FROM usuario where id_rol = ? ".$list,[$rol]);
            break;
            default: $stmt = $mysql->consulta("SELECT * FROM usuario ".$list,[]);
            break;
        };
        if(isset($_GET["id"])){
         $id = $_GET["id"];
         $stmt = $mysql->consulta("SELECT * FROM usuario where id = ?",[$id]);
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