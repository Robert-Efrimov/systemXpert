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


// Obtener los detalles de venta del formulario
if(isset($_POST["enviar"])){
$totalCompra = $_POST['totalCompra'];
$usuarioId = $_SESSION['idUsu'];

// Obtener el ID de la venta recién insertada
$fechaActual = date('Y-m-d');

// Crear un array para almacenar los productos vendidos
$productosVendidos = $_SESSION['cart'];

// Construir una cadena de texto con los datos de los productos
$productosTexto = '';
foreach ($productosVendidos as $producto) {
    $productId = intval($producto['id']);
    $productosTexto .= "$productId, ";
}

// Eliminar la última coma y espacio de la cadena de texto
$productosTexto = rtrim($productosTexto, ', ');

// Escapar caracteres especiales en la cadena de texto
$productosTexto = mysqli_real_escape_string($conexion, $productosTexto);

// Construir la consulta SQL para insertar los productos vendidos en la tabla de ventas
$sql = "INSERT INTO ventas (productos, idCliente, precio, fecha) VALUES ('$productosTexto', $usuarioId, $totalCompra, '$fechaActual')";

// Ejecutar la consulta SQL
if (mysqli_query($conexion, $sql)) {
    // Vaciar el carrito después de realizar la venta
    unset($_SESSION['cart']);
    $_SESSION['cart_count'] = 0;

    // Redirigir al usuario a una página de confirmación de venta
    header('Location: ventaReal.php');
    exit();
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
}
