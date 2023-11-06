window.addEventListener("load", () => {

    const formulario = document.getElementById("formulario");
    const nombre = document.getElementById("nombre");
    const apellidos = document.getElementById("apellidos");
    
    const usuario = document.getElementById("usuario");
    const email = document.getElementById("email");
    const contra = document.getElementById("contra");

    formulario.addEventListener("submit", () => {
        validaCampos();

        
        
    });

    const validaCampos = () => {
       
        const nombreValor = nombre.value;
        const apellidoValor = apellidos.value;
        const usuarioValor = usuario.value;
        const emailValor = email.value;
        const contraValor = contra.value;


        var validarNombre =  /^[a-zA-Z]+$/;
        var validarEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
       
        var validarApellidos=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

        if (nombreValor.length == 0 || nombreValor.length> 20 || validarNombre.test(nombreValor) == false) {
            Fallo(nombre, "Introduce correctamente el nombre");
            event.preventDefault();
        } else {
            Bien(nombre);
        }

        if (validarApellidos.test(apellidoValor) == false || apellidoValor.length > 30) {
            Fallo(apellidos, "Introduce correctamente los apellidos");
            event.preventDefault();
        } else {
            Bien(apellidos);
        }
        if (usuarioValor.length == 0 || usuarioValor.length > 20) {
            Fallo(usuario, "Escriba correctamente el usuario");
            event.preventDefault();
        } else {
            Bien(usuario);
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




