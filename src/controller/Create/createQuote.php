<?php
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;

try {
    if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) && isset($_SESSION['login'])) {
        $id = $_SESSION['id'];
        $mysql->conectar();
        $stmt = $mysql->consulta("SELECT estado FROM usuario WHERE id = ?", [$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        if ($result && count($result) == 1) {
            if ($result[0] != 1) {
                session_destroy();
                echo json_encode(["data" => "Su estado es inactivo", "response" => "error"]);
                exit;
            } else {
                if (!isset($_POST['fecha'], $_POST['id'], $_POST['servicio']) || empty($_POST['fecha']) || empty($_POST['name']) || empty($_POST['servicio'])) {
                    echo json_encode(["data" => "Datos no válidos", "response" => "error"]);
                    exit;
                }

                $fecha = preg_replace('/\s+/', '', $_POST['fecha']);
                $name = mb_strtoupper(trim($_POST['id']), 'UTF-8');
                $servicio = mb_strtoupper(trim($_POST['servicio']), 'UTF-8');

                $stmt = $mysql->consulta("SELECT COUNT(id) FROM cita WHERE fecha = ?", [$fecha]);
                $result = $stmt->fetch(PDO::FETCH_NUM);

                if ($result[0] > 0) {
                    echo json_encode(["data" => "Una cita con esta fecha ya existe en la base de datos", "response" => "error"]);
                    exit;
                }

                $stmt = $mysql->consulta("INSERT INTO cita (fecha, id_cliente, id_servicio) VALUES (?, ?, ?)", [$fecha, $name, $servicio]);
                echo json_encode(["data" => "Cita creada con éxito", "response" => "success"]);
                exit;
            }
        } else {
            session_destroy();
            echo json_encode(["data" => "¿Cómo accediste aquí?, regresa", "response" => "error"]);
            exit;
        }
    } else {
        session_destroy();
        echo json_encode(["data" => "No deberías estar aquí, vete e inicia sesión correctamente...", "response" => "error"]);
        exit;
    }
} catch (Exception $e) {
    echo json_encode(["data" => "Algo inesperado ocurrió...", "response" => "error"]);
    exit;
}
?>
