<?php
include_once('../auth.php');
include_once '../poo/pooTelefonos.php';
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
                <span>Tabla Teléfonos</span>
                <div class="container-header__search">
                    <input type="search" id="SearchInput" class="button form-input" placeholder="Buscar telefono...">
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
                        <li><a href="../computadores/vistaTablaComputadores.php" class="container-sidebar__link">Computadores</a></li>
                        <li><a href="#" class="container-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="container-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="container-main">
                <h1 class="container-main__title">Listado de Teléfonos</h1>
                <div class="container-main__actions">
                    <a href="./vistaNuevoTelefono.php" class="button--success">+ Ingresar Nuevo Telefono</a>
                    <a href="#" class="button--excel">&#128202; Generar Excel</a>
                </div>
                <div class="table-container">
                    <table class="main-table" id="MainTable">
                        <thead>
                            <tr>
                                <th>PlacaTeléfono</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serial</th>
                                <th>TipoTeléfono</th>
                                <th>IP</th>
                                <th>MAC</th>
                                <th>FechaCompra</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Observaciones</th>
                                <th>Sede</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Llamada al método para obtener los datos de los teléfonos
                            $consulta = Telefonos::mostrarTotalTelefonos();
                            foreach ($consulta as $telefono): ?>
                            <tr>
                                <td><?php echo $telefono['PlacaTelefono']; ?></td>
                                <td><?php echo $telefono['MarcaTelefono']; ?></td>
                                <td><?php echo $telefono['ModeloTelefono']; ?></td>
                                <td><?php echo $telefono['Serial']; ?></td>
                                <td><?php echo $telefono['TipoTelefono']; ?></td>
                                <td><?php echo $telefono['IpTelefono']; ?></td>
                                <td><?php echo $telefono['Mac']; ?></td>
                                <td><?php echo $telefono['FechaCompra']; ?></td>
                                <td><?php echo $telefono['EstadoTelefono']; ?></td>
                                <td><?php echo $telefono['Precio']; ?></td>
                                <td><?php echo $telefono['Notas']; ?></td>
                                <td><?php echo $telefono['Ubicacion']; ?></td>
                                <td>
                                    <a href="vistaEditarTelefono.php?id=<?php echo $telefono['PlacaTelefono']; ?>" class="button--edit">Editar</a>
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