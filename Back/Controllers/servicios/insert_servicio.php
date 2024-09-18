<?php
    include('../../Model/conexion.php');

    $descripcion = $_POST['descripcion_Servicio'];
    $valor = $_POST['valor_Servicio'];
    $duracion = $_POST['duracion'];
    $id = $_POST['id_Terapeuta'];
    $conexion  = new Conexion();

    $conexion -> conectar();
    $enviar_Mensaje ;
    try{
        $consulta = "INSERT INTO servicios (descripcion_Servicio, duracion, valor_Servicio, id_Terapeuta) VALUES( :descripcion , :duracion , :valor , :id )";
        $stmt = $conexion -> prepare($consulta); 
        $stmt -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt -> bindParam(':duracion', $duracion, PDO::PARAM_STR);
        $stmt -> bindParam(':valor', $valor , PDO::PARAM_STR);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        if ($stmt -> rowCount() > 0)
        {
            $mensaje = array(
                "message" => "Servicio Agregado"
            );
            $enviar_Mensaje = json_encode($mensaje);
            print $enviar_Mensaje;
        }
        else
        {
            $mensaje = array(
                "message" => "Error en la consulta"
            );
            $enviar_Mensaje = json_encode($mensaje);
            print $enviar_Mensaje;
        }
    }catch(PDOException $e)
    {
        echo 'error: ' . $e->getMessage();
    }finally{
        $conexion -> Desconectar();
    }


?>