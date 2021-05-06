<?php ob_start(); ?>
<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>

<?php

    $mensaje="";

    if(isset($_POST['sesion']) || isset($_POST['registrar'])){

     // echo '<script language="javascript">alert("correcto");</script>';

        include_once 'php/conectar.php';

      
    }


    function guardar($conexion,$cedula,$usuario,$contrasena,$seleccion,$respuesta,$tabla){

      


      $guardar = "INSERT INTO $tabla (usuario,contrasena,pregunta,respuesta,enlace) VALUES(?,?,?,?,?)";

      $preparar = $conexion->prepare($guardar);
      $preparar->execute(array($usuario,$contrasena,$seleccion,$respuesta,$cedula));

     
      

      if($preparar){
        echo '<script language="javascript">alert("USUARI@: '.$usuario.' REGISTRAD@ SATISFACTORIANMENTE!!!");</script>';
      }else{
        echo '<script language="javascript">alert("ERROR!!!");</script>';
      }

     

    }


    function verificar($conexion,$usuario,$tabla){
      
      $consultar_usu = "SELECT * FROM $tabla WHERE usuario = ? ";
      $sentencia_usu = $conexion->prepare($consultar_usu);
      $sentencia_usu->execute(array($usuario));
      $campos_usu = $sentencia_usu->fetch();
     
      return $campos_usu;

      

    }

    function cerrar_variables($sentencia_est, $sentencia_per, $conexion){


      $sentencia_est = null; $sentencia_per = null; $conexion=null;
    }


    if(isset($_POST['registrar'])){
          $cedula = $_POST['cedula'];
          $usuario = $_POST["usuario"];
          $contrasena = $_POST['contrasena'];
          $contrasena2 = $_POST['contrasena2'];
          $seleccion = $_POST["seleccion"];
          $respuesta = strtoupper($_POST["respuesta"]);

       
          $respuesta_usu = verificar($conexion,$usuario,"usuario");
          $respuesta_usu2 = verificar($conexion,$usuario,"usuario2");
          
          if($respuesta_usu or  $respuesta_usu2){

            echo "<script>
            alert('USUARI@ YA EXISTE EN NUESTRO SISTEMA');
            window.location= 'index.php' </script>";
            die();
          }


          if($contrasena === $contrasena2){



            $consultar_per = "SELECT * FROM personal WHERE ced_per = ? ";
            $sentencia_per = $conexion->prepare($consultar_per);
            $sentencia_per->execute(array($cedula));
            $campos = $sentencia_per->fetch();

            $consultar_est = "SELECT * FROM estudiantes WHERE ced_est = ? ";
            $sentencia_est = $conexion->prepare($consultar_est);
            $sentencia_est->execute(array($cedula));
            $campos2 = $sentencia_est->fetch();


            if($campos || $campos2){
               
              if($campos ){
                    if($campos["estatus"]==="ACTIVO"){

                      $tabla ="usuarios";
                  

                      $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
                      guardar($conexion,$cedula,$usuario,$contrasena,$seleccion,$respuesta,$tabla);
  
                      cerrar_variables($sentencia_est, $sentencia_per, $conexion);

                    }
                    else{

                      cerrar_variables($sentencia_est, $sentencia_per, $conexion);
                      echo '<script language="javascript">alert("UD. SE ENCUENTRA INACTIVO EN ESTA INSTITUCIÓN");</script>'; 
                    }

                  
    
                                       
              }
             

              if($campos2){


                      if($campos2["estatus_est"]==="ACTIVO"){
                        $tabla = "usuarios2";
                                 
                        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
                        guardar($conexion,$cedula,$usuario,$contrasena,$seleccion,$respuesta,$tabla);
   
                        cerrar_variables($sentencia_est, $sentencia_per, $conexion);
                      }
                      else{
                        cerrar_variables($sentencia_est, $sentencia_per, $conexion);
                        echo '<script language="javascript">alert("AMIG@ ESTUDIANTE UD. SE ENCUENTRA INACTIV@ EN ESTA INSTITUCIÓN");</script>';
                      }

                   

              }
            
            }else{
              echo '<script language="javascript">alert("UD. NO SE ENCUENTRA REGISTRAD@ EN NUESTRO SISTEMA");</script>';

              cerrar_variables($sentencia_est, $sentencia_per, $conexion);
            }
  
          



          }else{

           
            echo '<script language="javascript">alert("LAS CONTRASEÑAS NO SON IGUALES");</script>';

           
          }

          

         
    }



    if(isset($_POST["sesion"]))
    {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $tipo = $_POST["tipo"];
        include_once 'php/funciones.php';

         


        $resultado_log = consultar($tipo,"usuario",$usuario,$conexion);
       
         
        if(!$resultado_log){
          echo '<script language="javascript">alert("USUARIO '.$usuario.' no Existe!! ");</script>';
          $conexion=null; $sentencia_F=null;
          header( "refresh:0.1; url=index.php" );
          die();
          
        }

        
        if(!password_verify($password,$resultado_log["contrasena"]))
        {
          echo '<script language="javascript">alert("Contraseña Inválida!!!");</script>';
          $conexion=null; $sentencia_F=null;
          header( "refresh:0.1; url=index.php" );
          die();
        }

        if($tipo=="usuarios"){$parametros = "ced_per"; $tabla="personal"; $ruta="administrar.php";}else{$parametros="ced_est";  $tabla="estudiantes"; $ruta="administrar.php";}

        $resultado_log_2 = consultar($tabla,$parametros,$resultado_log["enlace"],$conexion);

        //echo "BIENVENID@: ".$resultado_log_2[2]." ".$resultado_log_2[1];

        
        session_start();
        if($tipo=="usuarios"){

              if($resultado_log_2["estatus"] ==="ACTIVO"){

                if($resultado_log_2["cargo"]=="DOCENTE" && $resultado_log_2["ced_per"]=="12819998")
                {$_SESSION["admin"]=$resultado_log_2[0]; header( "Location: php/".$ruta );}
    
                if($resultado_log_2["cargo"]=="DOCENTE-DE")
                {$_SESSION["DOCENTE-DE"]=$resultado_log_2[0]; header( "Location: php/".$ruta );}

                if($resultado_log_2["cargo"]=="DOCENTE-D" )
                {$_SESSION["DOCENTE-D"]=$resultado_log_2[0]; header( "Location: php/".$ruta );}
    
                if($resultado_log_2["cargo"]=="DOCENTE" )
                {$_SESSION["DOCENTE"]=$resultado_log_2[0]; header( "Location: php/".$ruta );}
    
                if($resultado_log_2["cargo"]=="ADMINISTRATIVO" )
                { echo '<script language="javascript">alert("soy administrativo");</script>';
                  $_SESSION["ADMINISTRATIVO"]=$resultado_log_2[0]; header( "Location: php/".$ruta );}

                $conexion=null; $sentencia_F=null;
              }
              else{
                $conexion=null; $sentencia_F=null;
                echo '<script language="javascript">alert("USUARI@ INACTIV@!!!");</script>';
              }

            

        


        }
        else{


              if($resultado_log_2["estatus_est"]==="ACTIVO"){

                $_SESSION["estudiante"]=$resultado_log_2[0]; header( "Location: php/".$ruta );
              }
              else{
                echo '<script language="javascript">alert("AMIG@ ESTUDIANTE SU USUARIO SE ENCUENTRA INACTIV@!!!");</script>';
              }

              $conexion=null; $sentencia_F=null;

        }

        


    }
    
