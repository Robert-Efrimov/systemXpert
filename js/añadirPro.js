window.addEventListener("load", () => {
    const formulario3= document.getElementById("formulario3");
    const nombre = document.getElementById("nombre");
    const precio = document.getElementById("precio");
    const cantidad = document.getElementById("cantidad");
    const descripcion = document.getElementById("descripcion");
    const img = document.getElementById("img");
  
    formulario3.addEventListener("submit", (event) => {
      validaCampos(event);
    });
  
    const validaCampos = (event) => {
      const nombreValor = nombre.value.trim();
      const precioValor = precio.value.trim();
      const cantidadValor = cantidad.value.trim();
      const descripcionValor = descripcion.value.trim();
      const imgValor = img.value.trim();
  
      if (nombreValor.length === 0) {
        Fallo(nombre, "El nombre no puede estar vacío");
        event.preventDefault();
      } else if (nombreValor.length > 100) {
        Fallo(nombre, "El nombre debe tener como máximo 100 caracteres");
        event.preventDefault();
      }  else {
        Bien(nombre);
      }
  
      if (precioValor.length === 0) {
        Fallo(precio, "El precio no puede estar vacío");
        event.preventDefault();
      } else if (precioValor.length > 8) {
        Fallo(precio, "El precio no puede tener más de 10 números");
        event.preventDefault();
      } else {
        Bien(precio);
      }
  
      if (cantidadValor.length === 0) {
        Fallo(cantidad, "La cantidad no puede estar vacía");
        event.preventDefault();
      } else {
        Bien(cantidad);
      }
  
      if (descripcionValor.length === 0) {
        Fallo(descripcion, "La descripción no puede estar vacía");
        event.preventDefault();
      }else if (descripcionValor.length > 250) {
        Fallo(descripcion, "La descripción debe tener como máximo 250 caracteres");
        event.preventDefault();
      } else {
        Bien(descripcion);
      }
  
      if (imgValor.length === 0) {
        Fallo(img, "La imagen debe ser jpg o png y no puede estar vacia");
        event.preventDefault();
      } else {
        Bien(img);
      }
    };
  
    const Fallo = (input, msje) => {
      const formControl = input.parentElement;
      const aviso = formControl.querySelector("small");
      aviso.innerText = msje;
      formControl.className = "per-form-control falla";
    };
  
    const Bien = (input, msje) => {
      const formControl = input.parentElement;
      formControl.className = "per-form-control ok";
    };
  });