<?php
include_once('../poo/pooTelefonos.php');

$resultado = Telefonos::editarTelefonos();
if ($resultado === true) {
    echo '<script>alert("Teléfono actualizado correctamente."); window.location.href = "vistaTablaTelefonos.php";</script>';
    exit();
} else {
    echo '<script>alert("' . addslashes($resultado) . '"); window.history.back();</script>';
    exit();
}
?>