?>
<?php ob_end_flush(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" >

    
    
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="fontawesome/css/solid.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/estilos.css">
   
    <title>LICEO ARAGUA DE BARCELONA</title>
</head>
<body >

    

  <!-- NAV-->
  <nav class="navbar navbar-expand-md navbar-light container-fluid sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand ancla_logo  p-1 " href="#">

          <img src="img/logo.png" alt="logo" class="rounded-circle logo">
          <div class="p-2 nombre_logo">Liceo Aragua de Barcelona</div>
      </a>
      <button class="navbar-toggler border border-white " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse   justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav p-2 ">
          
         <li class="nav-item dropdown  p-1">
            <a class="nav-link dropdown-toggle fondo_link enlaces_nav text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="iconos_nav"><i class="fas fa-registered"></i></span> Registrarse
            </a>
            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item  text-white" href="#">Estudiantes</a></li>
              <li><a class="dropdown-item text-white" href="#">Personal</a></li>
              <li><hr class="dropdown-divider border border-3 border-primary"  ></li>
              
            </ul>
          </li>
          <li class="nav-item fondo_link p-1 enlaces_nav">
            <a class="nav-link text-white" href="#" tabindex="-1" aria-disabled="true"> <span class="iconos_nav"><i class="fas fa-sign-in-alt"></i></span> Ingresar</a>
          </li>

          <li class="nav-items " >
            <a href="#" class="nav-link  "><img src="img/facebook.png" alt="Facebook"  class="redes_nav"></a>
          </li>
          <li class="nav-items" >
            <a href="#" class="nav-link "><img src="img/gorjeo.png" alt="Twitter"class="redes_nav"  ></a>
          </li>

          <li class="nav-items " >
            <a href="#" class="nav-link "><img src="img/instagram.png" alt="Instagram" class="redes_nav" ></a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
   <!-- FIN NAV-->


<!-- PARTE DE LA SECCIÓN-->
  <section class="row vh_section   ">

      <div class="col-md-6 section_izquierda ">

          <img src="img/logo.png" alt="" class="p-2 ">

          <img src="img/logo.png" alt="" class="p-2 ">

          <img src="img/logo.png" alt="" class="p-2 ">

          <img src="img/logo.png" alt="" class="p-2 ">
      </div>


      <div class="col-md-6 section_derecha  ">
        
     

      <form class="bg-white  p-3 w-75 form_principal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="ingresar">
          <div style="height: 20px;"></div>
            <div class="mb-3">
             
              <input type="text" class="form-control text-center w-100 p-2 " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuario" name="usuario" required maxlength="8" autocomplete="off">
             
            </div>
            <div class="mb-3">
            
             <input type="password" class="form-control text-center w-100 p-2" id="exampleInputPassword1" placeholder="Contraseña" required maxlength="10" name="password">
           </div>

           <div class="mb-3 text-center">

           <div class="form-check form-check-inline text-center">
               <input class="form-check-input " checked type="radio" name="tipo"      id="inlineRadio1"  value="usuarios" style=" height: 15px; width:15px;">
                 <label class="form-check-label " for="inlineRadio1"><span class="opciones">Personal</span></label>
            </div>
           <div class="form-check form-check-inline text-center">
                   <input class="form-check-input " type="radio" name="tipo"                  id="inlineRadio2" value="usuarios2" style=" height: 15px; width:15px;">
                  <label class="form-check-label " for="inlineRadio2"><span class="opciones">Estudiante</span></label>
            </div>
           
           </div>
                





           
          <div class="text-center w-100  "> <button type="submit" class="btn btn-primary  py-2 w-75 btn_principal" name="sesion">Iniciar Sesión</button></div>

           <div class="text-center  my-3"> <a href="php/recuperar.php" class="olvido">¿Olvisate tu contraseña?</a></div>
           <hr class="bg-primary">

           <div class="text-center " ><a href="" class="btn registro  py-2  btn_principal w-50 text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Personal y Estudiantes" style="background: #36A420;">Registro</a></div>

         

          

           

         
      </form>
        
     

  </div>

      




  </section>
  <!-- FIN PARTE DE LA SECCIÓN-->


  <!-- MODAL PARA REGISTRO-->



  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"   style=" background: rgba(0,0,0,.2); ">
        <div class="modal-header  " style=" background: rgba(11,94,215,.6);" >
          <h5 class="modal-title text-center w-100 text-white fs-4 fw-bold" id="staticBackdropLabel" >Registro</h5>
          <a href="" class="text-white fs-5 fw-bold " data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="modal-body " style=" background: rgba(0,0,0,.2);">

              <!--FORMULARIO DE REGISTRO-->


              <form class="registro" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="registro_usu">
                <div class="mb-3">
                  
                  <input type="text" required class="form-control text-center " placeholder="Ingrese su Cédula" maxlength="8" name="cedula"  autocomplete="off">
                 
                </div>

                <div class="mb-3">
                  
                  <input type="text" required class="form-control text-center " placeholder="Ingrese su Usuario" maxlength="8"  name="usuario"  autocomplete="off" >
                  <div id="emailHelp" class="form-text text-white">Usuario: Longitud Máxima Caracteres</div>
                 
                </div>
                <div class="mb-3">
                 
                  <input type="password" required class="form-control text-center" id="exampleInputPassword1" placeholder="Ingrese Contraseña" name="contrasena"  maxlength="10" autocomplete="off">
                </div>
                <div class="mb-3 ">
                  <input type="password" required  class="form-control text-center" id="exampleInputPassword2" placeholder="Confirme Contraseña" name="contrasena2"  maxlength="10" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label text-white text-center w-100">Pregunta y Respuesta de Seguridad</label>
                  <select id="" class="form-select " required name="seleccion">
                    <option value="Color Favorito">Color Favorito</option>
                    <option value="Fruta Favorita">Fruta Favorita</option>
                    <option value="Deporte Favorito">Deporte Favorito</option>
                    <option value="Mascota Favorita">Mascota Favorita</option>
                  </select>
                </div>
                <input type="text" name="respuesta" placeholder="Respuesta" class="form-control text-center " required autocomplete="off" maxlength="30" style="text-transform:uppercase">
                <hr class="bg-white" style="height: 2px;">
                <div class="w-100 text-center fw-bold mb-2"> <button type="submit" class="btn btn-success w-50" name="registrar">Registrar</button></div>
              </form>

              

             

              <!--FIN FORMULARIO DE REGISTRO-->




        </div>
        
      </div>
    </div>
  </div>



  <!-- FIN  MODAL PARA REGISTRO-->

  

  <footer class="row bg-dark vh_footer p-2 d-flex flex-column justify-content-center fixed-bottom">

    <div class="text-white text-center footer">Realizado Por Francisco Farias</div>
  </footer>

   

   


    




    
  
 <script src="js/bootstrap.bundle.min.js" ></script>
<script src="js/jquery-3.5.1.min.js"></script>




<script>

          $( document ).ready(function() {

                  let ventana = document.querySelector(".registro");

                  ventana.addEventListener("click", function(e){
                      e.preventDefault();

                        $(".modal").modal("show");
                  })

          });

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


              var registro = document.getElementById("registro_usu");  
              var ingresar = document.getElementById("ingresar");
               
               registro.cedula.addEventListener("keypress", function (e){
              if (!soloNumeros(event)){
                e.preventDefault();

                }
               })

             


                      //Solo permite introducir numeros.
                      function soloNumeros(e){
                          var key = e.charCode;

                       return key >= 48 && key <= 57;
                      }






</script>



</body>
</html>