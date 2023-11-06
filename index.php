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
        <div>
            <a href="index.php">
                <img src="img/logo1.PNG" class="img2" alt="img/logo1.PNG" style="margin-right: 10px;">
            </a>
        </div>
        <div>
            <div class="mnav">
                <nav>
                    <ul class="menu">
                        <li class="dropdown">
                            
                                <div class="med">
                                <img class="imgM" src="img/menu.png" alt="">
                            <a href="#">
                                <div class="ser">Todo</div>
                            </a>
                            </div>
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
            <div class="med">
            <img src="img/anadir.png" class="imgM" alt="">
            <a href="añadirPC.php">
              <div class="ser1">Añadir producto</div> 
            </a>
            </div>
        </div>
    </div>
    <div class="barra4">
        <div>
            <form action="buscador.php" method="POST">
                <input class="bus" name="buscar" type="search" placeholder="Buscar">
            </form>
        </div>
    </div>
    <div></div>
    <div class="barra3">
        <div class="mm">
            <div class="mnav">
                <nav>
                    <ul class="menu">
                        <li class="dropdown">
                            <div class="df">
                                <div>
                                    <img src="img/per.png" class="img3" width="" alt="img/per.png">
                                </div>
                                <div class="let1p"><?php echo $_SESSION["usuario"]; ?></div>
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
            <a href="carrito.php">
                <img src="img/carrito.png" alt="Carrito" width="auto" height="40px" id="cart-icon">
            </a>
            <span class="cart-item-count" id="cart-item-count"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>
        </div>
    </div>
