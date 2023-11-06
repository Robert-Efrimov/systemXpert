<?php
    $conexion = mysqli_connect("localhost", "root", "", "system");

   
    mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");
 
    session_start();

    
    

    if(isset($_POST["enviar"])){

   
    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];
    
    
      $consulta = "SELECT * FROM proveedores WHERE usuario='$usuario' AND contra='$contra'";
      $resultado = $conexion->query($consulta);

      if ($resultado->num_rows ===1) {
        // output data of each row
        while($row = $resultado->fetch_assoc()) {
        
        // nombre de usuario y contraseña válidos
        $_SESSION['usuarioPro'] = $usuario;
        $_SESSION['idPro'] = $row["idProveedor"];
        header('Location:añadirPC.php');
        exit();
      } 
    }
    
      $consulta2 = "SELECT * FROM admin WHERE usuario='$usuario' AND contra='$contra'";
    $resultado2 = $conexion->query($consulta2);
    if ($resultado2->num_rows ===1) {
      // output data of each row
      while($row = $resultado2->fetch_assoc()) {
      $_SESSION['admin'] = $usuario;
      $_SESSION['id'] = $row["id"];
    header('Location:indexA.php');
    exit();
      }}
        header('Location:iniciarSesionPro.php');
    }


    

    ?>