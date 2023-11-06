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
                                
                                    <a href="#"><img class="imgM" src="img/menu.png" alt=""><p class="ser">Todo</p></a>
                                
                               
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
            <img src="img/anadir.png" class="imgM" alt=""><a href="añadirPC.php"><p class="ser1">Añadir producto</p> </a>
            </div>
        </div>


        <div class="barra4">
            <div>
                <form action="buscador.php" method="POST">
                    <input class="bus" name="buscar" type="search"  placeholder="Buscar">
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
                <a href="carrito.php"> <img src="img/carrito.png" alt="Carrito" width="auto" height="40px" id="cart-icon"></a>
                <span class="cart-item-count" id="cart-item-count"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>
            </div>



        </div>
    </div>
    </div>

    <div class="titc">Perfil</div>
    <div class="perf container">
        <?php
        $idUsu=$_SESSION["idUsu"];

        $sql = "SELECT * FROM clientes where idCliente=$idUsu";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $sql);

        // Generar el HTML con los resultados
        if (mysqli_num_rows($resultado) > 0) {
          
            while ($row = mysqli_fetch_assoc($resultado)) {

        ?>

                <div class="perfc1">
                   <img src="img/per.png" class="imgp3" alt="img/per.png">
                </div>

                <div class="perfc2">
                    <div class="perfc3">
                        <div class="perfl1">Nombre</div>
                        <div class="perfl2"><?php echo $row["nombre"] ?></div>
                    </div>
                    <div class="perfc3">
                        <div class="perfl1">Apellidos</div>
                        <div class="perfl2"><?php echo $row["apellidos"] ?></div>
                    </div>
                    <div class="perfc3">
                        <div class="perfl1">Usuario</div>
                        <div class="perfl2"><?php echo $row["usuario"] ?></div>
                    </div>
                    <div class="perfc3">
                        <div class="perfl1">Email</div>
                        <div class="perfl2"><?php echo $row["email"] ?></div>
                    </div>
                    <div class="perfc3">
                        <div class="perfl1">Dirección</div>
                        <?php if (!empty($row["direccion"])) { ?>
                        <div class="perfl2"><?php echo $row["direccion"] ?></div>
                    <?php } else { ?>
                        <div class="perfl2"></div>
                    <?php } ?>
                    </div>
                    <div class="perfc3">
                        <div class="perfl1">Teléfono</div>
                        <?php if (!empty($row["telefono"])) { ?>
                        <div class="perfl2"><?php echo $row["telefono"] ?></div>
                    <?php } else { ?>
                        <div class="perfl2"></div>
                    <?php } ?>
                    </div>
                    <div class="perfc4">
                        <form action="editarPerf.php" method="post">
                            <button class="botper" type="submit" name="enviar">Editar Perfil</button>
                            <input type="hidden" name="idUsu" value="<?php echo $idUsu ?>" >
                        </form>

                    </div>
                </div>
        <?php
            }
        }


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