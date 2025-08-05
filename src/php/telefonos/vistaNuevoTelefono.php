<?php 
include_once('../../php/auth.php');
include_once('../poo/pooMarcas.php');
//include_once('../poo/pooModelos.php');
include_once('../poo/pooSistemasOperativos.php');
include_once('../poo/pooGenRam.php');
include_once('../poo/pooTiposDispositivos.php');
include_once('../poo/pooTiposDiscos.php');
include_once('../poo/pooEstados.php');
include_once('../poo/pooBodegas.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/vistaNuevoComputador.css">
    <title>Gestión de Inventario - Informático</title>
</head>
<body>
    <div class="container-app">
        <!--Cabecera de la pagina-->
        <header class="container-header">
            <div class="container-header__logo">
                <img src="../../assest/img/logo.png" alt="Logo Roldan">
                <span>Ingreso Nuevo Telefono</span>
                <div class="container-header__search">
                    <a href="../../../index.php" class="button__danger">Cerrar sesion</a>
                </div>
            </div>
        </header>
        <!--Cuerpo de la pagina-->
        <div class="container-body">
            <aside class="container-aside">
                <nav class="container-aside__nav">
                    <ul>
                        <li><a href="./vistaTablaTelefonos.php" class="container-sidebar__link">Tabla Telefono</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="container-main">
                <h1 class="app-main__title">Ingreso Nuevo Teléfono</h1>
                <section class="form-section" id="formNuevoComputador">
                    <form class="data-form" id="formComputador" action="ingresarNuevoTelefono.php" method="POST">
                        <div class="form-grid">
                            <!-- Fila 1 -->
                            <div class="form-group">
                                <label for="PlacaTelefono" class="form-label">Placa del Teléfono</label>
                                <input type="text" id="PlacaTelefono" name="PlacaTelefono" class="form-input"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="IdMarca" class="form-label">Marca</label>
                                <select name="IdMarca" id="IdMarca" class="form-input" required>
                                    <option value="">Seleccione una marca</option>
                                    <?php
                                    // Llenar el select con las marcas disponibles
                                    $marcas = Marcas::obtenerMarcasTelefonos();
                                    foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca['IdMarca']; ?>">
                                        <?php echo $marca['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php
                                include_once('../poo/pooModelos.php');
                                ?>
                                <label for="idModelo" class="form-label">Modelo:</label>
                                <select id="IdModelo" name="idModelo" class="form-select" required>
                                <option value="">Seleccione Modelo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="serial" class="form-label">Serial:</label>
                                <input type="text" id="serial" name="serial" class="form-input"/>
                            </div>

                            <div class="form-group">
                                <label for="IdTipo" class="form-label">Tipo Telefono:</label>
                                <select class="form-input" name="IdTipo" id="IdTipo">
                                    <option value="">Seleccione Tipo</option>
                                    <?php
                                    // Llenar el select con los tipos disponibles
                                    $tipos = Tipos::obtenerTiposTelefono();
                                    foreach ($tipos as $tipo): 
                                    ?>
                                    <option value="<?php echo $tipo['IdTipo']; ?>">
                                        <?php echo $tipo['Nombre'];  ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ipTelefono" class="form-label">Ip Telefono:</label>
                                <input type="text" id="ipTelefono" name="ipTelefono" class="form-input"
                                    placeholder="192.168.20.2" />
                            </div>

                            <div class="form-group">
                                <label for="Mac" class="form-label">MAC:</label>
                                <input type="text" id="Mac" name="Mac" class="form-input"
                                    placeholder="AA-BB-CC-DD-EE-FF" />
                            </div>

                            <div class="form-group">
                                <label for="fechaCompra" class="form-label">Fecha Compra:</label>
                                <input type="date" id="fechaCompra" name="FechaCompra" class="form-input" required />
                            </div>

                            <div class="form-group">
                                <label for="idEstado" class="form-label">Estado:</label>
                                <select name="IdEstado" id="idEstado" class="form-input" required>
                                    <option value="">Seleccione un Estado</option>
                                    <?php
                                    // Llenar el select con los estados disponibles
                                    $estados = Estados::obtenerEstados();
                                    foreach ($estados as $estado): ?>
                                    <option value="<?php echo $estado['IdEstado']; ?>">
                                        <?php echo $estado['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="text" id="Precio" name="Precio" class="form-input"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="IdUbicacion" class="form-label">Ubicación/Bodega:</label>
                                <select name="IdUbicacion" id="IdUbicacion" class="form-input" required>
                                    <option value="">Seleccione Ubicación</option>
                                    <?php
                                    $bodegas = Bodegas::obtenerBodegas();
                                    foreach ($bodegas as $bodega):
                                    ?>
                                    <option value="<?php echo $bodega['IdUbicacion'] ?>"><?php echo $bodega['Nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Observaciones -->
                            <div class="form-group form-grid__span-2">
                                <label for="observaciones" class="form-label">Observaciones:</label>
                                <textarea id="observaciones" name="Observaciones" class="form-textarea"
                                    rows="4"></textarea>
                            </div>
                          
                            <div class="form-actions">
                                <button type="submit" class="button button--success">
                                    Guardar Telefono
                                </button>
                                <a href="vistaTablaTelefonos.php" class="button button--secondary">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </main>
        </div>
        <!--Pie de la pagina-->
        <footer class="container-footer">
            <p>© <span id="CurrentYear"></span> Grupo Roldán. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../../js/seleccionarAño.js"></script>
    <script src="../../js/cargarModelosPorMarcas.js"></script>
</body>
</html>