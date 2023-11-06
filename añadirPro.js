window.addEventListener("load", () => {

    const formulario3 = document.getElementById("formulario3");
    const nombre = document.getElementById("nombre");
    const tipo = document.getElementById("tipo");
    const marca = document.getElementById("marca");
    const precio = document.getElementById("precio");
    const cantidad = document.getElementById("cantidad");
    const descripcion = document.getElementById("descripcion");
    const img = document.getElementById("img");

    formulario3.addEventListener("submit", () => {
        validaCampos();

        
        
    });

    const validaCampos = () => {
       
        const nombreValor = nombre.value;
        const tipoValor = tipo.value;
        const marcaValor = marca.value;
        const precioValor = precio.value;
        const cantidadValor = cantidad.value;
        const descripcionValor = descripcion.value;
        const imgValor = img.value;


        

        if (nombreValor === "") {
            Fallo(nombre, "El nombre no puede estar vacío");
            event.preventDefault();
          } else {
            Bien(nombre);
          }
      
          if (tipoValor === "") {
            Fallo(tipo, "El tipo no puede estar vacío");
            event.preventDefault();
          } else {
            Bien(tipo);
          }
      
          if (marcaValor === "") {
            Fallo(marca, "La marca no puede estar vacía");
            event.preventDefault();
          } else {
            Bien(marca);
          }
      
          if (precioValor === "") {
            Fallo(precio, "El precio no puede estar vacío");
            event.preventDefault();
          } else {
            Bien(precio);
          }
      
          if (cantidadValor === "") {
            Fallo(cantidad, "La cantidad no puede estar vacía");
            event.preventDefault();
          } else {
            Bien(cantidad);
          }
      
          if (descripcionValor === "") {
            Fallo(descripcion, "La descripción no puede estar vacía");
            event.preventDefault();
          } else {
            Bien(descripcion);
          }
      
          if (imgValor === "") {
            Fallo(img, "La URL de la imagen no puede estar vacía");
            event.preventDefault();
          } else {
            Bien(img);
          }
    }

    const Fallo = (input, msje) => {
        const formControl = input.parentElement;
        const aviso = formControl.querySelector("small");
        aviso.innerText = msje;
        formControl.className = "form-control falla";
    }
    const Bien = (input, msje) => {
        const formControl = input.parentElement;
        formControl.className = "form-control ok";
    }


});




