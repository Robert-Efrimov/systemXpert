
<?php
  $conexion = mysqli_connect("localhost", "root", "", "system");

   
  mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

if(isset($_POST["enviar"])){
    $nombre=$_POST["nombre"];
    $apellidos=$_POST["apellidos"];
    $usuario=$_POST["usuario"];
    $contra=$_POST["contra"];
    $email=$_POST["email"];

    $buscarUltID = "select idCliente from clientes order by idCliente desc limit 1";

    $arrayID = mysqli_query($conexion,$buscarUltID);
    $ultimoID = mysqli_fetch_array($arrayID, MYSQLI_ASSOC);

    $nuevoID = $ultimoID["idCliente"] + 1;


    $sql ="INSERT INTO clientes(idCliente,nombre ,apellidos,usuario, email, contra) VALUES ($nuevoID,'$nombre',  '$apellidos' ,'$usuario','$email','$contra')";
        $rta=mysqli_query($conexion,$sql);
		if(!$rta){
		echo "No se insetro";
		}else{
		header("location:iniciarSesion.php");
	}
}





?>
    

