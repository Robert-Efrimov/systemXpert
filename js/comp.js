window.addEventListener("load", () => {
  const formulario4 = document.getElementById("formulario4");

  formulario4.addEventListener("submit", (event) => {
    if (!validaCampos()) {
      event.preventDefault();
    }
  });

  const validaCampos = () => {
    const nombre = document.getElementById("nombre");
    const tarjeta = document.getElementById("tarjeta");
    const caducidad = document.getElementById("caducidad");
    const seg = document.getElementById("seg");

    let hayErrores = false;

    if (nombre.value.length === 0 || nombre.value.length > 40) {
      Fallo(nombre, "Introduce correctamente el nombre");
      hayErrores = true;
    } else {
      Bien(nombre);
    }

    if (tarjeta.value.length !== 16) {
      Fallo(tarjeta, "Número de tarjeta inválido");
      hayErrores = true;
    } else {
      Bien(tarjeta);
    }

    if (caducidad.value.length !== 4) {
      Fallo(caducidad, "Fecha de caducidad inválida (MMYY)");
      hayErrores = true;
    } else {
      Bien(caducidad);
    }

    if (seg.value.length !== 3) {
      Fallo(seg, "Código de seguridad inválido (CVV)");
      hayErrores = true;
    } else {
      Bien(seg);
    }

    return !hayErrores;
  };

  const Fallo = (input, msje) => {
    const formControl = input.parentElement;
    const aviso = formControl.querySelector("small");
    aviso.innerText = msje;
    formControl.className = "per-form-control falla";
  };

  const Bien = (input) => {
    const formControl = input.parentElement;
    formControl.className = "per-form-control ok";
  };
});