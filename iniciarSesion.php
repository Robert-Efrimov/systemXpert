<!DOCTYPE html>
<html lang="en">
<head>
<?php
    $conexion = mysqli_connect("localhost", "root", "", "system");

   
    mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");
 
  

    ?>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="registro.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <script src="js/inicio.js"></script>
    <title>Document</title>
</head>
<body>
    

    <section class="form">
    <form action="compSes.php" method="post" name="formulario" id="formulario">
        <h4>Iniciar Sesión como cliente</h4>
        <div>
        <input type="text" class="imput" name="usuario" id="usuario"  placeholder="Usuario">
        <small></small>
        </div>
        <div>
        <input type="password" class="imput" name="contra" id="contra"  placeholder="Contraseña">
        <small></small>
        </div>
        
            <input class="bot" type="submit" name="enviar"  value="Iniciar Sesión">
            <p><a href="iniciarSesionPro.php">Iniciar sesión como proveedor</a></p>
        <p><a href="registro.php">Registrarse</a></p>
        
    </section>
    </form>
    </div>
    
    
</body>
</html>