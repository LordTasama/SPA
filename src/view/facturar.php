<?php
session_start();
require_once '../config/mysql.php';
$mysql = new Mysql;
try {
    if (
        isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
        isset($_SESSION['login'])
    ) {
        $id = $_SESSION['id'];
        $mysql->conectar();
        $stmt = $mysql->consulta("SELECT estado FROM usuario where id = ?", [$id]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        if (count($result) == 1) {
            if ($result[0] != 1) {
                session_destroy();
               header("Location: ./login.php");
               exit;
            }
        }
    } else {
        session_destroy();
      header("Location: ./login.php");
     exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPA / Facturación</title>

    <!-- Custom fonts for this template-->
    <link href="../fontawesome-free-6.5.2-web/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->




</head>

<body>
    
</body>

</html>
<?php
} catch (Exception $e) {
   header("Location: ./login.php");
   exit;
}