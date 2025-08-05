<?php
include_once('../poo/pooComputadores.php');
include_once('../poo/pooMarcas.php');


$resultado = Computadores::insertarNuevoComputador();

if ($resultado === true) {
    echo '<script>alert("Computador guardado correctamente."); window.location.href = "vistaTablaComputadores.php";</script>';
    exit();
} else if ($resultado) {
    echo '<script>alert("' . addslashes($resultado) . '"); window.history.back();</script>';
    exit();
}
?>