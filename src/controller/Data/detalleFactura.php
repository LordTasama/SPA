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
    $rol = $_SESSION['rol'];

    // Verifica si el usuario tiene un rol válido
    $stmt = $mysql->consulta("SELECT id_rol, estado FROM usuario WHERE id = ?", [$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['estado'] == 1 && ($result['id_rol'] == 1 || $result['id_rol'] == 2)) {
        
        $list = "LIMIT 60";
        if (isset($_GET["all"])) {
            $list = "";
        }

        // Consulta para obtener facturas
        $stmt = $mysql->consulta("SELECT * FROM factura " . $list, []);

        if (isset($_GET["id"])) {
            $facturaId = $_GET["id"];
            $stmt = $mysql->consulta("SELECT df.cantidad, df.precio_unitario, df.subtotal, 
                COALESCE(p.nombre, s.nombre) AS nombre
                FROM detalle_factura df
                LEFT JOIN producto p ON df.id_producto = p.id
                LEFT JOIN servicio s ON df.id_servicio = s.id
                WHERE df.id_factura = ?", [$facturaId]);
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        session_destroy();
        echo '{"data":"¿Cómo accediste aquí?, vete.","response":"error"}';
        exit;
    }
} else {
    session_destroy();
    echo '{"data":"No deberías estar aquí, vete e inicia sesión correctamente...","response":"error"}';
    exit;
}
