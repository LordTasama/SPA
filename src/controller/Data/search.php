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
        // Buscar el nombre del cliente por identificación (ID)
        if (isset($_POST['id'])) {
            $identificacion = $_POST['id'];
            $stmt = $mysql->consulta("SELECT nombres FROM cliente  where id LIKE ?",["%$id%"], [$identificacion]);
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if ($stmt->rowCount() == 1) {
                echo $result[0]; // Retornar el nombre del cliente
            } else {
                echo "No encontrado"; // Identificación no encontrada
            }
            exit;
           
        } else {
            echo '{"data":"ID no proporcionado","response":"error"}';
            exit;
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
} catch (Exception $e) {
    session_destroy();
    session_start();
    echo '{"data":"Algo inesperado ocurrió... Contacta con un administrador","response":"error"}';
    exit;
}