<?php
class Mysql {
private $username = "root";
private $password  = "";
private $dsn = "mysql:host=localhost;dbname=spa;charset=utf8";

private $pdo;
private $queryResult;

public function conectar(){
       try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Algo inesperado ocurrió con la base de datos...';
            if(isset($_SESSION["rol"])){
            header("Location: ./");
            }
            else{
            header("Location: ../../");
            }
            
            $_SESSION["database_error"] = 1;
        }
}

public function consulta($sql, $params = []){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
}

}