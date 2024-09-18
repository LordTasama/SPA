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
            <h2 class="fw-bold mb-4">Gestión de Servicios</h2>
            <div class="row mb-2">
                <div class="col-auto">
                    <button class="btn btn-primary" type="button" id="btnNuevo">
                        <i class="bi bi-plus-lg"></i>
                        Nuevo
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="lblError"></div>
                    <div class="table-responsive mb-5">
                        <table class="table table-light table-hover fs-5 w-100" id="dataTable">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="row fixed-bottom"></footer>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"></div>
    <script src="../../../Assets/Js/bootstrap.bundle.min.js"></script>
    <script src="../../Utils/datatables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="module" src="main.js"></script>
</body>
</html>