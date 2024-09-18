<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Utils/datatables.min.css">
</head>

<body class="container-fluid bg-body-secondary">
<div class="container-fluid">
        <header class="row"></header>
    </div>
    <main class="row mb-5 mb-md-0">
        <aside class="col col-md-auto g-0 p-2">
            <div class="bg-light rounded-3 p-2 shadow overflow-x-auto">
                <ul class="nav flex-nowrap flex-md-column gap-2" id="asideBar"></ul>
            </div>
        </aside>
        <section class="col px-3 px-md-5">
            <h4 class="mt-3 mb-0 fw-normal">Bienvenido a</h4>
            <h2 class="fw-bold mb-4">Reportes de Empresa</h2>
            <ul class="nav nav-underline fs-5 gap-4 mb-3">
                <li class="nav-item">
                    <button class="nav-link link-secondary" type="button" id="btnIngresosGenerados">Ingresos Generados</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link link-secondary" type="button" id="btnOcupacionTerapeutas">Ocupación Terapeutas</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link link-secondary" type="button" id="btnClientesFrecuentes">Clientes Frecuentes</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link link-secondary" type="button" id="btnConsumoProductos">Consumo Productos</button>
                </li>
            </ul>
            <div class="row">
                <div class="col">
                    <div id="lblError"></div>
                    <div class="table-responsive mb-5" id="table"></div>
                </div>
            </div>
        </section>
    </main>
    <footer class="row fixed-bottom"></footer>
    <script src="../../../Assets/Js/bootstrap.bundle.min.js"></script>
    <script src="../../Utils/vfs_fonts.js"></script>
    <script src="../../Utils/pdfmake.min.js"></script>
    <script src="../../Utils/datatables.min.js"></script>
    <script type="module" src="main.js"></script>
</body>

</html>