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


    if (isset($_POST["enviar"])) {
        $id = $_POST["idPro"];
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
        $tele = isset($_POST["tele"]) ? $_POST["tele"] : null;
        $dir = isset($_POST["dir"]) ? $_POST["dir"] : null;
        

        // Obtener los valores actuales de los campos no proporcionados en el formulario
        $query = "SELECT * FROM proveedores WHERE idProveedor = $id";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);

        // Asignar los valores actuales si no se proporcionaron en el formulario
        if (empty($nombre)) {
            $nombre = $row['nombre'];
        }

        if (empty($usuario)) {
            $usuario = $row['usuario'];
        }

        if (empty($tele)) {
            $tele = $row['telefono'];
        }

        if (empty($dir)) {
            $dir = $row['direccion'];
        }


        $query = "UPDATE proveedores SET nombre = '$nombre', usuario = '$usuario', telefono = '$tele', direccion = '$dir' WHERE idProveedor = $id";
        $resultado = mysqli_query($conexion, $query);

        if (!$resultado) {
            echo "Error al actualizar el registro: ";
        } else {
            header("Location: perfilPro.php");
            
        }
    }
    ?>