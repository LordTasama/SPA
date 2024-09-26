<?php
class Mysql {
private $username = "root";
private $password  = "12345";
private $dsn = "mysql:host=db;dbname=spa;charset=utf8";

private $pdo;
private $queryResult;

public function conectar(){
       try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET sql_mode = ''"); // Add this line
   
        } catch (PDOException $e) {
            $_SESSION["database_error"] = 1;
            session_destroy();
            echo '{"data":"Algo inesperado ocurrió con la base de datos... no se pudo conectar","response":"error"},"add":"<script>window.location.href = "./login.php";</script>"';
            exit;
        }
        
}
public function lastInsertId() {
    return $this->pdo->lastInsertId();
}
public function consulta($sql, $params = []){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
}

}