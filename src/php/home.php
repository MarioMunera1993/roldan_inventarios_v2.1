<?php include_once('./auth.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gestión de Inventario - Informático</title>
</head>
<body>
    <div class="container-app">
        <!--Cabecera de la pagina-->
        <header class="container-header">
            <div class="container-header__logo">
                <img src="../assest/img/logo.png" alt="Logo Roldan">
                <span>Home</span>
                <div class="container-header__search">
                    <a href="../../index.php" class="button__danger">Cerrar sesion</a>
                </div>
            </div>
        </header>
        <!--Cuerpo de la pagina-->
        <div class="container-body">
            <aside class="container-aside">
                <nav class="container-aside__nav">
                    <ul>
                        <li><a href="../php/computadores/vistaTablaComputadores.php" class="container-sidebar__link">Computadores</a></li>
                        <li><a href="#" class="container-sidebar__link">Usuarios</a></li>
                        <li><a href="../php/telefonos/vistaTablaTelefonos.php" class="container-sidebar__link">Teléfonos</a></li>
                        <li><a href="#" class="container-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="container-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="container-main">

            </main>
        </div>
        <!--Pie de la pagina-->
        <footer class="container-footer">
            <p>© <span id="CurrentYear"></span> Grupo Roldán. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../js/seleccionarAño.js"></script>
</body>
</html>
