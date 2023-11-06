<?php
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="registro.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="js/registroPro.js"></script>

    <title>Document</title>
</head>

<body>
    <div>
        <section class="form">
            <form action="registradoPro.php" method="post" name="formulario2" id="formulario2">
                <h4>Registrarse como Proveedor</h4>
                <div>
                    <input type="text" class="imput" name="nombre" id="nombre" placeholder="Nombre">
                    <small></small>
                </div>

                
                <div>
                    <input type="text" class="imput" name="usuario" id="usuario" placeholder="Usuario">
                    <small></small>
                </div>
                <div>

                    <input type="text" class="imput" name="email" id="email" placeholder="Email">
                    <small></small>
                </div>
                <div>
                    <input type="password" class="imput" name="contra" id="contra" placeholder="Contraseña">
                    <small></small>
                </div>
                <div>
                    <input type="text" class="imput" name="direccion" id="direccion" placeholder="Dirección">
                    <small></small>
                </div>
                <div>
                    <input type="number" class="imput" name="telefono" id="telefono" placeholder="Teléfono">
                    <small></small>
                </div>
                <input class="bot" type="submit" name="enviar" value="Registrarse">
                <p><a href="iniciarSesionPro.php">Iniciar Sesión</a></p>
                
        </section>
        </form>
    </div>

    
</body>

</html>