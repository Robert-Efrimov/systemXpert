<?php
session_start();
if(isset($_POST["borrar"])){
    if(isset($_SESSION["usuario"])){
        unset($_SESSION["usuario"]);
    
      }

}
if(isset($_POST["borrar"])){
  if(isset($_SESSION["admin"])){
      unset($_SESSION["admin"]);
  
    }

}
if (!isset($_SESSION['usuario'])) {
    header('Location: iniciarSesion.php');
    exit();
  }
  if (!isset($_SESSION['admin'])) {
    header('Location: iniciarSesion.php');
    exit();
  }

?>