<?php
$conexion = mysqli_connect("localhost", "root", "", "system");
mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: iniciarSesion.php');
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">

    <title>Venta Realizada</title>
</head>

<body>

    <div class="container">
        <h1 class="text-center mt-5">Venta Realizada</h1>
        <p class="text-center">¡Gracias por tu compra!</p>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Seguir Comprando</a>
        </div>
    </div>

</body>

</html>