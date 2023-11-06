window.addEventListener("load", () => {

    const formulario = document.getElementById("formulario");
    const usuario = document.getElementById("usuario");
    const contra = document.getElementById("contra");
    

    formulario.addEventListener("submit", () => {
        validaCampos();

        
        
    });

    const validaCampos = () => {
       
        const usuarioValor = usuario.value;
        const contraValor = contra.value;
        
        

        if (usuarioValor == null || usuarioValor == 0) {
            Fallo(usuario, "Escribe bien tu usuario");
            event.preventDefault();
        }

        if (contraValor == null || contraValor == 0) {
            Fallo(contra, "Contraseña incorrecta");
            event.preventDefault();
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
