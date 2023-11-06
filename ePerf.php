<?php
$conexion = mysqli_connect("localhost", "root", "", "system");


mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

session_start();


if (isset($_SESSION['usuarioPro'])) {
    unset($_SESSION['usuarioPro']);
}

if (!isset($_SESSION['usuario'])) {
    header('Location: iniciarSesionPro.php');
    exit();
}


    if (isset($_POST["enviar"])) {
        $id = $_POST["idUs"];
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : null;
        $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
        $tele = isset($_POST["tele"]) ? $_POST["tele"] : null;
        $dir = isset($_POST["dir"]) ? $_POST["dir"] : null;
        

        // Obtener los valores actuales de los campos no proporcionados en el formulario
        $query = "SELECT * FROM clientes WHERE idCliente = $id";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);

        // Asignar los valores actuales si no se proporcionaron en el formulario
        if (empty($nombre)) {
            $nombre = $row['nombre'];
        }

        if (empty($apellidos)) {
            $apellidos = $row['apellidos'];
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


        $query = "UPDATE clientes SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', telefono = '$tele', direccion = '$dir' WHERE idCliente = $id";
        $resultado = mysqli_query($conexion, $query);

        if (!$resultado) {
            echo "Error al actualizar el registro: ";
        } else {
            header("Location: perfil.php");
            
        }
    }
    ?>