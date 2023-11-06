function updateCartItemCount(count) {
    const cartItemCountElement = document.getElementById('cart-item-count');
    if (cartItemCountElement) {
      cartItemCountElement.textContent = count;
    }
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener el número de productos en el carrito desde la variable global
    const currentCartItemCount = window.currentCartItemCount;
    updateCartItemCount(currentCartItemCount);
  
    // Obtener los botones "Añadir al carrito"
    const addToCartButtons = document.querySelectorAll('.but1');
    if (addToCartButtons.length > 0) {
      addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          // Obtener el ID del producto a agregar
          const productId = this.getAttribute('data-product-id');
  
          // Enviar la solicitud AJAX para agregar el producto al carrito
          $.ajax({
            url: 'agregarCarrito.php',
            method: 'POST',
            data: { id: productId },
            success: function(response) {
              // Actualizar el número de productos en el carrito
              const newCartItemCount = parseInt(response);
              updateCartItemCount(newCartItemCount);
            },
            error: function(xhr, status, error) {
              // Manejar los errores de la solicitud AJAX si es necesario
              console.error(error);
            }
          });
        });
      });
    }
  });