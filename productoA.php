<?php
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();



if (!isset($_SESSION['admin'])) {
    header('Location: iniciarSesion.php');
    exit();
}

$id = $_POST["idP"];
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="css/menu.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/rateyo@2.3.2/dist/jquery.rateyo.min.js"></script>
    <script src="js/valoracion.js"></script>
    <script>
        function mostrarFormulario() {
            var formulario = document.getElementById("formulario");
            formulario.style.display = "block";
        }
    </script>
     <script>
    // Pasar el número de productos en el carrito de PHP a JavaScript
    const currentCartItemCount = <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>;
    window.currentCartItemCount = currentCartItemCount;
  </script>

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

    <div class="titc"> Producto</div>



    <?php
    // Obtener los productos de la base de datos
    $sql = "SELECT productos.*, tipos.nombre AS tipo, marcas.nombre AS marca FROM productos 
INNER JOIN tipos ON productos.idTipo = tipos.idTipo
INNER JOIN marcas ON productos.idMarca= marcas.idMarca
WHERE idProducto='$id'";

    $productos = $conexion->query($sql);
    // Mostrar los productos en el swiper
    if ($productos->num_rows > 0) {
        while ($row = $productos->fetch_assoc()) {
            $disponibilidadMaxima = $row["cantidad"];
            $valoracion = $row['valoracion'];
    ?>
            <div class="container prod">
                <div class="p1">
                    <div class="img1"><img class="imgp" src="<?php echo $row["img"] ?>"></div>
                </div>
                <div class="p2">
                    <div class="nomp"><?php echo $row["nombre"] ?></div>
                    <div class="pre"><?php echo $row["precio"] ?>€</div>
                    <div class="rats">
                    <div class="rating"><?php 
                     $valoracion = $row["valoracion"];

                     // Generar las estrellas rellenas según la valoración del producto
                     for ($i = 1; $i <= 5; $i++) {
                         if ($i <= $valoracion) {
                             echo "<span class='star active'>&#9733;</span>";
                         } else {
                             echo "<span class='star active'>&#9734;</span>";
                         }
                     }
                    
                    ?>
                        
                    </div>
                    </div>
                    <div class="lin">
                        <div class="tip1">Marca:</div>
                        <div class="tip2"><?php echo $row["marca"] ?></div>
                    </div>
                    <div class="lin">
                        <div class="tip1">Tipo:</div>
                        <div class="tip2"><?php echo $row["tipo"] ?></div>
                    </div>
                    <div class="lin">
                        <div class="tip1">Stock:</div>
                        <div class="tip2"><?php echo $row["cantidad"] ?></div>
                    </div>
                    
                    <div class="lin">
                        <div class="tip1">Descripción:</div>
                        <div class="tip2"><?php echo $row["descripcion"] ?></div>
                    </div>
                    <div class="lin">
                        <div class="tip1">Envio:</div>
                        <div class="tip2">Gratis</div>
                    </div>
                    <div class="lin">
                        <div class="tip1">Calidad:</div>
                        <div class="tip2">Sello de calidad</div>
                    </div>
                    <form action="productoB.php" method="post">
                    <div class="but">
                        <button type="submit" name="borrar" class="but2">Borrar</button>
                        <input type="hidden" name="idP" value="<?php echo $id ?>">
                    </div>
                    </form>
                </div>
            </div>

    <?php
        }
    }
    ?>

    

<div class="titc">Opiniones</div>
    <div class="op container">
   
    <div>
        <?php
        $sql = "SELECT o.idOpinion, o.descripcion, o.valoracion, c.usuario
FROM opiniones o
JOIN clientes c ON o.idCliente = c.idCliente WHERE idProducto='$id'";
        $productos = $conexion->query($sql);

        if ($productos->num_rows > 0) {
            // Mostrar el <div> solo si hay opiniones
            echo '<div>';
            while ($row = $productos->fetch_assoc()) {
                echo '<div class="opin">';
                echo '<div class="opi1">';
                echo '<div><img src="img/per.png"  width="70px" alt="img/per.png"></div>';
                echo '</div>';
                echo '<div class="opi2">';
                echo '<div class="ord">';
                echo '<div> ' . $row["usuario"] . ' </div>';
                echo '</div>';
                echo '<div class="rats">';
                $valoracion = $row["valoracion"];

                // Generar las estrellas rellenas según la valoración del producto
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $valoracion) {
                        echo "<span class='star active'>&#9733;</span>";
                    } else {
                        echo "<span class='star'>&#9734;</span>";
                    }
                }
                echo '</div>';
                echo '<div>Comentario: ' . $row["descripcion"] . '</div>';
                
                echo '</div>';
                echo '</div>';


            }
            echo '</div>';
        } else {
            // Mostrar un mensaje si no hay opiniones
            echo '<div class="pcl">Todavía no hay opiniones</div>';
        }
        ?>
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
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       function updateCartItemCount(count) {
    const cartItemCountElement = document.getElementById('cart-item-count');
    if (cartItemCountElement) {
        cartItemCountElement.textContent = count;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Obtener el número de productos en el carrito desde la variable global
    const currentCartItemCount = window.currentCartItemCount;
    updateCartItemCount(currentCartItemCount);

    // Obtener los botones "Añadir al carrito"
    const addToCartButtons = document.querySelectorAll('.but1');
    if (addToCartButtons) {
        addToCartButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Obtener el ID del producto a agregar
                const productId = this.getAttribute('data-product-id');

                // Enviar la solicitud AJAX para agregar el producto al carrito
                $.ajax({
                    url: 'agregarCarrito.php',
                    method: 'POST',
                    data: { id: productId},
                    success: function(response) {
                        // Actualizar el número de productos en el carrito
                        const newCartItemCount = parseInt(response);
                        updateCartItemCount(newCartItemCount);
                    },
                    error: function(xhr, status, error) {
                        // Manejar los errores de la solicitud AJAX si es necesario
                        console.error(error);
                    }
                });
            });
        });
    }
});
       
    </script>

    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
  const currentCartItemCount = <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>;
  updateCartItemCount(currentCartItemCount);
});

function updateCartItemCount(count) {
  const cartItemCountElement = document.getElementById('cart-item-count');
  if (cartItemCountElement) {
    cartItemCountElement.textContent = count;
  }
}
</script>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/app.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/menu.js"></script>
    <script src="js/cant.js"></script>


</body>

</html>