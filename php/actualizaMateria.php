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
        include_once 'conectar.php';
        include_once 'funciones.php';
        if(isset($_POST["consultar"]))
        {       $control = 1;
               

                $codigo = $_POST["codigo"];

                
                $consulta_M = consultar("materias","cod_mat",$codigo,$conexion);

                

                if(!$consulta_M)
                {
                   
                  echo '<script>alert("La Asignatura con Código '. $codigo.' No se Encuentra Registrada en el Sistema")</script>';

                  $control = 0;
          
                }
               
        }

        if(isset($_POST["actualizar"]))
        {
            $codigo = $_POST["codigo"];
            $nombre= $_POST["nombre"];
            $area = $_POST["area"];
            $grado = $_POST["grado"];

            $actualizar = 'UPDATE materias SET nombre_mat=?,area=?,grado=? WHERE cod_mat=?';
            $sentencia_act_mat = $conexion->prepare($actualizar);
            $sentencia_act_mat->execute(array($nombre,$area,$grado,$codigo));

                 $error = $sentencia_act_mat->errorInfo();
            if (!$sentencia_act_mat) 
            {
                echo $error[2];
            }else{

                echo '<script>alert("La Asignatura con Código '. $codigo.' se Actualizó Satisfactoriamente!!!")</script>';

                $conexion = null; $sentencia_act_mat = null;
            }

           

            $control = 0;
            
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
    <title>Actualizar Asignatura</title>
</head>
<body>
    

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header text-center w-100 " style="background: #0061a8  ;">
      <h5 class="modal-title w-100 text-white fs-4 fw-bold">Actualizar Asignaturas</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="" style="text-decoration:none;">X</a>
      </div>
      <div class="modal-body">
            <form  method="POST" id="materias" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <input type="text" class="form-control text-center  fs-5 fw-bold " placeholder="Ingrese el Código" name="codigo" maxlength="2" required value='<?php if($control != 0){ echo $codigo;} ?>' <?php if($control != 0){ echo 'readonly';} ?> name="codigo" data-bs-toggle="tooltip" data-bs-placement="right" title="Código de Asignatura">

                    <?php if($control != 0) : ?>

                    <input type="text" class="form-control text-center my-2  fs-5 fw-bold " required value='<?php echo $consulta_M["nombre_mat"]; ?>' data-bs-toggle="tooltip" data-bs-placement="right" title="Nombre de Asignatura" name="nombre">

                    <input type="text" class="form-control text-center my-2  fs-5 fw-bold " required value='<?php echo $consulta_M["area"]; ?>' data-bs-toggle="tooltip" data-bs-placement="right" title="Área de Asignatura" name="area"  >

                    <select class="form-select form-control text-center fs-5 fw-bold" required aria-label="Default select example" name="grado" id=""  >
                          <option value="0">Seleccione el Grado</option>
                          <option value="7" <?php if( $consulta_M["grado"]=="7"){echo "selected";} ?>>7mo</option>
                          <option value="8"  <?php if( $consulta_M["grado"]=="8"){echo "selected";} ?>>8vo</option>
                          <option value="9"  <?php if( $consulta_M["grado"]=="9"){echo "selected";} ?>>9no</option>
                          <option value="4"  <?php if( $consulta_M["grado"]=="4"){echo "selected";} ?>>4to. Año</option>
                          <option value="5"  <?php if( $consulta_M["grado"]=="5"){echo "selected";} ?>>5to. Año</option>
                               
                                
                    </select>
                        
                    <button type="submit" class=" form-control btn btn-success mt-2 fs-5 fw-bold" name="actualizar" style="background: #2978b5 ;">Actualizar</button>

                <?php endif?>
                
                <?php if($control == 0): ?>
                <button type="submit" class=" form-control btn btn-success mt-2 fs-5 fw-bold" name="consultar" style="background: #2978b5 ;">Consultar</button>
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
<?php $conexion = null; $sentencia_F = null; ?>
</body>
</html>