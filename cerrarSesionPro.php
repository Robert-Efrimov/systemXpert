<?php
session_start();
if(isset($_POST["borrar"])){
    if(isset($_SESSION["usuarioPro"])){
        unset($_SESSION["usuarioPro"]);
      }

}

if (!isset($_SESSION['usuarioPro'])) {
    header('Location: index.php');
    exit();
  }
 

?>