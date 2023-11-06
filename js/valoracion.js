$(function () {
    var rating = <?php echo $calificacion; ?>; // Obtén la calificación de tu base de datos
    $("#rating").rateYo({
      rating: rating,
      readOnly: true, // Para evitar que los usuarios cambien la calificación
      starWidth: "20px", // Personaliza el tamaño de las estrellas según tus necesidades
      ratedFill: "#ffc107" // Personaliza el color de las estrellas seleccionadas
    });
  });