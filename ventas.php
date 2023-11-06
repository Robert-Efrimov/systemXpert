<?php
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();

if (!isset($_SESSION['admin'])) {
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
            <div><a href="indexA.php"><img src="img/logo1.PNG" class="img2" alt="img/logo1.PNG" style="margin-right: 10px;"></a> </div>
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
                                            <form action="productosAdmin.php" method="post">
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
            <img src="img/anadir.png" class="imgM" alt=""><a href="ventas.php"><p class="ser1">Ventras</p> </a>
            </div>
        </div>


        <div class="barra4">
            <div>
                <form action="buscadorA.php" method="POST">
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

                            <div class="let1p"><?php echo $_SESSION["admin"]; ?></div>
                            </div>
                            <ul class="submenu">
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
            



        </div>
    </div>

        
    <?php
 
    $sql = "SELECT * FROM ventas ";
    $productos = $conexion->query($sql);
    ?>

    <?php if ($productos->num_rows > 0) { ?>
        <div class="tabla1">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>idVenta</th>
                        <th>idProductos</th>
                        <th>idCliente</th>
                        <th>Precio</th>
                        <th>fecha</th>

                    
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $productos->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["idVenta"] ?></td>
                            <td><?php echo $row["productos"] ?></td>
                            <td><?php echo $row["idCliente"] ?></td>
                            <td><?php echo $row["precio"] ?>€</td>
                            <td><?php echo $row["fecha"] ?></td>
                            
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="tabla1">
            <p class="pcl">Todavía no hay ventas</p>
        </div>
    <?php } ?>





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