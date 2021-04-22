<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <title>Generar Boletin</title>
</head>
<body>
    

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center w-100 " style="background:#483D8B;">
        <h5 class="modal-title w-100 text-white fs-4 fw-bold">BOLETIN GRADO-SECCIÓN</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="" style="text-decoration:none;">X</a>
      </div>
      <div class="modal-body">
            <form action="" method="" id="boletin">
            
            <select class="form-select form-control text-center" aria-label="Default select example" name="grado" id="">
                        <option value="0">Seleccione el Grado</option>
                          <option value="7">7mo</option>
                          <option value="8">8vo</option>
                          <option value="9">9no</option>
                          <option value="4">4to. Año</option>
                          <option value="5">5to. Año</option>
                          
            </select>

            <select class="form-select my-2 form-control text-center" aria-label="Default select example" name="seccion">
                        <option value="0">Seleccione la Seccion</option>
                        <option value="A" class="text-center">A</option>
                          <option value="B" class="text-center">B</option>
                          <option value="C" class="text-center">C</option>
                          <option value="D" class="text-center">D</option>
                          <option value="E" class="text-center">E</option>
                          <option value="F" class="text-center">F</option>
                          <option value="G" class="text-center">G</option>
                          <option value="H" class="text-center">H</option>
                          <option value="I" class="text-center">I</option>
                          
            </select>

            <select class="form-select form-control text-center" aria-label="Default select example" name="periodo" id="periodo">
                       
                          
            </select>
           
            <button type="submit" class=" form-control btn btn-success mt-2 fs-5 fw-bold" name="Boletin">Generar Boletines</button>
            
            </form>
           
      </div>
     
    </div>
  </div>
</div>

<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/boletin.js"></script> 

<script>

            $( document ).ready(function() 
            {

                    

                          $(".modal").modal("show");
                    

            });



</script>
</body>
</html>