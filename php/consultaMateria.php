<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>

<?php 

session_start();

if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["ADMINISTRATIVO"])  || isset($_SESSION["DOCENTE-D"]))
{

        $control = 0;

        if(isset($_POST["consultar"]))
        {       $control = 1;
                include_once 'conectar.php';
                include_once 'funciones.php';

                $codigo = $_POST["codigo"];

                
                $consulta_M = consultar("materias","cod_mat",$codigo,$conexion);

                

                if(!$consulta_M)
                {
                   
                  echo '<script>alert("La Asignatura con Código '. $codigo.' No se Encuentra Registrada en el Sistema")</script>';

                  $control = 0;
          
                }
               
        }

}

else{

    header( "refresh:0.5; url=../index.php" );
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <title>Consultar Asignatura</title>
</head>
<body>
    

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header text-center w-100 " style="background: #7952B3;">
      <h5 class="modal-title w-100 text-white fs-4 fw-bold">Consultar Materias</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="" style="text-decoration:none;">X</a>
      </div>
      <div class="modal-body">
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <input type="text" class="form-control text-center  fs-5 fw-bold " placeholder="Ingrese el Código" name="codigo" maxlength="2" required value='<?php if($control != 0){ echo "Código: ".$codigo;} ?>' <?php if($control != 0){ echo 'readonly';} ?>>

                    <?php if($control != 0) : ?>

                    <input type="text" class="form-control text-center my-2  fs-5 fw-bold " value='<?php echo "Asignatura: ".$consulta_M["nombre_mat"]; ?>' <?php echo 'readonly'; ?> >

                    <input type="text" class="form-control text-center my-2  fs-5 fw-bold " value='<?php echo "Área: ".$consulta_M["area"]; ?>' <?php echo 'readonly'; ?>   >

                    <select class="form-select form-control text-center fs-5 fw-bold" aria-label="Default select example" name="grado" id=""   <?php echo 'readonly'; ?> >
                            <option><?php echo "Grado: ".$consulta_M["grado"]; ?></option>
                               
                                
                    </select>
                    <a class="btn  form-control mt-3  fs-5 fw-bold text-white" href="consultaMateria.php"  style="background: #7952B3;">Consultar Otra</a>
                    <a class="btn btn-primary form-control mt-2  fs-5 fw-bold" href="administrar.php">Volver</a>
                <?php endif?>
                
                <?php if($control == 0): ?>
                <button type="submit" class=" form-control btn btn-success mt-2 fs-5 fw-bold" name="consultar" style="background: #7952B3;">Consultar</button>
                <?php endif ?>

</form>
      </div>
      
    </div>
  </div>
</div>


<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>

<script>

$( document ).ready(function() 
            {

                    

                          $(".modal").modal("show");
                    

            });

</script>

<?php $conexion = null; $respuesta_F = null; ?>
</body>
</html>