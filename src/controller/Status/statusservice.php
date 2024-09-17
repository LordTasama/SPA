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
        
        if (!isset($_POST['id'])){
            echo '{"data":"Datos no válidos","response":"error"}';
            exit;
        }
        else if(empty($_POST['id'])){
            echo '{"data":"Datos no válidos","response":"error"}';
            exit;
        }
        $id = $_POST['id'];

        $mysql-> conectar();
        $stmt = $mysql -> consulta("SELECT COUNT(id),estado FROM servicio where id = ?",[$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if ($result[0] == 0){
            echo '{"data":"Este servicio no existe en la base de datos","response":"error"}';
            exit;
        }
        $status = $result[1] == 1 ? 0 : 1;
        $statusMessage = $result[1] == 1 ? "Inactivo" : "Activo";

        $mysql -> consulta("UPDATE servicio set estado = ? where id = ?",[$status,$id]);
        echo '{"data":"Estado cambiado exitosamente a '.$statusMessage.'","response":"success"}';
        exit;
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
