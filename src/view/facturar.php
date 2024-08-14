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
            <div class="row p-3">
                <div class="col-md-6">
                    <form action="">



                        <div class="col">
                            <label for="">Cliente</label>
                            <input type="text" name="" class="form-control" id="cliente" list="clientelist">
                            <datalist id="clientelist"></datalist>
                            <input type="hidden" id="idcliente">
                        </div>

                        <script>
                            fetch("../controller/Data/clientsinfo.php", {
                                    method: "POST",
                                })
                                .then((response) => {
                                    return response.json();
                                })
                                .then(data => {
                                    const clientelist = document.getElementById('clientelist');
                                    data.forEach(item => {
                                        const option = document.createElement('option');
                                        option.value = item.id; // store the ID as the value
                                        option.label = `${item.nombres} ${item.apellidos}`; // display the full name as the label
                                        clientelist.appendChild(option);
                                    })
                                })
                        </script>


                        <p></p>
                        <div class="col"><label for="">Método de pago</label>
                            <select class="form-control" id="metodopago" name="select">
                                <option value="Ingresos">Efectivo</option>
                                <option value="Credito">Crédito</option>
                                <option value="Transferencia">Transferencia</option>

                            </select>
                        </div>
                        <p></p>
                        <div class="col">
                            <label for="">Fecha de pago</label>
                            <input type="datetime-local" name="" class="form-control" id="fechapago">
                        </div>
                        <p></p>

                        <script>
                            const fechaPagoInput = document.getElementById('fechapago');
                            const now = new Date();
                            const year = now.getFullYear();
                            const month = (`0${now.getMonth() + 1}`).slice(-2);
                            const day = (`0${now.getDate()}`).slice(-2);
                            const hour = (`0${now.getHours()}`).slice(-2);
                            const minute = (`0${now.getMinutes()}`).slice(-2);
                            const second = (`0${now.getSeconds()}`).slice(-2);
                            fechaPagoInput.value = `${year}-${month}-${day}T${hour}:${minute}:${second}`;
                        </script>



                        <br>
                        <div class="col-12 ">




                            <h1 for="">Total a pagar</h1>
                            <span id="preciopagar" class="display-4"></span>$ <br>
                            <br>
                            <div>
                                <a id="generarfactura" class="btn btn-warning btn-block">Generar factura</a>
                            </div>
                        </div>




                    </form>
                </div>
                <div class="col-md-6">
                    <br>
                    <div class="col">
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#elementsmodal">
                            Agregar un nuevo producto o servicio
                        </button>
                    </div>

                    <br>

                    <div class="table-responsive">
                        <table id="table-body-other-table" class="table  datatable collapsed" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>

                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- the product will be added here-->

                            </tbody>
                        </table>
                    </div>




                </div>

            </div>
        </div>
        </div>



        <div class="modal fade" id="elementsmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-transparent">

                    <div class="modal-body">

                        <div>

                            <div class="container card p-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h1>Productos</h1>
                                        <div class="table-responsive">
                                            <table id="tabla" class="table  datatable collapsed" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Stock</th>
                                                        <th>Nombre</th>
                                                        <th>Tipo</th>
                                                        <th>Precio</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <h1>Servicios</h1>
                                        <div class="table-responsive">
                                            <table id="services-table" class="table  datatable collapsed" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Precio</th>
                                                        <th>Tipo</th>
                                                        <th>Duración</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="services-table-body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
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

    <script src="../assets/js/loaddatatable.js"></script>
    <script src="../assets/js/paypoint.js"></script>



    <script>
        fetch("../controller/Data/servicesinfo.php", {
                method: "POST",
            })
            .then((response) => {
                return response.json();
            })
            .then(data => {
                const servicesTableBody = document.getElementById('services-table-body');
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                                            <td>${item.id}</td>
                                            <td>${item.nombre}</td>
                                            <td>${item.precio}</td>
                                            <td>${item.tipo}</td>
                                            <td>${item.duracion}</td>
                                            <td><button id="add-service-button-${item.id}" class="btn btn-warning">Añadir</button></td>
                                            `;
                    servicesTableBody.appendChild(row);
                })
            })



        fetch("../controller/Data/productsinfo.php", {
                method: "POST",

            })
            .then((response) => {
                console.log(response)
                return response.json();
                //
            }).then(data => {
                const tableBody = document.getElementById('table-body');
                //Button for add to add the producto to the other table and reduce the stock of this
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                                                <td>${item.id}</td>
                                                <td><span class="badge bg-dark text-white" id="${item.id}">${item.stock}</span></td>
                                                <td>${item.nombre}</td>
                                                 <td>${item.tipo}</td>
                                                 <td>${item.precio}</td>
                                                 
                                                       <td><button id="add-button-${item.id}" class="btn btn-warning">Añadir</button></td>
   `;
                    tableBody.appendChild(row);
                })
            })
    </script>

    </html>
<?php
} catch (Exception $e) {
    header("Location: ./login.php");
    exit;
}
