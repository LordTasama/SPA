<?php
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;

try {
    if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
        isset($_SESSION['login'])) {
        $id = $_SESSION['id'];
        $mysql->conectar();
        $rol = $_SESSION['rol'] ?? '';

        if ($rol == '') {
            session_destroy();
            echo '{"data":"Rol no está definido","response":"error"}';
            exit;
        }

        $table = $rol == 1 ? 'usuario' : 'terapeuta';
        $stmt = $mysql->consulta("SELECT estado FROM $table where id = ?", [$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        if (count($result) == 1) {
            if ($result[0] != 1) {
                session_destroy();
                echo '{"data":"Su estado es inactivo","response":"error"}';
                exit;
            } else {
                $json = json_decode(file_get_contents('php://input'), true);

                if (!isset($json['fecha']) || !isset($json['total']) || !isset($json['metodo_pago']) || !isset($json['id_cliente']) || !isset($json['detalle'])) {
                    echo '{"data":"Datos no válidos","response":"error"}';
                    exit;
                }

                $fecha = $json['fecha'];
                $total = $json['total'];
                $metodo_pago = $json['metodo_pago'];
                $id_cliente = $json['id_cliente'];
                $detalle = $json['detalle'];

                // Validate detalle array
                foreach ($detalle as $item) {
                    if (!isset($item['id_producto']) && !isset($item['id_servicio'])) {
                        echo '{"data":"Datos no válidos","response":"error"}';
                        exit;
                    }
                    if (!isset($item['cantidad']) || !isset($item['precio_unitario'])) {
                        echo '{"data":"Datos no válidos","response":"error"}';
                        exit;
                    }
                }

                // Insert factura
                $mysql->consulta("INSERT INTO factura (fecha, total, metodo_pago, id_cliente) VALUES (?, ?, ?, ?)", [$fecha, $total, $metodo_pago, $id_cliente]);
             
                $id_factura = $mysql->lastInsertId();

                // Insert detalle
                foreach ($detalle as $item) {
                    if (isset($item['id_producto'])) {
                        $mysql->consulta("INSERT INTO detalle_factura (id_factura, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)", [$id_factura, $item['id_producto'], $item['cantidad'], $item['precio_unitario']]);
                    } elseif (isset($item['id_servicio'])) {
                        $mysql->consulta("INSERT INTO detalle_factura (id_factura, id_servicio, cantidad, precio_unitario) VALUES (?, ?, ?, ?)", [$id_factura, $item['id_servicio'], $item['cantidad'], $item['precio_unitario']]);
                    }
                }

                echo '{"data":"Factura creada con éxito","response":"success"}';
                exit;
            }
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
} catch (Exception $e) {
    echo '{"data":"' . $e->getMessage() . '","response":"error"}';
    exit;
}