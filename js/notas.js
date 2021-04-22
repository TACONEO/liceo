



$("#notas").on("submit", function(event) {
    event.preventDefault();
    var confirmacion = confirm("¿CONFIRMA CARGAR ESTAS NOTAS?");
   
    if(confirmacion){
     
        $.ajax({
            url: "cargarnotas.php",
            type: "post",
            data: $(this).serialize(),
            success: function(respuesta) {
              alert(respuesta);
                
            }
        });

    }
    
});