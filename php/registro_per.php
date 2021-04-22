<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>

<?php 
    session_start();

    if(isset($_SESSION["admin"]) or isset($_SESSION["DOCENTE-DE"]) or isset($_SESSION["DOCENTE"]) or isset($_SESSION["ADMINISTRATIVO"])  or isset($_SESSION["DOCENTE-D"])){

          

      if(isset($_POST["registrar"])){

        $cedula = $_POST["cedula"]; $apellidos = strtoupper($_POST["apellidos"]);
        $nombres = strtoupper($_POST["nombres"]); $tipo = $_POST["tipo"];
        $fecha_nac = $_POST["fecha_nac"]; $pais = strtoupper($_POST["pais"]); $estado = strtoupper($_POST["estado"]); $municipio = strtoupper($_POST["municipio"]);$parroquia = strtoupper($_POST["parroquia"]); $direccion = strtoupper($_POST["direccion"]); $telefono = $_POST["telefono"];
        $correo = strtoupper($_POST["correo"]); $redes = strtoupper($_POST["redes"]);  $redes2 = strtoupper($_POST["redes2"]); $fecha_ing = $_POST["fecha_ing"];  $cargo = strtoupper($_POST["cargo"]);
        $codigo_cargo = strtoupper($_POST["codigo_cargo"]); $condicion_cargo = $_POST["condicion_cargo"]; $titulo = strtoupper($_POST["titulo"]);
        $status= "ACTIVO";

        $lugar_nacimiento = $pais."/".$estado."/".$municipio."/".$parroquia;
        $red_social = $redes.": ".$redes2;

      
        include_once 'conectar.php';

        $consulta_per = "SELECT * FROM personal WHERE ced_per = ?";
        $sentencia_per =  $conexion->prepare($consulta_per);
        $sentencia_per->execute(array($cedula));
        $respuesta_per = $sentencia_per->fetch();


            if(!$respuesta_per){

                  $guardar_per = 'INSERT INTO personal (ced_per,apellidos,nombres,genero,fecha_nac,lugar_nac,direccion,telefonos,e_mail,redes_sociales,fecha_ing,cargo,cod_cargo,condicion,titulo,estatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

                  $sentencia_g_p = $conexion->prepare($guardar_per);

                  $sentencia_g_p->execute(array($cedula,$apellidos,$nombres,$tipo,$fecha_nac,$lugar_nacimiento,$direccion,$telefono,$correo,$red_social,$fecha_ing,$cargo,$codigo_cargo,$condicion_cargo,$titulo,$status));

                     // $sentencia_per = null; $sentencia_g_p=null;$conexion=nul;

               

                      if($sentencia_g_p)
                      {
                        echo("<script type='text/javascript'>alert('.$cedula. Se Registró Satisfactoriamente!!'); </script>");
                      }else{
                        echo '<script language="javascript">alert("ERROR LLAMAR FRANCISCO FARIAS 0424-8324623");</script>';
                      }





            }else{
              echo '<script language="javascript">alert("DISCULPE, UD. YA SE REGISTRÓ PREVIAMENTE");</script>';

            }




            $sentencia_per = null; $sentencia_g_p=null;$conexion=null;

    }

           
           
    }else{

         

            header( "refresh:0.5; url=../index.php" );
          

       
    }













    




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="../css/bootstrap.min.css" rel="stylesheet" >

    
    
    

   <link rel="stylesheet" href="../css/estilos.css">
    <title>Registro del Personal</title>
</head>
<body>

        
       




