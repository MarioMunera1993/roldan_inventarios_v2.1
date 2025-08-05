<?php
session_start();
include_once('poo/pooConnectionDb.php');

$message = '';

// Procesa el formulario de login si se envió por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? ''); // Usuario ingresado
    $password = $_POST['password'] ?? '';     // Contraseña ingresada

    if($usuario && $password){
        $conn = Connection::connect();
        // Busca el usuario en la base de datos
        $stmt = $conn->prepare("SELECT IdUsuario, Usuario, PasswordHash FROM Usuarios WHERE Usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
        // Verifica el hash de la contraseña
        if ($user && password_verify($password, $user['PasswordHash'])) {
            $_SESSION['usuario'] = $user['Usuario'];
            $_SESSION['id_usuario'] = $user['IdUsuario'];
            header('Location: ./home.php'); // Redirige al inicio
            exit();
        } else {
            header('Location: ../../index.php');
            //$alert = $message = '<div class="error-login">Usuario o contraseña incorrectos.</div>';
        }

    }else {
        $message = '<div class="error-login">Ingrese usuario y contraseña.</div>';
    }

}

