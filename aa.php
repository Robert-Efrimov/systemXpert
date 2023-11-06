<?php
$conexion = mysqli_connect("localhost", "root", "", "system");
mysqli_select_db($conexion, "system") or die("No se puede seleccionar la BD");

// Obtener el término de búsqueda ingresado por el usuario
$termino = $_POST['buscar'];

// Consulta SQL para buscar productos que coincidan con el término
$sql = "SELECT * FROM productos WHERE nombre LIKE '%$termino%'";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Generar el HTML con los resultados
if (mysqli_num_rows($resultado) > 0) {
    echo "<div class='row'>";
    while ($row = mysqli_fetch_assoc($resultado)) {
        // Generar el código HTML para cada producto
        echo "<div class='col-md-2'>";
        echo "<div class='caja'>";
        echo "<form action='producto.php' id='miFormulario' method='post'>";
        echo "<button class='botp' type='submit'>";
        echo "<div><img class='imap' src='".$row["img"]."'></div>";
        echo "<div class='let-p'>";
        echo "<p>".$row["nombre"]."</p>";
        echo "</div>";
        echo "<div class=''>";
        echo "<p>".$row["precio"]."€</p>";
        echo "</div>";
        echo "<input type='hidden' name='idP' value='".$row["idProducto"]."'>";
        echo "<div class='rating'>";
        
        $valoracion = $row["valoracion"];

        // Generar las estrellas rellenas según la valoración del producto
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $valoracion) {
                echo "<span class='star'>&#9733;</span>";
            } else {
                echo "<span class='star'>&#9734;</span>";
            }
        }
        
        echo "</div>";
        echo "</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
  echo "No se encontraron productos que coincidan con el término de búsqueda.";
}

mysqli_close($conexion);
?>