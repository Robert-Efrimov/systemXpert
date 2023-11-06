window.addEventListener("load", () => {

    const formulario = document.getElementById("formulario");
    const tipo = document.getElementById("tipo");
    const aula = document.getElementById("aula");
    const curso = document.getElementById("curso");
    const fecha = document.getElementById("fecha");
    const des = document.getElementById("des");
    

    formulario.addEventListener("submit", () => {
        validaCampos();

        
        
    });

    const validaCampos = () => {
       
        const tipoValor = tipo.value;
        const aulaValor = aula.value;
        const cursoValor = curso.value;
        const fechaValor = fecha.value;
        const descripcionValor = des.value;
        

        if (tipoValor == null || tipoValor == 0) {
            Fallo(tipo, "Elige un tipo");
            event.preventDefault();
        } 

        if (aulaValor == null || aulaValor == 0) {
            Fallo(aula, "Elige un aula");
            event.preventDefault();
        } 
        if (cursoValor == null || cursoValor == 0) {
            Fallo(curso, "Elige un curso");
            event.preventDefault();
        } 
        if (fechaValor == null || fechaValor == 0) {
            Fallo(fecha, "Elige la fecha de la incidencia");
            event.preventDefault();
        } 

        if (descripcionValor.length==0 || descripcionValor.length>200) {
            Fallo(des, "El texto no puede estar vacio y no puede ocupar más de 200 carácteres");
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
