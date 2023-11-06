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
    if (isset($_POST["enviar"])) {
        $id = $_POST["id"];
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $idTipo = isset($_POST["tipo"]) ? $_POST["tipo"] : null;
        $idMarca = isset($_POST["marca"]) ? $_POST["marca"] : null;
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : null;
        $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : null;
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;

        // Obtener los valores actuales de los campos no proporcionados en el formulario
        $query = "SELECT nombre, idTipo, idMarca, precio, cantidad, descripcion, img FROM productos WHERE idProducto = $id";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);

        $carpetaDestino = "prod/"; // Ruta específica donde deseas guardar los archivos

     $nombreArchivo = $_FILES["img"]["name"];
     $rutaArchivoTemporal = $_FILES["img"]["tmp_name"];
     $rutaArchivoDestino = $carpetaDestino . $nombreArchivo;

        // Asignar los valores actuales si no se proporcionaron en el formulario
        if (empty($nombre)) {
            $nombre = $row['nombre'];
        }

        if (empty($idTipo)) {
            $idTipo = $row['idTipo'];
        }

        if (empty($idMarca)) {
            $idMarca = $row['idMarca'];
        }

        if (empty($precio)) {
            $precio = $row['precio'];
        }

        if (empty($cantidad)) {
            $cantidad = $row['cantidad'];
        }

        if (empty($descripcion)) {
            $descripcion = $row['descripcion'];
        }
        if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES["img"]["name"];
            $rutaArchivoTemporal = $_FILES["img"]["tmp_name"];
            $rutaArchivoDestino = $carpetaDestino . $nombreArchivo;
            
            // Mueve el archivo temporal a la ubicación de destino
            move_uploaded_file($rutaArchivoTemporal, $rutaArchivoDestino);
        } else {
            // No se seleccionó ningún archivo, mantén la ruta actual
            $rutaArchivoDestino = $row['img'];
        }

        $query = "UPDATE productos SET nombre = '$nombre', idTipo = '$idTipo', idMarca = '$idMarca', precio = '$precio', cantidad = '$cantidad', descripcion = '$descripcion', img='$rutaArchivoDestino' WHERE idProducto = $id";
        $resultado = mysqli_query($conexion, $query);

        if (!$resultado) {
            echo "Error al actualizar el registro: ";
        } else {
            header("Location: añadirPC.php");
            
        }
    }
    ?>