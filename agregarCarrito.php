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


if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    
    $productId = intval($productId);
    

    // Agregar el ID del producto y la cantidad al array del carrito
    $_SESSION['cart'][] = array(
        'id' => $productId,
        
    );

    $_SESSION['cart_count'] = count($_SESSION['cart']);
    // Obtener el número actual de productos en el carrito
    $cartItemCount = count($_SESSION['cart']);
    
    // Enviar el número de productos en el carrito como respuesta
    echo $cartItemCount;
} else {
    // Enviar una respuesta de error al cliente si no se proporciona el ID del producto o la cantidad
    echo "Error: No se proporcionó el ID del producto o la cantidad.";
}
?>