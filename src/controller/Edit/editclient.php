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
        if ($result['estado'] == 1 && ($result['id_rol'] == 1)) {
        
        if (!isset($_POST['id']) || !isset($_POST['names']) || !isset($_POST['lastname']) || !isset($_POST['address']) || !isset($_POST['phone']) || !isset($_POST['email'])){
            echo '{"data":"Datos no válidos","response":"error"}';
            exit;
        }
        else if(empty($_POST['id']) || empty($_POST['names']) || empty($_POST['lastname']) || empty($_POST['address']) ||  empty($_POST['phone']) || empty($_POST['email'])){
            echo '{"data":"Datos no válidos","response":"error"}';
            exit;
        }
        $id = preg_replace('/\s+/','',$_POST['id']);
        $names = mb_strtoupper(trim($_POST['names']), 'UTF-8');
        $lastname = mb_strtoupper(trim($_POST['lastname']), 'UTF-8');
        $address = strtoupper(trim($_POST['address']));
        $phone = preg_replace('/\s+/','',$_POST['phone']);
        $email = strtolower(preg_replace('/\s+/','',$_POST['email']));
        

        $mysql-> conectar();
        $stmt = $mysql -> consulta("SELECT COUNT(id) FROM cliente where id = ?",[$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if ($result[0] == 0){
            echo '{"data":"Este cliente no existe en la base de datos","response":"error"}';
            exit;
        }
        
        $stmt = $mysql -> consulta("SELECT COUNT(correo) FROM cliente where correo = ? and id <> ?",[$email,$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if ($result[0] == 1){
            echo '{"data":"El correo ya existe","response":"error"}';
            exit;
        }       
        $mysql -> consulta("UPDATE cliente set nombres = ?,apellidos = ?,direccion = ?,telefono = ?,correo = ? where id = ?",[$names,$lastname,$address,$phone,$email,$id]);
        echo '{"data":"Cliente editado con éxito","response":"success"}';
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
