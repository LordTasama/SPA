<?php
    include("../../Model/conexion.php");
    // ?  Datos basicos 
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    // ? Datos de Ingresos
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $conexion = new conexion();
    $conexion -> conectar();
    $mensaje_Validado;

    try
    {
        $consulta = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':correo',$email,PDO::PARAM_STR);
        $stmt -> execute();

        if($stmt -> rowCount() > 0)
        {
            $mensaje = array (
                'message' => 'Correo ya existe' 
            );
            $mensaje_Validado = json_encode($mensaje);
            echo $mensaje_Validado;
        }
        else
        {
            $consulta = "INSERT INTO usuarios (nombre, apellido, correo, telefono, password) VALUES (:nombres, :apellidos, :email, :telefono, :password)";
            $stmt = $conexion -> prepare($consulta);
            $stmt->bindParam(':nombres', $nombres, PDO::PARAM_STR);
            $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
            $stmt -> execute();
            $mensaje= array (
                'message' => 'Usuario Agregado' 
            );
            $mensaje_Validado = json_encode($mensaje);
            echo $mensaje_Validado;
        }
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    } finally {
        $conexion->Desconectar();
    }
    
?>