document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.querySelector('.decrease');
    const increaseBtn = document.querySelector('.increase');
    const quantitySpan = document.querySelector('.quantity');
    let quantity = 1;
  
    decreaseBtn.addEventListener('click', function() {
      if (quantity > 1) {
        quantity--;
        quantitySpan.textContent = quantity;
      }
    });
  
    increaseBtn.addEventListener('click', function() {
      if (quantity < disponibilidadMaxima) {
        quantity++;
        quantitySpan.textContent = quantity;
      }
    });
  });