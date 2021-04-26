<?php

  session_start();

  if(!isset($_SESSION["admin"]) && !isset($_SESSION["DOCENTE-DE"]) && !isset($_SESSION["DOCENTE"]) && !isset($_SESSION["DOCENTE-D"]) && !isset($_SESSION["ADMINISTRATIVO"]))
  {

    header( "refresh:0.1; url=../index.php" );
  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <title>Carga de Materias</title>
</head>
<body>
    

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center w-100 " style="background: #008080;">
        <h5 class="modal-title w-100 text-white fs-4 fw-bold">Cargar Materias</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="" style="text-decoration:none;">X</a>
      </div>
      <div class="modal-body">
            <form action="" method="" id="materias">

              <input type="text" class="form-control text-center" placeholder="Ingrese el Código" name="codigo" maxlength="2" required>

              <input type="text" class="form-control text-center my-2" placeholder="Ingrese el Nombre" name="nombre" requiered>

              <input type="text" class="form-control text-center my-2" placeholder="Área" name="area" requiered>
            
            <select class="form-select form-control text-center" aria-label="Default select example" name="grado" id="" requiered>
                        <option value="0">Seleccione el Grado</option>
                          <option value="7">7mo</option>
                          <option value="8">8vo</option>
                          <option value="9">9no</option>
                          <option value="4">4to. Año</option>
                          <option value="5">5to. Año</option>
                          
            </select>

            

            
                       
                          
           
           
            <button type="submit" class=" form-control btn btn-success mt-2 fs-5 fw-bold" name="">Cargar</button>
            
            </form>
           
      </div>
     
    </div>
  </div>
</div>

<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/materias.js"></script> 

<script>

            $( document ).ready(function() 
            {

                    

                          $(".modal").modal("show");
                    

            });



</script>
</body>
</html>