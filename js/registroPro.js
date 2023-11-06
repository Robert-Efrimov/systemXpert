window.addEventListener("load", () => {

    const formulario2 = document.getElementById("formulario2");
    const nombre = document.getElementById("nombre");
    const usuario = document.getElementById("usuario");
    const email = document.getElementById("email");
    const contra = document.getElementById("contra");
    const direccion = document.getElementById("direccion");
    const telefono = document.getElementById("telefono");

    formulario2.addEventListener("submit", () => {
        validaCampos();

        
        
    });

    const validaCampos = () => {
       
        const nombreValor = nombre.value;
        const direccionValor = direccion.value;
        const telefonoValor = telefono.value;
        const usuarioValor = usuario.value;
        const emailValor = email.value;
        const contraValor = contra.value;


        var validarNombre =  /^[a-zA-Z]+$/;
        var validarEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        var telefonoRegex = /^\d{9}$/;

        if (nombreValor.length == 0 || nombreValor.length> 20 || validarNombre.test(nombreValor) == false) {
            Fallo(nombre, "Introduce correctamente el nombre");
            event.preventDefault();
        } else {
            Bien(nombre);
        }

        if (usuarioValor.length == 0 || usuarioValor.length > 20) {
            Fallo(usuario, "Escriba correctamente el usuario");
            event.preventDefault();
        } else {
            Bien(usuario);
        }

        if (direccionValor.length == 0 || direccionValor.length > 40) {
            Fallo(direccion, "Escriba correctamente la dirección");
            event.preventDefault();
        } else {
            Bien(direccion);
        }
        if (telefonoValor.length !== 9 || !telefonoRegex.test(telefonoValor)) {
            Fallo(telefono, "Escriba correctamente el télefono");
            event.preventDefault();
        } else {
            Bien(telefono);
        }

        if (contraValor.length < 6) {
            Fallo(contra, "La contraseña debe tener al menos 6 caracteres");
            event.preventDefault();
        } else if (!/[A-Z]/.test(contraValor)) {
            Fallo(contra, "La contraseña debe incluir al menos una letra mayúscula");
            event.preventDefault();
        } else if (!/\d/.test(contraValor)) {
            Fallo(contra, "La contraseña debe incluir al menos un número");
            event.preventDefault();
        } else {
            Bien(contra);
        }

        if (emailValor.length == 0 || validarEmail.test(emailValor) == false) {
            Fallo(email, "Escriba correctamente el email");
            event.preventDefault();
            
        } else {
            Bien(email);
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




