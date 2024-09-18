<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <section class="col">
            <h4 class="mt-3 mb-0 fw-normal">Bienvenido a</h4>
            <h2 class="fw-bold mb-4">Gráficos de Empresa</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="bg-light rounded-4 p-4 shadow-sm">
                        <h5 class="mb-4">Ingresos Generados por Tiempo</h5>
                        <div class="d-flex justify-content-center align-items-center" style="height: 155px;" id="ingresosPorTiempo">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-light rounded-4 p-4 shadow-sm">
                        <h5 class="mb-4">Popularidad de Tratamientos</h5>
                        <div class="d-flex justify-content-center align-items-center" style="height: 155px;" id="popularidadTratamientos">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5 mb-md-0">
                    <div class="bg-light rounded-4 p-4 shadow-sm">
                        <h5 class="mb-4">Ingresos Generados por Servicio</h5>
                        <div class="d-flex justify-content-center align-items-center" style="height: 320px;" id="ingresosPorServicio">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="row fixed-bottom"></footer>
    <script src="../../../Assets/Js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="main.js"></script>
</body>

</html>