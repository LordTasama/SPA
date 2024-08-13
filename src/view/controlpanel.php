<?php
session_start();
require_once '../config/mysql.php';
$mysql = new Mysql;
try{

if (isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
    isset($_SESSION['login'])){
    $id = $_SESSION['id'];
    $mysql->conectar();
    $rol = $_SESSION['rol'] ?? '';
    switch ($rol) {
        case '':
            break;
        default:
    $table = $rol == 1 ?'usuario':'terapeuta';
    $stmt = $mysql->consulta("SELECT estado FROM $table where id = ?",[$id]);
    $result = $stmt->fetch(PDO::FETCH_NUM);
    
    if (count($result) == 1){
    if($result[0] != 1){
    session_destroy();
    header("Location: ./login.php");
    exit;
    }
    }
    }
    }
     else{
    header("Location: ./controlpanel.php");
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

    <title>SPA / Control Panel</title>

    <!-- Custom fonts for this template-->
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SPA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-network-wired"></i>
                    <span>Panel de control</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if ($rol == 1) {?>
            <!-- Heading -->
            <div class="sidebar-heading">
                Base de datos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed cursor-link-a" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tablas</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionSidebar"
                    style="">
                    <div class="bg-white py-2 collapse-inner rounded navitem-container">
                        <h6 class="collapse-header">Tablas</h6>
                        <div class="collapse-item d-flex align-items-center p-0 justify-content-between">
                            <i class="fa-solid fa-caret-right fa-sm ms-1"></i>
                            <a class="collapse-item cursor-link-a" onclick="pageChange(0)">Usuarios</a>
                            <i class="fa-solid fa-user-tie fa-sm me-1"></i>
                        </div>
                        <div class="collapse-item d-flex align-items-center p-0 justify-content-between">
                            <i class="fa-solid fa-caret-right fa-sm ms-1"></i>
                            <a class="collapse-item cursor-link-a" onclick="pageChange(1)">Terapeutas</a>
                            <i class="fa-solid fa-user-nurse fa-sm me-1"></i>
                        </div>

                        <div class="collapse-item d-flex align-items-center p-0 justify-content-between">
                            <i class="fa-solid fa-caret-right fa-sm ms-1"></i>
                            <a class="collapse-item cursor-link-a" onclick="pageChange(2)">Clientes</a>
                            <i class="fa-solid fa-user fa-sm me-1"></i>
                        </div>

                        <div class="collapse-item d-flex align-items-center p-0 justify-content-between">
                            <i class="fa-solid fa-caret-right fa-sm ms-1"></i>
                            <a class="collapse-item cursor-link-a" onclick="pageChange(3)">Servicios</a>
                            <i class="fa-solid fa-bell-concierge fa-sm me-1"></i>
                        </div>
                        <div class="collapse-item d-flex align-items-center p-0 justify-content-between">
                            <i class="fa-solid fa-caret-right fa-sm ms-1"></i>
                            <a class="collapse-item cursor-link-a" onclick="pageChange(4)">Productos</a>
                            <i class="fa-solid fa-tags fa-sm me-1"></i>
                        </div>
                        <div class="collapse-item d-flex align-items-center p-0 justify-content-between">
                            <i class="fa-solid fa-caret-right fa-sm ms-1"></i>
                            <a class="collapse-item cursor-link-a" onclick="pageChange(5)">Citas</a>
                            <i class="fa-regular fa-calendar-days fa-sm me-1"></i>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reportes
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a id="recargar" class="nav-link cursor-link-a" onclick="pageChange(6)">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficas</span></a>
            </li>


            <li class="nav-item">
                <a id="recargar" class="nav-link cursor-link-a" onclick="pageChange(7)">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Informes</span></a>
            </li>
            <?php }?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Facturación
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed cursor-link-a" href="./facturar.php" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>Facturar</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="spa-color fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto mr-2">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle cursor-link-a" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span
                                    class="me-2 d-none d-lg-inline text-secondary small"><?php echo isset($_SESSION["nombres"]) && isset($_SESSION["apellidos"]) ? $_SESSION["nombres"] . " " . $_SESSION["apellidos"] : "Akira Toriyama"; ?></span>
                                <img class="img-profile rounded-circle" src="../sb-admin/img/undraw_profile.svg"
                                    alt="Profile Picture">
                            </a>
                            <!-- Dropdown - User Information -->
                            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item cursor-link-a">
                                        <i class="fa-solid fa-chalkboard-user me-2 text-gray-400"></i>
                                        <?php echo isset($_SESSION["nombres"]) && isset($_SESSION["apellidos"]) ? $_SESSION["nombres"] . " " . $_SESSION["apellidos"] : "Akira Toriyama"; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item cursor-link-a">
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item cursor-link-a" data-bs-toggle="modal"
                                        data-bs-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                        Salir
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="pages">
                        <div class="page page-0 page-hide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-12 text-center" style="margin-top:2% !important">
                                                <h5 class="card-title">Usuarios</h5>
                                            </div>
                                            <div class="col-lg-4 col-12" style="margin-top:2% !important">

                                                <div class="input-group flex-nowrap">
                                                    <input type="number" class="form-control"
                                                        placeholder="Buscar por identificación" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        data-bs-title="Buscar por identificación" id="idSearchUser">
                                                    <span class="input-group-text" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Buscar usuario"
                                                        style="cursor:pointer" id="btnSearchUser"><i
                                                            class="fa-solid fa-magnifying-glass"
                                                            onclick="handleSearch(0,0)"></i></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-4 col-12 justify-content-center"
                                                style="margin-top:2% !important">
                                                <div class="form-floating">
                                                    <select name="filter" class="form-select" id="filterUser">
                                                        <option value="0">Usuarios</option>
                                                        <option value="2">Secretarias</option>
                                                    </select>
                                                    <label for="filter">Selecciona un filtro</label>
                                                </div>


                                            </div>
                                            <div class="col-lg-1 col-12 d-flex justify-content-center"
                                                style="margin-top:2% !important">
                                                <i class="fa-solid fa-list-ul listAll" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Listar todo"
                                                    data-bs-custom-class="custom-tooltip-excel"
                                                    onclick="handleListAll(0,0)"></i>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="datatable0" class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificación</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                                <th>Hora entrada</th>
                                                <th>Hora salida</th>
                                                <th>Rol</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="page page-1 page-hide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-12 text-center" style="margin-top:2% !important">
                                                <h5 class="card-title">Terapeutas</h5>
                                            </div>
                                            <div class="col-lg-4 col-12" style="margin-top:2% !important">

                                                <div class="input-group flex-nowrap">
                                                    <input type="number" class="form-control"
                                                        placeholder="Buscar por identificación" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        data-bs-title="Buscar por identificación"
                                                        id="idSearchTherapist">
                                                    <span class="input-group-text" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Buscar terapeuta"
                                                        style="cursor:pointer"><i class="fa-solid fa-magnifying-glass"
                                                            onclick="handleSearch(0,1)"></i></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-1 col-12 d-flex justify-content-center"
                                                style="margin-top:2% !important">
                                                <i class="fa-solid fa-list-ul listAll" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Listar todo"
                                                    data-bs-custom-class="custom-tooltip-excel"
                                                    onclick="handleListAll(0,1)"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="datatable1" class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificación</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                                <th>Hora entrada</th>
                                                <th>Hora salida</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="page page-2 page-hide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-12 text-center" style="margin-top:2% !important">
                                                <h5 class="card-title">Clientes</h5>
                                            </div>
                                            <div class="col-lg-4 col-12" style="margin-top:2% !important">

                                                <div class="input-group flex-nowrap">
                                                    <input type="number" class="form-control"
                                                        placeholder="Buscar por identificación" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        data-bs-title="Buscar por identificación" id="idSearchClient">
                                                    <span class="input-group-text" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Buscar cliente"
                                                        style="cursor:pointer" onclick="handleSearch(1,2)"><i
                                                            class="fa-solid fa-magnifying-glass"></i></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-1 col-12 d-flex justify-content-center"
                                                style="margin-top:2% !important">
                                                <i class="fa-solid fa-list-ul listAll" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Listar todo"
                                                    data-bs-custom-class="custom-tooltip-excel"
                                                    onclick="handleListAll(1,1)"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="datatable2" class="table table-bordered" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Identificación</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Dirección</th>
                                                    <th>Teléfono</th>
                                                    <th>Correo</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page page-3 page-hide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-12 text-center" style="margin-top:2% !important">
                                                <h5 class="card-title">Servicios</h5>
                                            </div>
                                            <div class="col-lg-4 col-12" style="margin-top:2% !important">

                                                <div class="input-group flex-nowrap">
                                                    <input type="number" class="form-control"
                                                        placeholder="Buscar por id" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Buscar por id"
                                                        id="idSearchService">
                                                    <span class="input-group-text" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Buscar servicio"
                                                        style="cursor:pointer" onclick="handleSearch(1,3)"><i
                                                            class="fa-solid fa-magnifying-glass"></i></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-1 col-12 d-flex justify-content-center"
                                                style="margin-top:2% !important">
                                                <i class="fa-solid fa-list-ul listAll" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Listar todo"
                                                    data-bs-custom-class="custom-tooltip-excel"
                                                    onclick="handleListAll(1,3)"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="datatable3" class="table table-bordered" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Duración</th>
                                                    <th>Precio</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>`

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page page-4 page-hide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-12 text-center" style="margin-top:2% !important">
                                                <h5 class="card-title">Productos</h5>
                                            </div>
                                            <div class="col-lg-4 col-12" style="margin-top:2% !important">

                                                <div class="input-group flex-nowrap">
                                                    <input type="number" class="form-control"
                                                        placeholder="Buscar por id" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Buscar por id"
                                                        id="idSearchProduct">
                                                    <span class="input-group-text" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Buscar producto"
                                                        style="cursor:pointer" onclick="handleSearch(1,4)"><i
                                                            class="fa-solid fa-magnifying-glass"></i></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-1 col-12 d-flex justify-content-center"
                                                style="margin-top:2% !important">
                                                <i class="fa-solid fa-list-ul listAll" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Listar todo"
                                                    data-bs-custom-class="custom-tooltip-excel"
                                                    onclick="handleListAll(1,4)"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="datatable4" class="table table-bordered" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Stock</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Precio</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page page-5 page-hide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-12 text-center" style="margin-top:2% !important">
                                                <h5 class="card-title">Citas</h5>
                                            </div>
                                            <div class="col-lg-4 col-12" style="margin-top:2% !important">

                                                <div class="input-group flex-nowrap">
                                                    <input type="number" class="form-control"
                                                        placeholder="Buscar por id" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Buscar por id"
                                                        id="idSearchquotes">
                                                    <span class="input-group-text" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Buscar cita"
                                                        style="cursor:pointer" onclick="handleSearch(1,5)"><i
                                                            class="fa-solid fa-magnifying-glass"></i></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-1 col-12 d-flex justify-content-center"
                                                style="margin-top:2% !important" onclick="handleListAll(1,5)">
                                                <i class="fa-solid fa-list-ul listAll" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Listar todo"
                                                    data-bs-custom-class="custom-tooltip-excel"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="datatable5" class="table table-bordered" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Fecha</th>
                                                    <th>Cliente</th>
                                                    <th>Servicio</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page page-6 page-show">
                            <div class="row p-4 d-block" style="transition: all .3s linear;">
                                <div class="col m-2 card shadow">
                                    <div class="card-body text-end">
                                        <div id="Grafica1" class="pb-3">
                                        </div>

                                    </div>
                                </div>
                                <div class="col m-2 card shadow">
                                    <div class="card-body text-end">
                                        <div id="Grafica2" class="pb-3">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page page-7 page-hide">

                            <div class="row p-4 d-block" style="transition: all .3s linear;">


                                <div class="col m-2 card shadow">
                                    <div class="card-body text-start">


                                        <form action="">

                                            <select class="form-control" id="opcionInforme" name="select">
                                                <option value="Ingresos">Ingresos por periodo</option>
                                                <option value="Ocupacion">Ocupación de terapeutas</option>
                                                <option value="Clientes">Clientes frecuentes</option>
                                                <option value="Inventario">Inventario y consumo de productos</option>
                                            </select>



                                            <div class="row p-4">
                                                buscar entre:

                                                <div class="col-4">
                                                    <input class="form-control" id="fechaInicio" required type="date">
                                                </div>
                                                y
                                                <div class="col-4">
                                                    <input class="form-control" id="fechaFin" required type="date">
                                                </div>

                                            </div>

                                        </form>
                                        <a id="generarInforme" class="btn btn-success">Generar informe</a>

                                        <span id="mensaje"></span>
                                    </div>
                                </div>

                                <div class="col m-2 card shadow">

                                    <hr>
                                    <div class="table-responsive">
                                        <table id="tabla" class="table table-bordered datatable" width="100%"
                                            cellspacing="0">

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>ADSO &copy; Centro de Tecnologías Agroindustriales</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modals -->

    <!-- Create User Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUsuarioLabel">Crear usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="">
                                    <label for="id" class="form-label">Identificación</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="names" placeholder="">
                                    <label for="names" class="form-label">Nombres</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lastname" placeholder="">
                                        <label for="lastname" class="form-label">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="">
                                        <label for="phone" class="form-label">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                </div>

                            </div>

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" placeholder="">
                                    <label for="password" class="form-label">Contraseña</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="schedule" class="form-select">
                                        <option value="08-14">08:00 a.m - 02:00 p.m</option>
                                        <option value="14-22">02:00 p.m - 10:00 p.m</option>
                                    </select>
                                    <label for="schedule" class="form-label">Seleccionar horario</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <select name="rol" class="form-select">
                                        <option value="1">Administrador</option>
                                        <option value="2">Secretaria</option>
                                    </select>
                                    <label for="rol" class="form-label">Seleccionar rol</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,0,'post','post')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit User Modal -->
    <div class="modal fade" id="editModalUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalUsuarioLabel">Editar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="" readonly>
                                    <label for="id" class="form-label">Identificación</label>
                                </div>
                            </div>
                        </div>


                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="names" placeholder="">
                                    <label for="names" class="form-label">Nombres</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lastname" placeholder="">
                                        <label for="lastname" class="form-label">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="">
                                        <label for="phone" class="form-label">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" placeholder="">
                                    <label for="password" class="form-label">Contraseña (No obligatorio)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="schedule" class="form-select">
                                        <option value="08-14">08:00 a.m - 02:00 p.m</option>
                                        <option value="14-22">02:00 p.m - 10:00 p.m</option>
                                    </select>
                                    <label for="schedule" class="form-label">Seleccionar horario</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <select name="rol" class="form-select">
                                        <option value="1">Administrador</option>
                                        <option value="2">Secretaria</option>
                                    </select>
                                    <label for="rol" class="form-label">Seleccionar rol</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,0,'post','put')">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Status User Modal -->
    <div class="modal fade" id="statusModalUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="statusModalUsuarioLabel">Cambiar estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Esta acción cambiará el estado de este usuario, si el
                        usuario
                        está inactivo
                        su contraseña cambiará a "sena2024"</h6>
                    <input type="number" name="id" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,0,'post','status')">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="modalTerapeuta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTerapeutaLabel">Crear terapeuta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="">
                                    <label for="id" class="form-label">Identificación</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="names" placeholder="">
                                    <label for="names" class="form-label">Nombres</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lastname" placeholder="">
                                        <label for="lastname" class="form-label">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="">
                                        <label for="phone" class="form-label">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                </div>

                            </div>

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" placeholder="">
                                    <label for="password" class="form-label">Contraseña</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="schedule" class="form-select">
                                        <option value="08-14">08:00 a.m - 02:00 p.m</option>
                                        <option value="14-22">02:00 p.m - 10:00 p.m</option>
                                    </select>
                                    <label for="schedule" class="form-label">Seleccionar horario</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,1,'post','post')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Therapist Modal -->
    <div class="modal fade" id="editModalTerapeuta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalTerapeutaLabel">Editar terapeuta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="" readonly>
                                    <label for="id" class="form-label">Identificación</label>
                                </div>
                            </div>
                        </div>


                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="names" placeholder="">
                                    <label for="names" class="form-label">Nombres</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lastname" placeholder="">
                                        <label for="lastname" class="form-label">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="">
                                        <label for="phone" class="form-label">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" placeholder="">
                                    <label for="password" class="form-label">Contraseña (No obligatorio)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="schedule" class="form-select">
                                        <option value="08-14">08:00 a.m - 02:00 p.m</option>
                                        <option value="14-22">02:00 p.m - 10:00 p.m</option>
                                    </select>
                                    <label for="schedule" class="form-label">Seleccionar horario</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,1,'post','put')">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Therapist Modal -->
    <div class="modal fade" id="statusModalTerapeuta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="statusModalTerapeutaLabel">Cambiar estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Esta acción cambiará el estado de este terapeuta, si el
                        terapeuta está inactivo su contraseña cambiará a "sena2024"</h6>
                    <input type="number" name="id" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,1,'post','status')">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Client Modal -->
    <div class="modal fade" id="modalCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalClienteLabel">Crear cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="">
                                    <label for="id" class="form-label">Identificación</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="names" placeholder="">
                                    <label for="names" class="form-label">Nombres</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lastname" placeholder="">
                                        <label for="lastname" class="form-label">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="address" placeholder="">
                                    <label for="address" class="form-label">Dirección</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="">
                                        <label for="phone" class="form-label">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,2,'post','post')">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editModalCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalClienteLabel">Editar cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="" readonly>
                                    <label for="id" class="form-label">Identificación</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="names" placeholder="">
                                    <label for="names" class="form-label">Nombres</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lastname" placeholder="">
                                        <label for="lastname" class="form-label">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="address" placeholder="">
                                    <label for="address" class="form-label">Dirección</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="">
                                        <label for="phone" class="form-label">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,2,'post','put')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Status Client Modal -->
    <div class="modal fade" id="statusModalCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="statusModalClienteLabel">Cambiar estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Esta acción cambiará el estado de este cliente, si está
                        "Activo" pasará a "Inactivo" y viceversa.</h6>
                    <input type="number" name="id" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,2,'post','status')">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Servicio Modal -->
    <div class="modal fade" id="modalServicio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalServicioLabel">Crear servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="">
                                    <label for="name" class="form-label">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="type" placeholder="">
                                        <label for="type" class="form-label">Tipo</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="time" placeholder="">
                                        <label for="time" class="form-label">Duración</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="value" placeholder="">
                                    <label for="value" class="form-label">Precio</label>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,3,'post','post')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Service Modal -->
    <div class="modal fade" id="editModalServicio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalServicioLabel">Editar servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="id" placeholder="" readonly>
                                    <label for="id" class="form-label">Id</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="">
                                    <label for="name" class="form-label">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="type" placeholder="">
                                        <label for="type" class="form-label">Tipo</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="time" placeholder="">
                                        <label for="time" class="form-label">Duración</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="value" placeholder="">
                                    <label for="value" class="form-label">Precio</label>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,3,'post','put')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Status Service Modal -->
    <div class="modal fade" id="statusModalServicio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="statusModalServicioLabel">Cambiar estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Esta acción cambiará el estado de este servicio, si está
                        "Activo" pasará a "Inactivo" y viceversa.</h6>
                    <input type="number" name="id" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,3,'post','status')">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Product Modal -->
    <div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalProductLabel">Crear producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="stock" placeholder="">
                                        <label for="stock" class="form-label">Stock</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="">
                                    <label for="name" class="form-label">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="type" placeholder="">
                                        <label for="type" class="form-label">Tipo</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="value" placeholder="">
                                    <label for="value" class="form-label">Precio</label>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,4,'post','post')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Product Modal -->
    <div class="modal fade" id="editModalProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalProductLabel">Editar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="id" placeholder="" readonly>
                                        <label for="id" class="form-label">Id</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="stock" placeholder="">
                                        <label for="stock" class="form-label">Stock</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="">
                                    <label for="name" class="form-label">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="type" placeholder="">
                                        <label for="type" class="form-label">Tipo</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="value" placeholder="">
                                    <label for="value" class="form-label">Precio</label>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,4,'post','put')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Status Product Modal -->
    <div class="modal fade" id="statusModalProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="statusModalProductoLabel">Cambiar estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Esta acción cambiará el estado de este producto, si está
                        "Activo" pasará a "Inactivo" y viceversa.</h6>
                    <input type="number" name="id" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,4,'post','status')">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Create quote Modal -->
    <div class="modal fade" id="modalQuote" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalQuotelabel">Agendar cita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <!-- MENSAJE DE ALERTA -->
                        <div id="alertMessage" class="alertContainer">

                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="id" placeholder="" id="id">
                                        <label for="id" class="form-label">Identificación cliente</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control datetime" name="fecha"
                                            placeholder="">
                                        <label for="date" class="form-label">Fecha</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="" id="name"
                                        readonly>
                                    <label for="name" class="form-label">Cliente</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="servicio" class="form-select services">
                                        <!-- Options se llenarán dinámicamente -->
                                    </select>
                                    <label for="servicio" class="form-label">Servicio</label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,5,'post','post')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit quote Modal -->
    <div class="modal fade" id="editModalquote" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalQuotelabel">Editar cita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="id" placeholder="" readonly>
                                        <label for="id" class="form-label">Id</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control datetime" name="fecha"
                                            placeholder="">
                                        <label for="date" class="form-label">Fecha</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="" readonly>
                                    <label for="name" class="form-label">Cliente</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="servicio" class="form-select services">
                                        <!-- Options se llenarán dinámicamente -->
                                    </select>
                                    <label for="servicio" class="form-label">Servicio</label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,5,'post','put')">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Status quote Modal -->
    <div class="modal fade" id="statusModalquote" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="statusModalQuoteLabel">Cambiar estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Esta acción cambiará el estado de esta cita, si está
                        "Activo" pasará a "Inactivo" y viceversa.</h6>
                    <input type="number" name="id" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success"
                        onclick="handleRequest(this,5,'post','status')">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logOutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logOutModalLabel">Cerrar sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "Aceptar" si quieres cerrar la sesión actual</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../controller/Login/logout.php">Aceptar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
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
    <script src="../assets/js/datatable/AutoTabla.js"></script>
    <script src="../assets/js/controlpanel/main.js"></script>

    <script src="../assets/js/apexcharts/apexcharts.js"></script>

    <script src="../assets/js/graficas.js"></script>
    <script src="../assets/js/informes.js"></script>
    <!-- Custom scripts for all pages-->


    <!-- Page level custom scripts -->

</body>

</html>
<?php
} catch (Exception $e) {
   header("Location: ./login.php");
   exit;
}