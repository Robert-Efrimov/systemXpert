<?php 
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();

if (!isset($_SESSION['usuarioPro'])) {
    header('Location: iniciarSesionPro.php');
    exit();
}


if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']);
}



    if (isset($_POST["enviar"])) {
        $id = $_POST["eliminar"];

    $query = "DELETE FROM productos WHERE idProducto = $id";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        echo "Error al eliminar el registro: ";
    } else {
        header("Location: añadirPC.php");
    }
    }

?>