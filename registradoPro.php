
<?php
  $conexion = mysqli_connect("localhost", "root", "", "system");

   
  mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

if(isset($_POST["enviar"])){
    $nombre=$_POST["nombre"];
    $usuario=$_POST["usuario"];
    $contra=$_POST["contra"];
    $email=$_POST["email"];
    $direccion=$_POST["direccion"];
    $telefono=$_POST["telefono"];

    $buscarUltID = "select idProveedor from proveedores order by idProveedor desc limit 1";

	$arrayID = mysqli_query($conexion,$buscarUltID);
	$ultimoID = mysqli_fetch_array($arrayID, MYSQLI_ASSOC);

	$nuevoID = $ultimoID["idProveedor"] + 1;

    $sql ="INSERT INTO proveedores(idProveedor,nombre ,usuario, email, contra, direccion, telefono) VALUES ($nuevoID,'$nombre','$usuario','$email','$contra','$direccion','$telefono')";
        $rta=mysqli_query($conexion,$sql);
		if(!$rta){
		echo "No se insetro";
		}else{
		header("location:iniciarSesionPro.php");
	}
}





?>
    

