<?php 
include_once('../../php/auth.php');
include_once('../poo/pooMarcas.php');
include_once('../poo/pooTiposDispositivos.php');
include_once('../poo/pooEstados.php');
include_once('../poo/pooBodegas.php');
include_once('../poo/pooTelefonos.php');

if (!isset($_GET['id'])) {
    echo '<script>alert("No se especificó el Telefono a editar."); window.location.href = "vistaTablaTelefonos.php";</script>';
    exit();
}
$placa = $_GET['id'];
$datos = Telefonos::obtenerDatosParaEditar($placa);
if (!$datos) {
    echo '<script>alert("Telefono no encontrado."); window.location.href = "vistaTablaTelefonos.php";</script>';
    exit();
}
// Listas para selects
$marcas = Marcas::obtenerMarcasTelefonos();
$tipos = Tipos::obtenerTiposTelefono();
$estados = Estados::ObtenerEstados();
$bodegas = Bodegas::obtenerBodegas();

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
                <span>Editar Telefono</span>
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
                        <li><a href="./vistaTablaTelefonos.php" class="container-sidebar__link">Tabla Telefonos</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="container-main">
                <h1 class="app-main__title">Editar Telefonos</h1>
                                <section class="form-section" id="formNuevoComputador">
                    <form class="data-form" id="formComputador" action="ingresarNuevoTelefono.php" method="POST">
                        <div class="form-grid">
                            <!-- Fila 1 -->
                            <div class="form-group">
                                <label for="PlacaTelefono" class="form-label">Placa del Teléfono</label>
                                <input type="text" name="PlacaTelefono" class="form-input " value="<?php echo htmlspecialchars($datos['PlacaTelefono']); ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Marca:</label>
                                <select name="IdMarca" class="form-select" required>
                                    <?php foreach ($marcas as $m): ?>
                                        <option value="<?php echo $m['IdMarca']; ?>" <?php if ($m['IdMarca'] == $datos['IdMarca']) echo 'selected'; ?>><?php echo $m['Nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php
                                include_once('../poo/pooModelos.php');
                                ?>
                                <label class="form-label">Modelo:</label>
                                <select name="IdModelo" id="idModelo" class="form-select" required>
                                <option value="">Seleccione Modelo</option>
                                <?php if (!empty($datos['IdMarca'])): 
                                    $modelos = Modelos::obtenerModelosPorMarca($datos['IdMarca']);
                                    foreach ($modelos as $modelo): ?>
                                    <option value="<?php echo $modelo['IdModelo']; ?>" <?php if ($modelo['IdModelo'] == $datos['IdModelo']) echo 'selected'; ?>><?php echo $modelo['NombreModelo']; ?></option>
                                <?php endforeach; endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="serial" class="form-label">Serial:</label>
                                <input type="text" name="serial" class="form-input" value="<?php echo htmlspecialchars($datos['Serial']); ?>"/>
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
                                    <option value="<?php echo $tipo['IdTipo']; ?>" <?php if ($tipo['IdTipo'] == $datos['IdTipo']) echo 'selected'; ?>>
                                        <?php echo $tipo['Nombre']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ipTelefono" class="form-label">Ip Telefono:</label>
                                <input type="text" name="ipTelefono" class="form-input" value="<?php echo htmlspecialchars($datos['IpTelefono']); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="Mac" class="form-label">MAC:</label>
                                <input type="text" name="Mac" class="form-input" value="<?php echo htmlspecialchars($datos['Mac']); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="fechaCompra" class="form-label">Fecha Compra:</label>
                                <input type="date" name="FechaCompra" class="form-input" value="<?php echo htmlspecialchars($datos['FechaCompra']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label for="idEstado" class="form-label">Estado:</label>
                                <select name="IdEstado" id="idEstado" class="form-input" required>
                                    <option value="">Seleccione un Estado</option>
                                    <?php
                                    // Llenar el select con los estados disponibles
                                    $estados = Estados::obtenerEstados();
                                    foreach ($estados as $estado): ?>
                                    <option value="<?php echo $estado['IdEstado']; ?>" <?php if ($estado['IdEstado'] == $datos['IdEstado']) echo 'selected'; ?>>
                                        <?php echo $estado['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="text" name="Precio" class="form-input" value="<?php echo htmlspecialchars($datos['Precio']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="IdUbicacion" class="form-label">Ubicación/Bodega:</label>
                                <select name="IdUbicacion" id="IdUbicacion" class="form-input" required>
                                    <option value="">Seleccione Ubicación</option>
                                    <?php
                                    $bodegas = Bodegas::obtenerBodegas();
                                    foreach ($bodegas as $bodega):
                                    ?>
                                    <option value="<?php echo $bodega['IdUbicacion']; ?>" <?php if ($bodega['IdUbicacion'] == $datos['IdUbicacion']) echo 'selected'; ?>>
                                        <?php echo $bodega['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Observaciones -->
                            <div class="form-group form-grid__span-2">
                                <label for="observaciones" class="form-label">Observaciones:</label>
                                <textarea name="Observaciones" class="form-textarea" rows="4"><?php echo htmlspecialchars($datos['Notas']); ?></textarea>
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
    <script src="../../js/cargarModelosPorMarcasEditar.js"></script>
</body>
</html>