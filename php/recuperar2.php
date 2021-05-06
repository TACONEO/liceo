<?php ob_start();?>
<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>

<?php 

include_once 'conectar.php';
if(isset($_POST['enviar2'])){


  $usuario = $_POST['usuario'];
  $respuesta1 = strtoupper($_POST['respuesta']);
  $contra1 = $_POST['passw'];
  $contra2 = $_POST['passw2'];
  $tabla = $_POST["tabla"];


   $respuesta = revisar($usuario,$conexion,$tabla);

  //echo $respuesta1.'<br>';
  //echo $respuesta['respuesta'];

      if($respuesta1 == $respuesta['respuesta'])
      {

              if($contra1 == $contra2){

                      $contra1 = password_hash($contra1, PASSWORD_DEFAULT);

                      $actualizar = "UPDATE $tabla SET contrasena = ? WHERE usuario = ?";

                      $sentencia_act = $conexion->prepare($actualizar);
                      $sentencia_act->execute(array($contra1,$usuario));

                      echo "<script>
                      alert('SU CONTRASEÑA HA SIDO ACTUALIZADA!!!');
                      window.location= '../index.php' </script>";

                      $sentencia = null; $conexion= null;  $sentencia_act=null;
                      $cedula = $usuario;
                  
              }
              else{

                echo "<script>
                alert('LAS CONTRASEÑAS NO COINCIDEN');
                window.location= 'recuperar.php' </script>";
                  $sentencia = null; $conexion= null;

                  $cedula = $usuario;
              }
      }
      else{

        echo "<script>
        alert('RESPUESTA INCORRECTA');
        window.location= 'recuperar.php' </script>";
          $sentencia = null; $conexion= null;
          $cedula = $usuario;
      }





}
else{

  $cedula = $_POST['usuario'];
  $tipo = $_POST["tipo"];



    $respuesta = revisar($cedula,$conexion,$tipo);

  if(!$respuesta){

    echo "<script>
    alert('UD. NO ESTÁ REGISTRADO COMO USUARI@');
    window.location= 'recuperar.php' </script>";

      
  }

}



    function revisar ($cedula,$conexion,$tipo)
    {

      

      $consulta = "SELECT * FROM $tipo WHERE usuario = ?";
      $sentencia = $conexion->prepare($consulta);
      $sentencia->execute(array($cedula));
      $respuesta = $sentencia->fetch();
      return $respuesta;
    }



?>
<?php ob_end_flush();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>

        <?php  include_once "arriba.php"; ?>

        
</head>
<body class="bg-white" >
    
   
   
   
   
<div class=" modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"   style=" background: rgba(0,0,0,.2); ">
        <div class="modal-header  " style=" background: rgba(11,94,215,.6);" >
          <h5 class="modal-title text-center w-100 text-white fs-4 fw-bold" id="staticBackdropLabel" >Recuperar Contreseña</h5>
         
        </div>
        <div class="modal-body " style=" background: rgba(0,0,0,.2);">

             


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

          <div class="form-group">

                    <input type="text" class="form-control mb-2 text-center fs-5 fw-bold" name="usuario"  autocomplete="off" maxlength="8" value="<?php echo $cedula; ?>" readonly>

                    <input type="text" name="respuesta" class="form-control  mb-2 text-center fs-5 fw-bold" style="text-transform:uppercase;" placeholder=" <?php echo $respuesta['pregunta']; ?>" autocomplete="off">

                    <input type="password" name="passw" class="form-control mb-2 text-center fs-5 fw-bold" placeholder="Ingrese Nueva Contraseña">

                     <input type="password" name="passw2" class="form-control text-center fs-5 fw-bold" placeholder="Confirme Nueva Contraseña">

                     <input type="text" name="tabla" class="form-control  mb-2 text-center d-none" style="text-transform:uppercase;" value=" <?php echo $tipo; ?>" readonly>

            </div>

                   <div class="w-100  text-center mt-2"> <input type="submit" value="Enviar" class="btn btn-info btn-block w-50 fs-5 fw-bold" name="enviar2" ></div>



          <hr class="text-white">



          </form>

          <div class=" w-100 text-center mt-3" >
                          <a href="recuperar.php" class="btn btn-danger w-50 form-control fs-5 fw-bold">Regresar</a>
                     
           </div>

              

             

              




        </div>
        
      </div>
    </div>
  </div>

              
               
                
                


          


                  
  

                    
               


        <?php  include_once 'abajo.php'; ?>
        

        <script>
       
                $(document).ready(function()
                    {
                         
                                 
                           $(".modal").modal("show");

                                   
                             
                                               

                   
                    });

            
            var form = document.getElementById("recuperar");


            form.cedula.addEventListener('keypress', function (e){
                    if (!soloNumeros(event)){
                            e.preventDefault();

                        }
                })


            





            // Solo permite introducir numeros.
            function soloNumeros(e){
                            var key = e.charCode;
                           
                            return key >= 48 && key <= 57;
                        }


                    

     
       </script>

       

</body>
</html>