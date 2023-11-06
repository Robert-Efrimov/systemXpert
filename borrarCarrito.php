<?php 
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: iniciarSesion.php');
    exit();
}



if (isset($_POST['eliminar'])) {
    $productoId = $_POST['eliminar'];

    // Busca el producto en el carrito
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $productoId) {
            // Elimina el producto del carrito
            unset($_SESSION['cart'][$index]);
            break;
        }
    }
}

header('Location: carrito.php'); 
exit();

?>