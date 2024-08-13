<?php
session_start();
require_once '../config/mysql.php';
$mysql = new Mysql;
try{
if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
    isset($_SESSION['login'])){
    $id = $_SESSION['id'];
    $mysql->conectar();
    $stmt = $mysql->consulta("SELECT estado FROM usuario where id = ?",[$id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    
    if (count($result) == 1){
    if($result[0] != 1){
    session_destroy();
    header("Location: ./login.php");
    exit;
    }
    else{
    header("Location: ./controlpanel.php");
    exit;    
    }
    }
    }

    ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../sb-admin/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../sb-admin/css/owl.carousel.min.css">



    <!-- Style -->
    <link rel="stylesheet" href="../assets/css/login.css">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>SPA / LOGIN</title>
</head>

<body>


    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('../assets/pictures/imagenLogin.jpg');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Ingresar</h3>
                        <p class="mb-4">¡Relájate y déjate consentir por nuestras exclusivas terapias y tratamientos
                            diseñados para tu bienestar. ¡Estamos encantados de tenerte con nosotros!.</p>
                        <form>
                            <!-- MENSAJE DE ALERTA -->
                            <div id="alertMessage" class="alertContainer">

                            </div>

                            <!--- FIN MENSAJE ALERTA --->
                            <div class="form-floating mb-3">
                                <select id="rol" class="form-select">
                                    <option value="1">Usuario</option>
                                    <option value="2">Terapeuta</option>
                                </select>
                                <label for="user">Selecciona tu rol</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="user" class="form-control" id="user" placeholder="">
                                <label for="user">Correo electrónico o identificación</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="">
                                <label for="password">Contraseña</label>
                            </div>

                            <div class="d-flex mb-5 align-items-center">

                                <button type="button" id="btnLogin" class="btn btn-block bg-sidebar">Ingresar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../sb-admin/js/popper.min.js"></script>
    <script src="../assets/js/login.js"></script>
</body>

</html>
<?php
}
catch(Exception $e){
    header("Location: ./login.php");
    exit;
}