<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header  text-center w-100" style="background: #3563A9">
          <h5 class="modal-title w-100 text-white fs-4 fw-bold ">Registro del Personal</h5>
          <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="">X</a>
          
        </div>
        <div class="modal-body " style="background: #E9ECEF;">
         
         
            <form action="" class="formulario" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >


               

                





                     <!-- ********** PASO 1 ************ -->
                   <div class="pasos datos_personales activo text-center mr-4 " id="paso-1">
                     <h4 class="text-white" style="background: #3563A9">Datos Personales</h4>

                    
                     

                        <input type="text" class="form-control mb-2 text-center" placeholder="Cédula" required maxlength="8" name="cedula"> 
                    




                         <!-- ******  FOTO **************  -->

                     <div class="text-center mb-1">
                             
                        <canvas id="canvas_p" style="height: 120px; width: 120px;" class="bg-warning mt-1 d-none"></canvas>
    
                        <video id="video_p" src="" style="height: 120px; width: 120px;" class="bg-dark mt-1"></video>
                     
                     </div>
    
    
                    <div class="text-center mb-2">
    
                        <button class="btn btn-primary " id="boton_p">Tomar foto</button>
                         <button class="btn btn-warning d-none" id="boton2_p">Otra Foto</button>
    
    
                    </div>

                    
                      

                     <input type="text" class="form-control mb-2 text-center" placeholder="Apellidos" required name="apellidos"> 
                     <input type="text" class="form-control mb-2 text-center" placeholder="Nombres" required name="nombres"> 
                     
                     <div class="mb-2 text-center">

                     <div class="form-check form-check-inline text-center">
                         <input class="form-check-input " checked type="radio" name="tipo"      id="inlineRadio1"  value="F" style=" height: 15px; width:15px;">
                           <label class="form-check-label " for="inlineRadio1">F</label>
                      </div>
                     <div class="form-check form-check-inline text-center">
                             <input class="form-check-input " type="radio" name="tipo"                  id="inlineRadio2" value="M" style=" height: 15px; width:15px;">
                            <label class="form-check-label " for="inlineRadio2">M</label>
                      </div>
                     
                     </div>
                     <label for="" class=" text-center w-100 mb-1 "><span>Fecha de Nacimiento</span></label>
                     <input type="date" class="form-control" name="fecha_nac" required>
                        
                          <label for="" class=" text-center w-100 mb-1 "><span>Lugar de Nacimiento</span></label>


                          <div class="row">

                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2 w-100 text-center" name="pais"  placeholder="Pais" required>
                                
                              </div>
                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2 w-100 text-center" name="estado"  placeholder="Estado" required>

                              </div>
                          </div>

                          <div class="row">

                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2  text-center" placeholder="Parroquia"  name="parroquia" required>
                                
                              </div>
                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2  text-center" placeholder="Municipio"  name="municipio" required>

                              </div>
                          </div>

                        
                         
                            <button class="btn btn-primary my-2 siguiente " data-actual="1" data-siguiente="2" >Siguiente</button>
                         

                   </div>




                    <!-- ********** PASO 2 ************ -->

                   <div class="pasos datos_ubicacion text-center " id="paso-2">
                   <h4 class="text-white" style="background: #3563A9">Datos de Contacto</h4>
                    <input type="text" class="form-control mb-2 text-center" placeholder="Dirección de Habitación" name="direccion" required> 
                    <input type="text" class="form-control mb-2 text-center" placeholder="Teléfono" name="telefono" required> 
                    <input type="email" class="form-control mb-2 text-center" placeholder="E-mail" name="correo" required> 
                    <div class="row">

                        <div class="col-md-4">

                           
                                
                                <select id="" class="form-select mr-1"  name="redes">
                                  <option value="Facebook">Facebook</option>
                                  <option value="Twitter">Twitter</option>
                                  <option value="Instagram">Instagram</option>
                                  
                                </select>
                        </div>

                          <div class="col-md-8">
                                  <input type="text" class="form-control  text-center  mb-2" placeholder="Direccion de Red Social" name="redes2">
                          </div>
                      </div>

                      
                          <button class="btn btn-danger my-2 atras boton" data-actual="2" data-siguiente="1">Atrás</button>
                          <button class="btn btn-primary my-2 siguiente boton" data-actual="2" data-siguiente="3">Siguiente</button>
                      
                       
                    </div>
                   

                  


                     <!-- ********** PASO 3 ************ -->

                <div class="pasos datos_laborales text-center " id="paso-3">
                <h4 class="text-white" style="background: #3563A9">Datos Laborales</h4>
                      <div class="mb-2">
                          <label for="" class=" text-center my-1 w-100"><span class="">Fecha de Ingreso</span></label>
                          <input type="date" name="fecha_ing" class="form-control mb-2 " required>
                      </div>

                      <label for="" class=" text-center my-1 w-100"><span class="">Cargo</span></label>
                      <select id="" class="form-select mb-2"  name="cargo" required>
                          <option value="Docente">Docente</option>
                          <option value="Docente-DE">Docente-DE</option>
                          <option value="Docente-D">Docente-D</option>
                          <option value="Administrativo">Administrativo</option>
                          <option value="Obrero">Obrero</option>
                          
                        </select>



                    <input type="text" class="form-control mb-2 text-center" placeholder="Código del Cargo" name="codigo_cargo"> 

                    <label for="" class=" text-center my-1 w-100"><span class="">Condición</span></label>
                      <select id="" class="form-select mb-2"  name="condicion_cargo" required>
                          <option value="FIJO">Fijo</option>
                          <option value="CONTRATADO">Contratado</option>
                          <option value="GOBERNACION">Gobernación</option>
                          <option value="ALCALDIA">Alcaldía</option>
                          
                          
                        </select>


                         <input type="text" class="form-control mb-2 text-center" placeholder="Último Título" name="titulo" required>                        



                        
                   
                    
                      <button class="btn boton btn-danger my-2 atras" data-actual="3" data-siguiente="2">Atrás</button>
                      <button type="submit" name="registrar" class="btn btn-success my-2">Registrar</button>
                    

                </div>









            </form>











        </div>
       
      </div>
    </div>
  </div>



<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/js.js"></script>

</body>



</html>