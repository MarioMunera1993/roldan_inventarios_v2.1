<?php
include_once('src/php/login.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/index.css">
    <title>Login - Inventario</title>
</head>
<body>
    <div class="container-login">
        <h2 class="title-login">Iniciar Sesión</h2>
        <!--Aqui va el mensaje de error enviado desde login.php-->
        <?php $alert; ?>
        <form action="./src/php/login.php" method="POST" autocomplete="off">
            <div class="group-form">
                <label class="label-form" for="Usuario">Usuario</label>
                <input class="input-form" type="text" name="usuario" id="Usuario" required autofocus>
            </div>
            <div class="group-form">
                <label class="label-form" for="Password">Contraseña</label>
                <input class="input-form" type="password" name="password" id="Password" required>
            </div>
            <button class="button" type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>