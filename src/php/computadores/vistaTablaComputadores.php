<?php
include_once('../auth.php');
include_once '../poo/pooComputadores.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Gestión de Inventario - Informático</title>
</head>
<body>
    <div class="container-app">
        <!--Cabecera de la pagina-->
        <header class="container-header">
            <div class="container-header__logo">
                <img src="../../assest/img/logo.png" alt="Logo Roldan">
                <span>Tabla Computadores</span>
                <div class="container-header__search">
                    <input type="search" id="SearchInput" class="button form-input" placeholder="Buscar computador...">
                    <a href="../../../index.php" class="button button__danger">Cerrar sesion</a>
                </div>
            </div>
        </header>
        <!--Cuerpo de la pagina-->
        <div class="container-body">
            <aside class="container-aside">
                <nav class="container-aside__nav">
                    <ul>
                        <li><a href="../home.php" class="container-sidebar__link">Inicio</a></li>
                        <li><a href="#" class="container-sidebar__link">Usuarios</a></li>
                        <li><a href="../telefonos/vistaTablaTelefonos.php" class="container-sidebar__link">Teléfonos</a></li>
                        <li><a href="#" class="container-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="container-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="container-main">
                <h1 class="container-main__title">Listado de Computadores</h1>
                <div class="container-main__actions">
                    <a href="./vistaNuevoComputador.php" class="button--success">+ Ingresar Nuevo Computador</a>
                    <a href="#" class="button--excel">&#128202; Generar Excel</a>
                </div>
                <div class="table-container">
                    <table class="main-table" id="MainTable">
                        <thead>
                            <tr>
                                <th>PlacaComputador</th>
                                <th>NumeroSerial</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>SistemaOperativo</th>
                                <th>TipoEquipo</th>
                                <th>Procesador</th>
                                <th>GenRAM</th>
                                <th>RAM (GB)</th>
                                <th>DiscosDetalle</th>
                                <th>MAC Local</th>
                                <th>MAC Wifi</th>
                                <th>Estado</th>
                                <th>Bodega</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Llamada al método para obtener los datos de los computadores
                            $consulta = Computadores::mostrarTotalComputadores();
                            foreach ($consulta as $computador): ?>
                            <tr>
                                <td><?php echo $computador['PlacaComputador']; ?></td>
                                <td><?php echo $computador['SerialNumber']; ?></td>
                                <td><?php echo $computador['marca']; ?></td>
                                <td><?php echo $computador['modelo']; ?></td>
                                <td><?php echo $computador['sistemaOperativo']; ?></td>
                                <td><?php echo $computador['tipoEquipo']; ?></td>
                                <td><?php echo $computador['Procesador']; ?></td>
                                <td><?php echo $computador['genRam']; ?></td>
                                <td><?php echo $computador['ramGb']; ?></td>
                                <td><?php echo $computador['DiscosDetalle']; ?></td>
                                <td><?php echo $computador['MacLocal']; ?></td>
                                <td><?php echo $computador['MacWifi']; ?></td>
                                <td><?php echo $computador['estado']; ?></td>
                                <td><?php echo $computador['Bodega']; ?></td>
                                <td><?php echo $computador['Observaciones']; ?></td>
                                <td>
                                    <a href="vistaEditarComputador.php?id=<?php echo $computador['PlacaComputador']; ?>" class="button--edit">Editar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </main>
        </div>
        <!--Pie de la pagina-->
        <footer class="container-footer">
            <p>© <span id="CurrentYear"></span> Grupo Roldán. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../../js/seleccionarAño.js"></script>
    <script src="../../js/filtradoTiempoReal.js"></script>
</body>
</html>