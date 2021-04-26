<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>

<?php
    session_start();
    include_once 'conectar.php';

    if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["DOCENTE-D"])){

      if(isset($_SESSION["admin"])){$sesion = $_SESSION["admin"];}
      if(isset($_SESSION["DOCENTE"])){$sesion = $_SESSION["DOCENTE"];}
      if(isset($_SESSION["DOCENTE-DE"])){$sesion = $_SESSION["DOCENTE-DE"];}
      if(isset($_SESSION["DOCENTE-D"])){$sesion = $_SESSION["DOCENTE-D"];}
      

      // CONSULTAR MATERIAS Y DOC_MAT_SECC
      $seleccion2 = "SELECT * 
      FROM materias mat
     INNER JOIN doc_mat_secc xx ON mat.cod_mat = xx.cod_mat 
      WHERE xx.cid =".$sesion;
      $sentenciar2 = $conexion->prepare($seleccion2);
      $sentenciar2->execute(array());

      $resultado2 = $sentenciar2->fetchAll();

      include_once 'funciones.php';

      $docente = consultar("personal","ced_per",$sesion,$conexion);

     

      $contador=0; $fila=0;
    
    }
    else{

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
    <link href="../css/notas.css" rel="stylesheet" >

    <title>Cargar Notas</title>
</head>
<body>

  <nav class="contaimer d-flex align-items-center bg-dark my-1">

      
      
      <div class="col-md-4  text-center mr-2 ">
        <img src="../fotos/personal/<?php echo $sesion; ?>.jpg" alt="foto" class=" text-white rounded-circle" style="">
      
      </div>

      <div class="col-md-4 text-white   fw-bold cabeza "><?php  echo $docente["apellidos"]." ".$docente["nombres"];?>
      </div>

      <div class="col-md-2 text-white  fw-bold cedula "><?php echo "C.I: ".$sesion; ?>
      </div>

      <div class="col-md-2 text-white volver fw-bold text-center">
      <a href="administrar.php" class="btn btn-outline-light fw-bold cabeza">Volver</a>
      </div>

      
      
     

  
  
  </nav>

   
    
  <?php  foreach ($resultado2  as $valor): ?>
        <?php $grado = $valor["grado"]; $seccion=$valor["seccion"]; $periodo = $valor["periodo"]; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="container row">

        <div class="col-md-4"></div>
        <div class="col-md-4">
        
              <input type="text" name="grado" readonly value="<?php echo $grado; ?>" class=" text-white bg-dark mx-1 text-center border-0 my-1 d-none" readonly style="width: 20px;">

              <input type="text" name="seccion" readonly value="<?php echo $seccion; ?>" class=" text-white bg-dark mx-1 text-center border-0 my-1 d-none" readonly style="width: 20px;">

              <input type="text" name="periodo" readonly value="<?php echo $periodo; ?>" class=" text-white bg-dark mx-1 text-center border-0 my-1 d-none" readonly>

              <input type="text" value="<?php echo $valor["cod_mat"]; ?>" name="codigo" class="d-none">

              <button type="submit" name="cargar" class="btn btn-success my-1 p-2 w-100 btn_grados fw-bold"><?php echo $grado.$seccion; ?></button>
        </div>
        <div class="col-md-4"></div>

         
          <?php echo '<br>';?>
    
    
    
      </form>

 <?php endforeach ?>
    
    
        



<?php if(isset($_POST["cargar"])): ?>
  <?php

   
      $grado = $_POST["grado"]; $seccion = $_POST["seccion"]; $periodo = $_POST["periodo"];
      $codigo = $_POST["codigo"];
     

      $sleccion = "SELECT * FROM inscripcion WHERE grado=? AND seccion=? and periodo=?";
      $sentencia = $conexion->prepare($sleccion);
      $sentencia->execute(array($grado,$seccion,$periodo));
      $resultado = $sentencia->fetchAll();

      $materia = "SELECT nombre_mat FROM materias WHERE cod_mat=?";
      $sent_mat = $conexion->prepare($materia);
      $sent_mat->execute(array($codigo));
      $asignatura = $sent_mat->fetch();



  
  ?>


   <table class="table container mt-2">
  <thead>
    <tr>
    <th scope="col" class="text-center cabeceras ">Indice</th>
      <th scope="col" class="text-center cedula " >Cédula</th>
      <th scope="col" class="text-center cabeceras ">Apellidos y Nombres</th>
      <th scope="col" class="text-center cabeceras">Nota</th>
      <th scope="col" class="text-center cabeceras ">Inas.</th>
    </tr>
  </thead>
  <tbody  >

      <form action="" class="bg-danger" id="notas" method="">
    
             
                <div class="row container seccion_3">

                  <div class="col-md-3  d-flex justify-content-end  align-items-center gal fw-bold">
                      <?php echo "GRADO Y SECCIÓN: ".$grado.$seccion; ?>
                  
                  </div>

                  <div class="col-md-3  d-flex justify-content-end  align-items-center gal fw-bold">
                      <?php echo  "ASIGNATURA: ".strtoupper($asignatura["nombre_mat"]); ?>
                  
                  </div>
                  
                         <div class="col-md-3 text-center d-flex justify-content-end  align-items-center ">
                              <select  class="form-select form-control lapsos text-center " required name="lapso" >
                                     <option value="0" class="lapsos fw-bold ">Seleccionar Lapso</option>
                                    <option value="1" class="lapsos fw-bold ">1</option>
                                    <option value="2" class="lapsos fw-bold ">2</option>
                                    <option value="3" class="lapsos fw-bold ">3</option>
                  
                               </select>
                          </div>

                           <div class="col-md-3 periodo">
                            <input type="text" name= "periodo" class="p-2 bg-dark text-white text-center  fw-bold form-control periodo" value="<?php echo $periodo ?>" readonly >

                            <input type="text" value="<?php echo $codigo; ?>" name="codigo" class="d-none" >
                                                     
                           </div>

                          

                           
                  
                    </div>

     <?php foreach($resultado as $datos)
             
            : ?>
            <?php  $sleccion3 = "SELECT apellidos_est, nombres_est FROM estudiantes WHERE ced_est=?";
            $sentencia3 = $conexion->prepare($sleccion3);
            $sentencia3->execute(array($datos["cie"]));
            $resultado3 = $sentencia3->fetch(); ?>



           
       
        <tr>
         
        
              <th scope="row" class="text-center filas"><?php echo ($contador = $contador+1); ?></th>

              <td class="text-center cedula"><input type="text " name='cedula[]' readonly value="<?php echo $datos["cie"]; ?>"  class=" text-center border-0 form-control " ></td>

              <td class="text-center filas"> <?php echo $resultado3["apellidos_est"]." ".$resultado3["nombres_est"]; ?></td>

              <td class="d-flex justify-content-center filas "><input type="text" style="width:50px;" class="text-center form-control filas " name='nota[]' required ></td>

              <td >
              
                <div class="d-flex justify-content-center">
                    <input type="text" style="width:50px;" class="text-center form-control mr-3 filas" name='ina[]' >
                </div>
              
              </td>

             

           
              
         </tr>
        
         <?php  endforeach ?>

         <tr class="">
            <td colspan="4" class="text-center" >
              <button type="submit" class="btn btn-success w-25 btn_cargar fw-bold" name='cargar'>Cargar</button>
            </td> 
         </tr>
          
         </form>
      
  </tbody>
  </table>


<?php endif ?>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/notas.js"></script> 



<?php 

$sentenciar2 = null; $sentencia_F=null; $sentencia3=null; $sentencia=null;

$sent_mat=null; $conexion=null;



?>
</body>
</html>