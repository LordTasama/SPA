<?php
class Conexion {
    private $host = "localhost";
    private $dbname = "bd_spa";
    private $usuario = "root";
    private $contrasena = "";
    public $conexion;

    public function conectar() {
        try {
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function Desconectar()
    {
        try {
            // Verificar si la conexión está establecida
            if ($this->conexion) {
                // Cerrar la conexión
                $this->conexion = null;
            }
        } catch (PDOException $e) {
            echo "Error al desconectar la base de datos: " . $e->getMessage();
        }
    }

    public function prepare($sql) {
        return $this->conexion->prepare($sql);
    }

    
    public function ConsultaSimple($consulta)
    {
        try {
            // Establecer la conexión
            $this->Conectar();
    
            // Preparar la consulta
            $stmt = $this->conexion->prepare($consulta);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Cerrar la conexión
            $this->Desconectar();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    

    public function ConsultaCompleja($consulta)
    {
        try {
            // Establecer la conexión
            $this->Conectar();
    
            // Preparar y ejecutar la consulta
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
    
            // Obtener los resultados
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Cerrar la conexión
            $this->Desconectar();
    
            return $resultado;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
