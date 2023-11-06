<?php
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();


if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']);
}

if (!isset($_SESSION['usuarioPro'])) {
    header('Location: iniciarSesionPro.php');
    exit();
}
$cambiar = $_POST["cambiar"];


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
            <div><a href="añadirPC.php"><img src="img/logo1.PNG" class="img22" alt="img/logo1.PNG" style="margin-right: 10px;"></a> </div>
            <div class="barra6">
            <a href="index.php"><img src="img/comp.png" class="imgM2"><p class="ser">Comprar</p></a>

            </div>
            <div class="barra5">
                <a href="añadirPC.php"><img src="img/anadir.png" class="imgM2" ><p class="ser1">Añadir producto</p></a>
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

                            <div class="let1p"><?php echo $_SESSION["usuarioPro"]; ?></div>
                            </div>
                            <ul class="submenu">
                                <li><a href="perfilPro.php">Perfil</a></li>
                                <li>
                                    <div class="let1">
                                        <form action="cerrarSesionPro.php" method="post">
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
    

    ?>


    <div class="añadirP container">
        <div class="añT">Editar tu producto</div>
        <form action="eProdProv.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $cambiar ?>">
            <div class="añN">Nombre del producto</div>
            <input type="text" name="nombre" class="añI">

            <div class="añN">Tipo</div>
            <select name="tipo" id="">

                <?php
                $sql = "select * from tipos";
                $productos = $conexion->query($sql);
                // Mostrar los productos en el swiper
                if ($productos->num_rows > 0) {
                    while ($row = $productos->fetch_assoc()) {
                ?>

                        <option class="añIS" value="<?php echo $row["idTipo"] ?>"><?php echo $row["nombre"] ?></option>

                <?php
                    }
                }

                ?>

            </select>


            <div class="añN">Marca</div>
            <select name="marca" id="">

                <?php
                $sql = "select * from marcas";
                $productos = $conexion->query($sql);
                // Mostrar los productos en el swiper
                if ($productos->num_rows > 0) {
                    while ($row = $productos->fetch_assoc()) {
                ?>
                        <option value="<?php echo $row["idMarca"] ?>"><?php echo $row["nombre"] ?></option>;
                <?php
                    }
                }

                ?>

            </select>

            <div class="añN">Precio</div>
            <input type="number" name="precio" class="añI">

            <div class="añN">Cantidad</div>
            <input type="number" name="cantidad" class="añI">

            <div class="añN">Descripción</div>
            <textarea rows="4" name="descripcion" cols="40"></textarea>

            <div class="añN">Imagén</div>
            <input type="file" name="img" accept=".png, .jpeg">

            <div class="añB1"><button class="añB" type="submit" name="enviar">Enviar</button></div>
        </form>

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

