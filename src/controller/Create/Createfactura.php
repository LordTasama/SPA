<?php
session_start();
require_once '../../config/mysql.php';

class FacturaController
{
    private $mysql;

    public function __construct($mysql)
    {
        $this->mysql = $mysql;
    }

    public function createFacturaWithDetails($fecha, $total, $metodo_pago, $id_cliente, $detalles)
    {
        try {
            $this->mysql->conectar();
            $this->mysql->beginTransaction();

            $stmt = $this->mysql->consulta("INSERT INTO factura (fecha, total, metodo_pago, id_cliente) VALUES (?, ?, ?, ?)", [$fecha, $total, $metodo_pago, $id_cliente]);

            if ($stmt) {
                $idFactura = $this->mysql->lastInsertId();

                foreach ($detalles as $detalle) {
                    $id_producto = $detalle['id_producto'] ?? null;
                    $id_servicio = $detalle['id_servicio'] ?? null;
                    $cantidad = $detalle['cantidad'];
                    $precio_unitario = $detalle['precio_unitario'];
                    $subtotal = $cantidad * $precio_unitario; 

                    $this->mysql->consulta("INSERT INTO detalle_factura (id_factura, id_producto, id_servicio, cantidad, precio_unitario, subtotal) 
                                            VALUES (?, ?, ?, ?, ?, ?)", [$idFactura, $id_producto, $id_servicio, $cantidad, $precio_unitario, $subtotal]);
                }

                $this->mysql->commit();
                return $idFactura;
            }

            $this->mysql->rollback();
            return false;
        } catch (Exception $e) {
            $this->mysql->rollback();
            throw $e;
        }
    }

    public function getFacturaWithDetails($id)
    {
        $this->mysql->conectar();
        
        // Obtener la factura
        $stmt = $this->mysql->consulta("SELECT * FROM factura WHERE id = ?", [$id]);
        $factura = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($factura) {
            // Obtener los detalles de la factura
            $stmt = $this->mysql->consulta("SELECT * FROM detalle_factura WHERE id_factura = ?", [$id]);
            $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $factura['detalles'] = $detalles;
            return $factura;
        }

        return null;
    }
}

try {
    if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) && isset($_SESSION['login'])) {
        $id = $_SESSION['id'];
        $mysql = new Mysql;
        $mysql->conectar();
        $stmt = $mysql->consulta("SELECT estado, id_rol FROM usuario WHERE id = ?", [$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        if (count($result) == 2) {
            if ($result[0] != 1) {
                session_destroy();
                echo '{"data":"Su estado es inactivo","response":"error"}';
                exit;
            }
            if ($result[1] != 1) {
                echo '{"data":"Debes ser administrador para realizar esta acción","response":"error"}';
                exit;
            } else {
                // Instancia del controlador de factura
                $facturaController = new FacturaController($mysql);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Ejemplo de creación de factura con detalles
                    $fecha = $_POST['fecha'];
                    $total = $_POST['total'];
                    $metodo_pago = $_POST['metodo_pago'];
                    $id_cliente = $_POST['id_cliente'];

                    // Obtener los detalles de la factura desde la tabla
                    $detalles = array();
                    foreach ($_POST['detalle'] as $row) {
                        $detalle = array(
                            'id_producto' => $row['id_producto'],
                            'id_servicio' => $row['id_servicio'],
                            'cantidad' => $row['cantidad'],
                            'precio_unitario' => $row['precio_unitario']
                        );
                        $detalles[] = $detalle;
                    }

                    $nuevoIdFactura = $facturaController->createFacturaWithDetails($fecha, $total, $metodo_pago, $id_cliente, $detalles);
                    if ($nuevoIdFactura) {
                        echo '{"data":"Factura creada con éxito, ID: ' . $nuevoIdFactura . '","response":"success"}';
                    } else {
                        echo '{"data":"Error al crear la factura.","response":"error"}';
                    }
                }
                // Aquí podrías agregar manejo para otros métodos como GET, PUT, DELETE si lo necesitas.
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
    echo '{"data":"Algo inesperado ocurrió...","response":"error"}';
    exit;
}
