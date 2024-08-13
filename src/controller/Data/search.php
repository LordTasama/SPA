<?php
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;

try {
    // Verificar si la sesión está iniciada y válida
    if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) && isset($_SESSION['login'])) {
        $id = $_SESSION['id'];
        $mysql->conectar();
        $stmt = $mysql->consulta("SELECT estado FROM usuario WHERE id = ?", [$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        // Verificar el estado del usuario
        if ($stmt->rowCount() == 1) {
            if ($result[0] != 1) {
                echo '{"data":"Su estado actual es inactivo","response":"error"}';
                exit;
            }
        }

        // Buscar el nombre del cliente por identificación (ID)
        if (isset($_POST['id'])) {
            $identificacion = $_POST['id'];
            $stmt = $mysql->consulta("SELECT nombres FROM cliente WHERE id = ?", [$identificacion]);
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
    } else {
        echo '{"data":"No hay una sesión iniciada","response":"error"}';
        exit;
    }
} catch (Exception $e) {
    session_destroy();
    session_start();
    echo '{"data":"Algo inesperado ocurrió... Contacta con un administrador","response":"error"}';
    exit;
}
?>
