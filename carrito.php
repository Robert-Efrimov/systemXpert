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
$totalCompra = 0;
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
    <?php 
    

    ?>


<div class="car container">
    <div class="car1">
    <?php
    // Verificar si el carrito está vacío
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        
        echo '<div class="tabla1">';
        echo '<table class="custom-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Imagen</th>';
        echo '<th>Nombre</th>';
        echo '<th>Tipo</th>';
        echo '<th>Marca</th>';
        echo '<th>Precio</th>';
        
        
        
        echo '<th colspan="2">Opciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($_SESSION['cart'] as $item) {
            // Aquí puedes obtener los detalles del producto desde la base de datos

            $productId = intval($item['id']);
            
            // Obtener los detalles del producto desde la base de datos
            $sql = "SELECT productos.*, tipos.nombre AS nombreT, marcas.nombre AS nombreM FROM productos 
            INNER JOIN tipos ON productos.idTipo = tipos.idTipo
            INNER JOIN marcas ON productos.idMarca = marcas.idMarca WHERE idProducto=$productId";
             $productos = mysqli_query($conexion, $sql);

            if ($productos->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($productos)) {
                    echo '<tr>';
                    echo '<td><img src="' . $row["img"] . '" width="100px" height="auto" alt=""></td>';
                    echo '<td>' . $row["nombre"] . '</td>';
                    echo '<td>' . $row["nombreT"] . '</td>';
                    echo '<td>' . $row["nombreM"] . '</td>';
                    echo '<td>' . $row["precio"] . '€</td>';
                    
                    
                    
                    echo '<td>';
                    echo '<form action="borrarCarrito.php" method="post">';
                    echo '<input type="hidden" name="eliminar" value="' . $row["idProducto"] . '">';
                    echo '<input type="submit" name="enviar" value="Eliminar">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                    $totalCompra += $row["precio"];
                }
            }
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        
    } else {
        echo '<div class="tabla1">';
        echo '<p class="pcl">El carrito está vacío</p>';
        echo '</div>';
    }
    ?>
</div>
<div class="car2">
    <div class="pag">
    <div class="t1">Total:</div> 
    <div class="t2"><?php echo $totalCompra; ?>€</div>
    </div>
    <form action="pago.php" method="post">
    <input type="hidden" name="totalCompra" value="<?php echo $totalCompra; ?>">
    <div class="botcar1"><button type="submit" class="botcar">Pagar</button>  </div> 
    </form>
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

