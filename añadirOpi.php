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

    if (isset($_POST["enviar"])) {
        $valoracion = $_POST['valoracion'];
       $idCli =$_SESSION["idUsu"];
        $idPro = $_POST["idPro"];
        $comentario =$_POST["comentario"];

    
        $query = "INSERT into opiniones ( descripcion,idCliente, idProducto, valoracion) VALUES ('$comentario', $idCli, $idPro,$valoracion)";
        $resultado = mysqli_query($conexion, $query);

        if (!$resultado) {
            echo "Error al actualizar el registro: ";
        } else {
            
        header("Location: index.php");
        }
    }
    ?>
