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
    

    <title>Document</title>
</head>

<body>

<div class="barra1">
        <div class="barra2">
            <div><a href="index.php"><img src="img/logo1.PNG" class="img2" alt="img/logo1.PNG" style="margin-right: 10px;"></a> </div>
            <div>

                <div class=mnav>

                    <nav>
                        <ul class="menu">
                            <li class="dropdown">
                                <a href="#"><img src="img/menu.png" width="35px" height="auto" alt=""> Todo</a>
                                <ul class="submenu">

                                    <?php


                                    $sql1 = "SELECT * FROM tipos";
                                    $tipo = $conexion->query($sql1);

                                    // Mostrar los productos en el swiper
                                    if ($tipo->num_rows > 0) {
                                        while ($row = $tipo->fetch_assoc()) {
                                    ?>
                                            <form action="productos.php" method="post">
                                                <input type="hidden" name="idT" value="<?php echo $row["idTipo"]; ?>">
                                                <li><button type="submit" class="botc"><?php echo $row["nombre"]; ?></button></li>
                                            </form>
                                    <?php
                                        }
                                    }

                                    ?>

                                </ul>
                            </li>

                        </ul>
                    </nav>

                </div>

            </div>
            <div class="barra5">
                <a href="añadirPC.php"><img src="img/anadir.png" width="35px" height="auto" alt=""> Añadir producto</a>
            </div>
        </div>


        <div class="barra4">
            <div>
                <form action="buscador.php" method="POST">
                    <input class="form-control" name="buscar" type="search" style="width : 500px;height:45px " placeholder="Buscar">
                </form>
            </div>
        </div>
        <div>


        </div>
        <div class="barra3">
            <div class="mm">
            <div class=mnav>

                <nav>
                    <ul class="menu">
                        <li class="dropdown">
                            <div class="df">
                            <div><img src="img/per.png" class="img3" width="" alt="img/per.png"></div>

                            <div class="let1"><?php echo $_SESSION["usuario"]; ?></div>
                            </div>
                            <ul class="submenu">
                                <li><a href="perfil.php">Perfil</a></li>
                                <li>
                                    <div class="let1">
                                        <form action="cerrarSesion.php" method="post">
                                            <input type="submit" name="borrar" value="Cerrar Sesión" class="bot">
                                        </form>
                                    </div>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            </div>
            <div class="cart-icon-container">
                <a href="carrito.php"> <img src="img/carrito.png" alt="Carrito" width="auto" height="40px" id="cart-icon"></a>
                <span class="cart-item-count" id="cart-item-count"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>
            </div>



        </div>
    </div>
    </div>

    <div class="titc">Productos</div>
    <div class="busc container">
        <?php
        $termino = $_POST['buscar'];

        // Consulta SQL para buscar productos que coincidan con el término
       
        $sql = "SELECT productos.*, tipos.nombre AS nombreT, marcas.nombre AS nombreM 
        FROM productos 
        INNER JOIN tipos ON productos.idTipo = tipos.idTipo
        INNER JOIN marcas ON productos.idMarca = marcas.idMarca 
        WHERE productos.nombre LIKE '%$termino%' OR marcas.nombre LIKE '%$termino%' OR tipos.nombre LIKE '%$termino%'";
        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $sql);
        
        // Generar el HTML con los resultados
        if (mysqli_num_rows($resultado) > 0) {
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($resultado)) {
                // Generar el código HTML para cada producto
                echo "<div class='col-md-2'>";
                echo "<div class='caja'>";
                echo "<form action='producto.php' id='miFormulario' method='post'>";
                echo "<button class='botp' type='submit'>";
                echo "<div><img class='imap' src='".$row["img"]."'></div>";
                echo "<div class='let-p'>";
                echo "<p>".$row["nombre"]."</p>";
                echo "</div>";
                echo '<div class="card-description">' . $row["precio"] . '€</div>';
                echo "<input type='hidden' name='idP' value='".$row["idProducto"]."'>";
                echo '<div class="rats">';
                echo '<div class="rating">';
                $valoracion1 = $row["valoracion"];


                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $valoracion1) {
                        echo "<span class='star active'>&#9733;</span>";
                    } else {
                        echo "<span class='star active'>&#9734;</span>";
                    }
                }
                echo '</div>';
                echo '</div>';
                
                
                echo "</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
          echo "No se encontraron productos que coincidan con el término de búsqueda.";
        }
        
        mysqli_close($conexion);
        ?>


    </div>


    <div class="pie">

        <div>
            <div class="titp">Redes sociales</div>
            <div class="so">
                <div><img src="img/tw.png" alt="img/tw.png" width="auto" height="25px"></div>
                <div class="letp">systemXpert</div>
            </div>
            <div class="so">
                <div><img src="img/in.webp" width="auto" height="25px" alt="img/in.webp"></div>
                <div class="letp">systemXpert</div>
            </div>
            <div class="so">
                <div><img src="img/gm.png" width="auto" height="25px" alt="img/gm.png"></div>
                <div class="letp">systemXpert</div>
            </div>
        </div>
        <div>
            <div class="titp">Contactanos</div>
            <div class="so">
                <div class="cl">Teléfono:</div>
                <div class="letp">642722601</div>
            </div>
            <div class="so">
                <div class="cl">Ubicación:</div>
                <div class="letp">Calle Ademuz, nº 30</div>
            </div>
        </div>

        <div>
            <div><img src="img/m.PNG" class="im" alt=""></div>
            <br>
            <div><img src="img/md.PNG" class="im" alt=""></div>
        </div>
    </div>



    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/app.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/menu.js"></script>

</body>

</html>