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
include_once('../poo/pooComputadores.php');

if (!isset($_GET['id'])) {
    echo '<script>alert("No se especificó el computador a editar."); window.location.href = "vistaTablaComputadores.php";</script>';
    exit();
}
$placa = $_GET['id'];
$datos = Computadores::obtenerDatosParaEditar($placa);
if (!$datos) {
    echo '<script>alert("Computador no encontrado."); window.location.href = "vistaTablaComputadores.php";</script>';
    exit();
}
// Listas para selects
$marcas = Marcas::obtenerMarcas();
$sistemas = SistemasOperativos::obtenerSistemasOperativos();
$tipos = Tipos::obtenerTipos();
$genRam = GeneracionRam::obtenerGeneracionRam();
$estados = Estados::ObtenerEstados();
$bodegas = Bodegas::obtenerBodegas();
$tiposDisco = TiposDiscos::obtenerTiposDiscos();

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
                <span>Editar Equipo</span>
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
                        <li><a href="./vistaTablaComputadores.php" class="container-sidebar__link">Tabla Computadores</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                        <li><a href="#" class="container-sidebar__link">.</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="container-main">
                <h1 class="app-main__title">Editar Computador</h1>
                <section class="form-section" id="formEditarComputador">
                <form class="data-form" id="formEditar" action="editarComputador.php" method="POST">
                    <input type="hidden" name="PlacaComputador" value="<?php echo htmlspecialchars($datos['PlacaComputador']); ?>" />
                    <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Placa Computador:</label>
                        <input type="text" class="form-input" value="<?php echo htmlspecialchars($datos['PlacaComputador']); ?>" disabled />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Serial Number:</label>
                        <input type="text" name="SerialNumber" class="form-input" value="<?php echo htmlspecialchars($datos['SerialNumber']); ?>" required />
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
                        <label class="form-label">Sistema Operativo:</label>
                        <select name="IdSistemaOperativo" class="form-select" required>
                        <?php foreach ($sistemas as $so): ?>
                            <option value="<?php echo $so['IdSistemaOperativo']; ?>" <?php if ($so['IdSistemaOperativo'] == $datos['IdSistemaOperativo']) echo 'selected'; ?>><?php echo $so['Nombre']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Procesador:</label>
                        <input type="text" name="Procesador" class="form-input" value="<?php echo htmlspecialchars($datos['Procesador']); ?>" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Generación RAM:</label>
                        <select name="GeneracionRam" class="form-input">
                        <?php foreach ($genRam as $gr): ?>
                            <option value="<?php echo $gr['IdGeneracionRam']; ?>" <?php if ($gr['IdGeneracionRam'] == $datos['IdGeneracionRam']) echo 'selected'; ?>><?php echo $gr['GeneracionRam']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Memoria RAM (GB):</label>
                        <input type="number" name="MemoriaRAM" class="form-input" min="1" value="<?php echo htmlspecialchars($datos['MemoriaRAM_GB']); ?>" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo Dispositivo:</label>
                        <select name="IdTipo" class="form-select" required>
                        <?php foreach ($tipos as $t): ?>
                            <option value="<?php echo $t['IdTipo']; ?>" <?php if ($t['IdTipo'] == $datos['IdTipo']) echo 'selected'; ?>><?php echo $t['Nombre']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fecha de Compra:</label>
                        <input type="date" name="FechaCompra" class="form-input" value="<?php echo htmlspecialchars($datos['FechaCompra']); ?>" required />
                    </div>
                    <!-- Discos -->
                    <fieldset class="form-fieldset form-grid__span-2">
                        <legend class="form-legend">Almacenamiento</legend>
                        <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Marca Disco 1:</label>
                            <input type="text" name="MarcaDisco1" class="form-input" value="<?php echo htmlspecialchars($datos['MarcaDisco1']); ?>" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Capacidad Disco1:</label>
                            <input type="text" name="CapacidadDisco1" class="form-input" value="<?php echo htmlspecialchars($datos['CapacidadDisco1']); ?>" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tipo Disco 1:</label>
                            <select name="TipoDisco1" class="form-select">
                            <?php foreach ($tiposDisco as $td): ?>
                                <option value="<?php echo $td['IdTipoDisco']; ?>" <?php if ($td['IdTipoDisco'] == $datos['TipoDisco1']) echo 'selected'; ?>><?php echo $td['NombreTipo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Marca Disco2(Opcional):</label>
                            <input type="text" name="MarcaDisco2" class="form-input" value="<?php echo htmlspecialchars($datos['MarcaDisco2']); ?>" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Capacidad Disco 2(Opcional):</label>
                            <input type="text" name="CapacidadDisco2" class="form-input" value="<?php echo htmlspecialchars($datos['CapacidadDisco2']); ?>" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tipo Disco 2:</label>
                            <select name="TipoDisco2" class="form-select">
                            <?php foreach ($tiposDisco as $td): ?>
                                <option value="<?php echo $td['IdTipoDisco']; ?>" <?php if ($td['IdTipoDisco'] == $datos['TipoDisco2']) echo 'selected'; ?>><?php echo $td['NombreTipo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label class="form-label">MAC Local (Ethernet):</label>
                        <input type="text" name="MacLocal" class="form-input" value="<?php echo htmlspecialchars($datos['MacLocal']); ?>" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">MAC Wifi:</label>
                        <input type="text" name="MacWifi" class="form-input" value="<?php echo htmlspecialchars($datos['MacWifi']); ?>" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estado:</label>
                        <select name="IdEstado" class="form-select" required>
                        <?php foreach ($estados as $e): ?>
                            <option value="<?php echo $e['IdEstado']; ?>" <?php if ($e['IdEstado'] == $datos['IdEstado']) echo 'selected'; ?>><?php echo $e['Nombre']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ubicación/Bodega:</label>
                        <select name="IdUbicacion" class="form-select" required>
                        <?php foreach ($bodegas as $b): ?>
                            <option value="<?php echo $b['IdUbicacion']; ?>" <?php if ($b['IdUbicacion'] == $datos['IdUbicacion']) echo 'selected'; ?>><?php echo $b['Nombre']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group form-grid__span-2">
                        <label class="form-label">Observaciones:</label>
                        <textarea name="Observaciones" class="form-textarea" rows="4"><?php echo htmlspecialchars($datos['Observaciones']); ?></textarea>
                    </div>
                    </div>
                    <div class="form-actions">
                    <button type="submit" class="button button--success">Guardar Cambios</button>
                    <a href="vistaTablaComputadores.php" class="button button--secondary">Cancelar</a>
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