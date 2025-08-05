<?php
include_once('../poo/pooTelefonos.php');
include_once('../poo/pooMarcas.php');


$resultado = Telefonos::insertarNuevoTelefono();

if ($resultado === true) {
    echo '<script>alert("Telefono guardado correctamente."); window.location.href = "vistaTablaTelefonos.php";</script>';
    exit();
} else if ($resultado) {
    echo '<script>alert("' . addslashes($resultado) . '"); window.history.back();</script>';
    exit();
}
?>