<?php
    include('../../Model/conexion.php');
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $valor = $_POST['valor'];
    $estado = $_POST['estado'];

    $conexion = new Conexion();
    $conexion -> conectar();
    $enviar_Mensaje;
    try {
        $consulta = "UPDATE productos SET descripcion = :descripcion , stock  = :stock , valor_Producto  = :valor , estado = :estado WHERE id = :id  ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();

        if ($stmt -> rowCount() > 0)
        {
            $mensaje = array(
                "message" => "Producto editado"
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