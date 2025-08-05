<?php
// auth.php: Incluir en páginas que requieren login
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.html');
    exit();
}
