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

        <link href="../fontawesome-free-6.5.2-web/css/all.min.css" rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/controlpanel.css">
        <link rel="stylesheet" href="../../node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="../../node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="../../node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css">



    </head>

    <body>






        <div class="container card shadow m-5">
 
        </div>




    

    </body>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables-->
    <script src="../../node_modules/datatables.net/js/dataTables.min.js"></script>
    <script src="../../node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../node_modules/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../node_modules/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="../../node_modules/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../node_modules/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../node_modules/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../node_modules/pdfmake/build/pdfmake.min.js"></script>
    <script src="../../node_modules/pdfmake/build/vfs_fonts.js"></script>
    <script src="../../node_modules/jszip/dist/jszip.min.js"></script>
    <script src="../../node_modules/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="../../node_modules/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <script src="../assets/js/notify.min.js"></script>
    <script src="../sb-admin/js/sb-admin-2.min.js"></script>
    <script src="../assets/js/controlpanel/pages.js"></script>
    <script src="../assets/js/datatable/datatablesconfig.js"></script>
    <script src="../assets/js/datatable/globalvars.js"></script>

    <script src="../assets/js/apexcharts/apexcharts.js"></script>




   

    </html>
<?php
} catch (Exception $e) {
    header("Location: ./login.php");
    exit;
}
