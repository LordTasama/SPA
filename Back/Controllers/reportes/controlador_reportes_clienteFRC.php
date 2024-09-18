<?php
include('../../Model/conexion.php');

$conexion = new Conexion();

try {
    $consulta = "SELECT clientes.id AS ClienteID, CONCAT(clientes.nombre, ' ', clientes.apellido) AS Cliente, COUNT(citas.id) AS Cantidad_Visitas, GROUP_CONCAT( servicios.descripcion_Servicio ORDER BY ServicioCount DESC SEPARATOR '; ' ) AS Tratamientos_Mas_Solicitados FROM clientes JOIN citas ON clientes.id = citas.id_Cliente JOIN ( SELECT servicios.id, servicios.descripcion_Servicio, COUNT(citas.id) AS ServicioCount FROM servicios JOIN citas ON servicios.id = citas.id_Servicio GROUP BY servicios.id, servicios.descripcion_Servicio ) servicios ON citas.id_Servicio = servicios.id GROUP BY clientes.id ORDER BY Cantidad_Visitas DESC;";
    $clientes = $conexion->ConsultaCompleja($consulta);
    echo json_encode($clientes);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
