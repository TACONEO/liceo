var formulario = document.getElementById("materias");

formulario.addEventListener("submit", function(e){

    e.preventDefault();

    var datos = new FormData(formulario);

   

    var confirmar = confirm("¡Desea Eliminar esta Asignatura?")

    console.log(confirmar)

    if (confirmar)
    {
            fetch("ejecutarEliMat.php", {method: "POST", body: datos})
            .then(respuesta => respuesta.json())
            .then(retorno=>{

                    alert(retorno);
                    formulario.reset();
            })
    }
})