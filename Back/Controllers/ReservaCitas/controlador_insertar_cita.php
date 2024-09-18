<?php
include('../../Model/conexion.php');


$conexion = new conexion();
$conexion->conectar();

try {
/*5)	Reporte de ocupación de terapeutas: 
• Muestra la ocupación de cada terapeuta durante un período de tiempo, 
destacando los horarios ocupados y disponibles. 
*/
    // obtenemos datos del post 
    $fecha = $_POST['fecha'];
    $horaInicio = $_POST['hora_Inicio'];
    $hora_fin = $_POST['hora_Fin'];
    $id_cliente = $_POST['id_Cliente'];
    $id_Servicio = $_POST['id_Servicio'];
    $id_Producto = $_POST['id_Producto'];
    // Consulta para verificar si la hora está ocupada
    $consultaVerificacion = "SELECT COUNT(*) FROM citas WHERE fecha = :fecha AND ((:horaInicio < hora_Fin AND :horaFin > hora_Inicio))";
    $stmtVerificacion = $conexion->prepare($consultaVerificacion);
    $stmtVerificacion->bindParam(':fecha', $fecha);
    $stmtVerificacion->bindParam(':horaInicio', $horaInicio);
    $stmtVerificacion->bindParam(':horaFin', $hora_fin);
    $stmtVerificacion->execute();
    $count = $stmtVerificacion->fetchColumn();

    if ($count > 0) {
        // Hora ocupada
        $data = array(
            'access' => false,
            'message' => 'Cita ocupada lamentablemente'
        );
        echo json_encode($data);
    } else {
        // Insertar nueva cita
        $consultaInsertar = "INSERT INTO citas (fecha, hora_Inicio, hora_Fin, id_Cliente, id_Servicio, id_Producto) VALUES (:fecha, :horaInicio, :horaFin, :id_cliente, :id_Servicio, :id_Producto)";
        $stmtInsertar = $conexion->prepare($consultaInsertar);
        $stmtInsertar->bindParam(':fecha', $fecha);
        $stmtInsertar->bindParam(':horaInicio', $horaInicio);
        $stmtInsertar->bindParam(':horaFin', $hora_fin);
        $stmtInsertar->bindParam(':id_cliente', $id_cliente);
        $stmtInsertar->bindParam(':id_Servicio', $id_Servicio);
        $stmtInsertar->bindParam(':id_Producto', $id_Producto);
        $stmtInsertar->execute();
        // ? Actualizo el stock del producto

        $consulta_Cantidad_Consumo_Producto = "SELECT productos.stock as stock, COUNT(id_Producto) as consumidos FROM citas inner join productos on id_Producto = productos.id WHERE id_Producto = '".$id_Producto."' ";
        $stmt = $conexion->ConsultaCompleja($consulta_Cantidad_Consumo_Producto);
        $stock = $stmt[0]['stock'];
        $cantidad = $stmt[0]['consumidos'];
        $nuevo_Stock = $stock - $cantidad;

        // ? Actulizo el Stock
        $actuliazar_Stock = "UPDATE productos SET stock = '".$nuevo_Stock."' WHERE id = '".$id_Producto."' ";
        $stmt_Actualizar = $conexion -> ConsultaCompleja($actuliazar_Stock);
            // Enviar la respuesta como JSON
            $data = array(
                'access' => true,
                'message' => 'Cita reservada exitoasamente'
            );
    echo json_encode($data);
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}
