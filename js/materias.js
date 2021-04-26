var formulario = document.getElementById("materias");

formulario.codigo.addEventListener("keypress",function(e){


    if (!soloNumeros(event)){
        e.preventDefault();

    }
})
function soloNumeros(e){
    var key = e.charCode;
   
    return key >= 48 && key <= 57;
}


formulario.addEventListener("submit", function(e){


    e.preventDefault();

    var datos = new FormData(formulario);

    if(datos.get("grado")!="0")
    {
        fetch("cargaMateria.php",{method:"POST", body:datos})
        .then(respuesta => respuesta.json())
        .then(data =>{
    
            alert(data);
            formulario.reset();
        
        })

    }else{

        alert("Atención: Debe Seleccionar un Grado")
    }

    


})