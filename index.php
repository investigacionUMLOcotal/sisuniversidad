<?php
//arreglo con mensajes que puede recibir
$messages = [
    "1" => "Credenciales incorrectas",
    "2" => "No ha iniciado sesión"
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Login | Registro </title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#563d7c">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" action="login_post.php" method="post">
        <img class="mb-4" src="imagenes/logoUML.png" alt="" width="250">
        <h1 class="h3 mb-3 font-weight-normal">SIS - Universidad </h1>
        <label for="inputEmail" class="sr-only">Nombre de usuario</label>
        <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        <br>
        <?php
    if (isset($_GET['err']) && is_numeric($_GET['err']) && $_GET['err'] > 0 && $_GET['err'] < 3)
        echo '<span class="alert alert-danger">' . $messages[$_GET['err']] . '</span>';
    ?>
        <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
    
</body>
</html>