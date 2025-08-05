<?php
// Cierra la sesión y redirige al login
session_start();
session_unset(); // Limpia variables de sesión
session_destroy(); // Destruye la sesión
header('Location: ../../index.html'); // Redirige al login
exit();