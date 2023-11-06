<?php
$conexion = mysqli_connect("localhost", "root", "", "system");
mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");



$idTipo = $_POST["idTipo"];
$idMarca = $_POST["idMarca"];
$precioMin = $_POST["precioMin"];
$precioMax = $_POST["precioMax"];

// Consulta SQL para filtrar los productos por tipo y marca
$sql = "SELECT * FROM productos WHERE idTipo = $idTipo";

if ($idMarca == 'todo') {
    $sql = "SELECT * FROM productos WHERE idTipo = $idTipo";
}

if ($idMarca != 'todo') {
    $sql .= " AND idMarca = $idMarca";
}

$sql .= " AND precio >= $precioMin AND precio <= $precioMax ORDER BY precio ASC";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Generar el HTML con los resultados
if (mysqli_num_rows($resultado) > 0) {
    echo "<div class='row'>";
    while ($row = mysqli_fetch_assoc($resultado)) {
        // Generar el código HTML para cada producto
        echo "<div class='col-md-2'>";
        echo "<div class='caja2'>";
        echo "<form action='productoA.php' id='miFormulario' method='post'>";
        echo "<button class='botp' type='submit'>";
        echo "<div><img class='imap' src='".$row["img"]."'></div>";
        echo "<div class='let-p'>";
        echo "<p>".$row["nombre"]."</p>";
        echo "</div>";
      
        echo "<div class='card-description'>".$row["precio"]."€</div>";
       
        echo "<input type='hidden' name='idP' value='".$row["idProducto"]."'>";
       
        
        echo '<div class="rats">';
        echo '<div class="rating">';
        $valoracion3 = $row["valoracion"];

 for ($i = 1; $i <= 5; $i++) {
     if ($i <= $valoracion3) {
         echo "<span class='star active'>&#9733;</span>";
     } else {
         echo "<span class='star active'>&#9734;</span>";
     }
 }

      echo '</div>';
      echo '</div>';
        
      
      
        echo "</button>";
        echo "<div class='botA1'><button class='botA' type='submit' name='borrar' >Borrar</button></div>";
        echo "</form>";
        echo "</div>";
        
        echo "</div>";
    }
    echo "</div>";
} else {
    echo '<p>No se encontraron productos.</p>';
}

?>