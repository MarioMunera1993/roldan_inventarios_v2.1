<?php
// pooComputadores.php
include_once('../poo/pooComputadores.php');

$resultado = Computadores::editarComputador();
if ($resultado === true) {
    echo '<script>alert("Computador actualizado correctamente."); window.location.href = "vistaTablaComputadores.php";</script>';
    exit();
} else {
    echo '<script>alert("' . addslashes($resultado) . '"); window.history.back();</script>';
    exit();
}
?>