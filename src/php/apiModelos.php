<?php
include_once('./poo/pooModelos.php');
if (isset($_GET['IdMarca'])) {
    $IdMarca = $_GET['IdMarca'];
    $modelos = Modelos::obtenerModelosPorMarca($IdMarca);
    header('Content-Type: application/json');
    echo json_encode($modelos);
    exit();
}
echo json_encode([]);