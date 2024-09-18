<?php
    include('../../Model/conexion.php');

    $id = $_POST['id'];
    $conexion = new Conexion();
    $conexion -> conectar();
    $enviar_Mensaje;
    try {

        $consulta = "DELETE FROM productos WHERE id = :id";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();

        if ($stmt -> rowCount() > 0)
        {
            $mensaje = array (

                "message" => "Producto Eliminado"
 
            );
            $enviar_Mensaje =  json_encode($mensaje);
            print $enviar_Mensaje;
        } 
        else {
            $mensaje = array (

                "message" => "Error en la Consulta"
 
            );
            $enviar_Mensaje =  json_encode($mensaje);
            print $enviar_Mensaje;
        }
    }
    catch (PDOException $e) {
        echo 'error: ' . $e->getMessage();
    }
    finally {
        $conexion -> Desconectar();
    }



?>