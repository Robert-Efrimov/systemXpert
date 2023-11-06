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
echo $_SESSION["idPro"];

if(isset($_POST["enviar"])){
    $buscarUltID ="SELECT idProducto FROM productos ORDER BY idProducto DESC LIMIT 1";

	$arrayID = mysqli_query($conexion,$buscarUltID);
	$ultimoID = mysqli_fetch_array($arrayID, MYSQLI_ASSOC);
	 $nuevoID = $ultimoID["idProducto"] + 1;

     

     $pro=$_SESSION["idPro"];
     $nombre=$_POST["nombre"];
     $idTipo=$_POST["tipo"];
    $idMarca=$_POST["marca"];
     $precio=$_POST["precio"];
 $cantidad=$_POST["cantidad"];
     $descripcion=$_POST["descripcion"];
   

     $carpetaDestino = "prod/"; // Ruta específica donde deseas guardar los archivos

     $nombreArchivo = $_FILES["img"]["name"];
     $rutaArchivoTemporal = $_FILES["img"]["tmp_name"];
     $rutaArchivoDestino = $carpetaDestino . $nombreArchivo;

    if (move_uploaded_file($rutaArchivoTemporal, $rutaArchivoDestino)) {
        $sql = "INSERT INTO productos(idProducto, nombre, idTipo, idMarca, precio, cantidad, descripcion, img, idProveedor) VALUES ($nuevoID, '$nombre', $idTipo, $idMarca, $precio, $cantidad, '$descripcion', '$rutaArchivoDestino', $pro)";
        $rta = mysqli_query($conexion, $sql);

        if (!$rta) {
            echo "No se insertó";
        } else {
            header("location:añadirPC.php");
        }
    } else {
        echo "Error al mover el archivo";
    }

}



?>