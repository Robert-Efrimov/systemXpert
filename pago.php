<?php
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();


if (isset($_SESSION['usuarioPro'])) {
    unset($_SESSION['usuarioPro']);
}

if (!isset($_SESSION['usuario'])) {
    header('Location: iniciarSesion.php');
    exit();
}

$totalCompra = $_POST["totalCompra"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/carrucel.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="comp.css">
    <script src="js/comp.js"></script>


    <title>Document</title>
</head>

<body>


    <div class="pago-container">
        <div class="añT">Realizar Pago</div>
        <form action="procesarVenta.php" name="formulario4" id="formulario4" method="POST">
            <input type="hidden" name="totalCompra" value="<?php echo $totalCompra ?>">
            
            <div class="añN">Nombre del Titular</div>
            <div>
                <input type="text" name="nombre" id="nombre" class="añI">
                <small></small>
            </div>

            
            <div class="añN">Nº Tarjeta</div>
            <div>
                <input type="number" name="tarjeta" id="tarjeta" class="añI">
                <small></small>
            
            </div>

            <div class="añN">Fecha de Vencimiento</div>
            <div>
                <input type="number" name="caducidad" id="caducidad" class="añI">
                <small></small>
            </div>

            <div class="añN">CVV</div>
            <div>
                <input type="number" name="seg" id="seg" class="añI">
                <small></small>
            </div>


            <div class="añB1"><button class="añB" type="submit" name="enviar">Enviar</button></div>
        </form>

    </div>
    

</body>

</html>