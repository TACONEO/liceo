<?php ob_start();?>
<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>

<?php 

session_start();

if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["ADMINISTRATIVO"])  || isset($_SESSION["DOCENTE-D"]))
{

       

}

else{

    header( "refresh:0.5; url=../index.php" );
}


?>
<?php ob_end_flush();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <title>Eliminar Asignatura</title>
</head>
<body>
    

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header text-center w-100 bg-danger" >
      <h5 class="modal-title w-100 text-white fs-4 fw-bold">Eliminar Asignaturas</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="" style="text-decoration:none;">X</a>
      </div>
      <div class="modal-body">
            <form  method="POST" id="materias" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <input type="text" class="form-control text-center  fs-5 fw-bold " placeholder="Ingrese el Código" name="codigo" maxlength="2" required  name="codigo" >

                                  
               
                <button type="submit" class=" form-control btn btn-danger text-white mt-2 fs-5 fw-bold" name="eliminar" >Eliminar</button>
               

</form>
      </div>
      
    </div>
  </div>
</div>





<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/eliminarmateria.js"></script>

<script>

$( document ).ready(function() 
            {

                    

                          $(".modal").modal("show");
                    

            });


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

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

</script>
<?php $conexion = null; $respuesta_F = null; ?>
</body>
</html>