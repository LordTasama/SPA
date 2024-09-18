<?php
    include('../../Model/conexion.php');

    $id = $_POST['id'];
    $descripcion = $_POST['descripcion_Servicio'];
    $valor = $_POST['valor_Servicio'];
    $duracion = $_POST['duracion'];
    $id_Terapeuta = $_POST['id_Terapeuta'];

    $conexion = new Conexion();
    $conexion -> conectar();
    $enviar_Mensaje;
    try {
        $consulta = "UPDATE servicios SET descripcion_Servicio = :descripcion , valor_Servicio  = :valor , duracion  = :duracion , id_Terapeuta = :id_Terapeuta WHERE id = :id  ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindParam(':duracion', $duracion, PDO::PARAM_STR);
        $stmt->bindParam(':id_Terapeuta', $id_Terapeuta, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();

        if ($stmt -> rowCount() > 0)
        {
            $mensaje = array(
                "message" => "Servicio editado"
            );
            $enviar_Mensaje = json_encode($mensaje);
            print $enviar_Mensaje;
        }
        else{
            $mensaje = array(
                "message" => "Error en la consulta"
            );
            $enviar_Mensaje = json_encode($mensaje);
            print $enviar_Mensaje;
        }
    }
    catch (PDOException $e){ 
        echo 'error: ' . $e->getMessage();
    }
    finally {
        $conexion -> Desconectar();
    }

?>