</div>
    

    <div class="ban"></div>



    <div class="titc">Carcasas</div>



    <div class="cuerpo">

        <div class="cont">

            <div class="swiper">

                <div class="swiper-wrapper">


                    <?php

                    // Obtener los productos de la base de datos
                    $sql = "SELECT * FROM productos where idTipo=14";
                    $productos = $conexion->query($sql);
                    // Mostrar los productos en el swiper
                    if ($productos->num_rows > 0) {
                        while ($row = $productos->fetch_assoc()) {

                            echo '<div class="swiper-slide">';
                            echo '<form action="producto.php"  method="post">';

                            echo '<button class="botp" type="submit">';
                            echo '<div class="ima"><img  src="' . $row["img"] . '"></div>';
                            echo '<div class="card-title"><p>' . $row["nombre"] . '</p></div>';
                            echo '<div class="card-description">' . $row["precio"] . '€</div>';
                            echo '<div><input type="hidden" name="idP" value="' . $row["idProducto"] . '"></div>';
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
                            echo '</button>';
                            echo '</form>';

                            echo '</div>';
                        }
                    }

                    ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>


    </div>




    <div class="titc">Marcas</div>
    <div class="cuerpo2">

        <div class="cont2">

            <div class="swiper">

                <div class="swiper-wrapper">

                    <?php

                    // Obtener los productos de la base de datos
                    $sql = "SELECT * FROM marcas";
                    $productos = $conexion->query($sql);

                    // Mostrar los productos en el swiper
                    if ($productos->num_rows > 0) {
                        while ($row = $productos->fetch_assoc()) {
                            echo '<div class="swiper-slide">';
                            echo '<form action="marca.php" id="miFormulario" method="post">';

                            echo '<button class="botp" type="submit">';
                            echo '<div><input type="hidden" name="idM" value="' . $row["idMarca"] . '"></div>';
                            echo '<div class="ima"><img  src="' . $row["imagen"] . ' "></div>';

                            echo '</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                    }

                    ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>


    </div>



    <div class="titc">Ratones</div>
    <div class="cuerpo6">


        <div class="cont6">

            <div class="swiper">

                <div class="swiper-wrapper">

                    <?php

                    // Obtener los productos de la base de datos
                    $sql5 = "SELECT * FROM productos where idTipo=5";
                    $productos5 = $conexion->query($sql5);

                    // Mostrar los productos en el swiper
                    if ($productos5->num_rows > 0) {
                        while ($row = $productos5->fetch_assoc()) {
                            echo '<div class="swiper-slide">';
                            echo '<form action="producto.php" id="miFormulario" method="post">';

                            echo '<button class="botp" type="submit">';
                            echo '<div class="ima"><img  src="' . $row["img"] . '"></div>';
                            echo '<div class="card-title"><p>' . $row["nombre"] . '</p></div>';
                            echo '<div class="card-description">' . $row["precio"] . '€</div>';
                            echo '<div><input type="hidden" name="idP" value="' . $row["idProducto"] . '"></div>';
                            echo '<div class="rats">';
                            echo '<div class="rating">';
                            $valoracion = $row["valoracion"];

                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $valoracion) {
                                    echo "<span class='star active'>&#9733;</span>";
                                } else {
                                    echo "<span class='star active'>&#9734;</span>";
                                }
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</button>';
                            echo '</form>';
                        }
                    }

                    ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>


    </div>

    <div class="ban2"></div>




    <div class="titc"> Gráficas</div>
    <div class="cuerpo3">

        <div class="cont3">

            <div class="swiper">

                <div class="swiper-wrapper">

                    <?php

                    // Obtener los productos de la base de datos
                    $sql2 = "SELECT * FROM productos where idTipo=3";
                    $productos2 = $conexion->query($sql2);

                    // Mostrar los productos en el swiper
                    if ($productos2->num_rows > 0) {
                        while ($row = $productos2->fetch_assoc()) {
                            echo '<div class="swiper-slide">';
                            echo '<form action="producto.php" id="miFormulario" method="post">';

                            echo '<button class="botp" type="submit">';
                            echo '<div class="ima"><img  src="' . $row["img"] . '"></div>';
                            echo '<div class="card-title"><p>' . $row["nombre"] . '</p></div>';
                            echo '<div class="card-description">' . $row["precio"] . '€</div>';
                            echo '<div><input type="hidden" name="idP" value="' . $row["idProducto"] . '"></div>';
                            echo '<div class="rats">';
                            echo '<div class="rating">';
                            $valoracion3 = $row["valoracion"];

                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $valoracion3) {
                                    echo "<span class='star active'>&#9733;</span>";
                                } else {
                                    echo "<span class='star active'>&#9734;</span>";
                                }
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</button>';
                            echo '</form>';
                        }
                    }

                    ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>


    </div>


    <div class="titc"> Procesadores</div>
    <div class="cuerpo4">

        <div class="cont4">

            <div class="swiper">

                <div class="swiper-wrapper">

                    <?php

                    // Obtener los productos de la base de datos
                    $sql3 = "SELECT * FROM productos where idTipo=2";
                    $productos3 = $conexion->query($sql3);

                    // Mostrar los productos en el swiper
                    if ($productos3->num_rows > 0) {
                        while ($row = $productos3->fetch_assoc()) {
                            echo '<div class="swiper-slide">';
                            echo '<form action="producto.php" id="miFormulario" method="post">';

                            echo '<button class="botp" type="submit">';
                            echo '<div class="ima"><img  src="' . $row["img"] . '"></div>';
                            echo '<div class="card-title"><p>' . $row["nombre"] . '</p></div>';
                            echo '<div class="card-description">' . $row["precio"] . '€</div>';
                            echo '<div><input type="hidden" name="idP" value="' . $row["idProducto"] . '"></div>';
                            echo '<div class="rats">';
                            echo '<div class="rating">';
                            $valoracion4 = $row["valoracion"];

                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $valoracion4) {
                                    echo "<span class='star active'>&#9733;</span>";
                                } else {
                                    echo "<span class='star active'>&#9734;</span>";
                                }
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</button>';
                            echo '</form>';
                        }
                    }

                    ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>


    </div>


    <div class="titc"> Ventilación</div>
    <div class="cuerpo5">

        <div class="cont5">

            <div class="swiper">

                <div class="swiper-wrapper">

                    <?php

                    // Obtener los productos de la base de datos
                    $sql4 = "SELECT * FROM productos where idTipo=4";
                    $productos4 = $conexion->query($sql4);

                    // Mostrar los productos en el swiper
                    if ($productos4->num_rows > 0) {
                        while ($row = $productos4->fetch_assoc()) {
                            echo '<div class="swiper-slide">';
                            echo '<form action="producto.php" id="miFormulario" method="post">';

                            echo '<button class="botp" type="submit">';
                            echo '<div class="ima"><img  src="' . $row["img"] . '"></div>';
                            echo '<div class="card-title"><p>' . $row["nombre"] . '</p></div>';
                            echo '<div class="card-description">' . $row["precio"] . '€</div>';
                            echo '<div><input type="hidden" name="idP" value="' . $row["idProducto"] . '"></div>';
                            echo '<div class="rats">';
                            echo '<div class="rating">';
                            $valoracion3 = $row["valoracion"];

                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $valoracion3) {
                                    echo "<span class='star active'>&#9733;</span>";
                                } else {
                                    echo "<span class='star active'>&#9734;</span>";
                                }
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</button>';
                            echo '</form>';
                        }
                    }

                    ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>


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