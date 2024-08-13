<?php
session_start();
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
        if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['type']) || !isset($_POST['time']) || !isset($_POST['value'])){
            echo '{"data":"Datos no válidos","response":"error"}';
            exit;
        }
        else if(empty($_POST['id']) || empty($_POST['name']) || empty($_POST['type']) || empty($_POST['time']) || empty($_POST['value'])){
            echo '{"data":"Datos no válidos","response":"error"}';
            exit;
        }
        $id = preg_replace('/\s+/','',$_POST['id']);
        $name = mb_strtoupper(trim($_POST['name']), 'UTF-8');
        $type = mb_strtoupper(trim($_POST['type']), 'UTF-8');
        $time = mb_strtoupper($_POST['time'], 'UTF-8');
        $value = preg_replace('/\s+/','',$_POST['value']);

         if (!is_numeric($value) && $value < 0){
          echo '{"data":"Datos no válidos","response":"error"}';
            exit;  
        }

        $mysql-> conectar();
        $stmt = $mysql -> consulta("SELECT COUNT(id) FROM servicio where id = ?",[$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if ($result[0] == 0){
            echo '{"data":"Este servicio no existe en la base de datos","response":"error"}';
            exit;
        }
        
        $stmt = $mysql -> consulta("SELECT COUNT(id) FROM servicio where nombre = ? and id <> ?",[$name,$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if ($result[0] == 1){
            echo '{"data":"Este servicio con este nombre ya existe en la base de datos","response":"error"}';
            exit;
        }
  
        $mysql -> consulta("UPDATE servicio set nombre = ?,tipo = ?,duracion = ?,precio = ? where id = ?",[$name,$type,$time,$value,$id]);
        echo '{"data":"Servicio editado con éxito","response":"success"}';
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
}
catch(Exception $e){
    echo '{"data":"Algo inesperado ocurrió...","response":"error"}'; 
    exit;
}