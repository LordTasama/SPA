<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/Css/Styles.css">
    <link rel="shortcut icon" href="../Assets/Img/Spa_Logo.webp" type="image/x-icon">
    <title>Spa | Ingresar</title>
</head>

<body class="container-fluid bg-body-secondary">
    <header class="row bg-body">
        <div class="col-auto mx-auto">
            <a class="logo-icon" href="../Inicio/">
                <img width="180px" src="../Assets/Img/Spa_Logo.webp" alt="Spa_Logo.webp">
            </a>
        </div>
    </header>
    <nav class="row bg-body shadow py-2 py-md-3 mb-5">
        <div class="col">
            <ul class="nav flex-column flex-md-row">
                <li class="nav-item">
                    <a class="nav-link link-dark link-opacity-50 link-opacity-100-hover text-center fs-5" href="../Inicio/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark link-opacity-50 link-opacity-100-hover text-center fs-5" href="./">Dashboard</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-auto ms-auto align-content-center mt-2 mt-md-0">
            <div class="btn-group shadow-sm w-100">
                <a class="btn btn-lg btn-success active" href="../Ingresar/">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Ingresar
                </a>
                <a class="btn btn-lg btn-success" href="../Registrarse/">
                    Registrarse
                </a>
            </div>
        </div>
    </nav>
    <main class="row">
        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4 col-xxl-3 mt-5 mx-auto">
            <div class="bg-body rounded-4 border shadow p-4">
                <h1 class="display-5 fw-semibold text-center mb-0">
                    Ingreso
                </h1>
                <p class="text-black-50 fs-4 text-center mb-4">Bienvenido a Azkara Spa</p>
                <form action="" method="post">
                    <div class="form-floating fs-5 py-1 mb-2">
                        <input type="email" class="form-control rounded-3" name="email" id="email" placeholder="" required>
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating fs-5 py-1 mb-1">
                        <input type="password" class="form-control rounded-3" name="pass" id="pass" placeholder="" minlength="8" required>
                        <label for="pass">Contraseña</label>
                    </div>
                    <div class="form-check text-black-50">
                        <input class="form-check-input" type="checkbox" id="showPass">
                        <label class="form-check-label" for="showPass">
                            Mostrar contraseña
                        </label>
                    </div>
                    <p class="mb-0" id="lblErr"></p>
                    <button class="btn btn-lg btn-success w-100 mt-4" type="submit" id="btnEntrar">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </main>
    <footer class="row bg-body border-top border-2 py-4 px-2 mt-5">
        <div class="col-12 d-flex justify-content-center">
            <div class="hstack fs-3 gap-2">
                <a class="nav-link" href="https://www.facebook.com" target="_Blank"><i class="bi bi-facebook bg-body-secondary link-primary link-opacity-50 link-opacity-100-hover rounded-circle py-2 px-3"></i></a>
                <a class="nav-link" href="https://www.instagram.com" target="_Blank"><i class="bi bi-instagram bg-body-secondary link-danger link-opacity-50 link-opacity-100-hover rounded-circle py-2 px-3"></i></a>
                <a class="nav-link" href="https://www.whatsapp.com" target="_Blank"><i class="bi bi-whatsapp bg-body-secondary link-success link-opacity-50 link-opacity-100-hover rounded-circle py-2 px-3"></i></a>
            </div>
        </div>
        <div class="col-12">
            <div class="clearfix fs-5">
                <a class="float-start nav-link d-flex align-items-center gap-2" href="https://www.github.com/JohnFRivera" target="_Blank">
                    <i class="bi bi-github"></i>
                    Front | <b>John Rivera</b>
                </a>
                <a class="float-end nav-link d-flex align-items-center gap-2" href="https://www.github.com/kevin10290" target="_Blank">
                    <i class="bi bi-github"></i>
                    Back | <b>Kevinn Alzate</b>
                </a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById("showPass").addEventListener("change", () => {
            var inpPass = document.getElementById("pass");
            inpPass.type == "password" ? inpPass.type = "text" : inpPass.type = "password";
        });
    </script>
</body>

</html>