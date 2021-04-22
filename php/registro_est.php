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
        $correo = strtoupper($_POST["correo"]); $redes = strtoupper($_POST["redes"]);  $redes2 = strtoupper($_POST["redes2"]); $fecha_ing = $_POST["fecha_ing"];  $enfermedad = strtoupper($_POST["enfermedad"]);
        $status= "ACTIVO";

        // INFORMACION REPRESENTANTE
        $cedula_rep = $_POST["cedula_rep"]; $apellidos_rep = strtoupper($_POST["apellidos_rep"]); $nombres_rep = strtoupper($_POST["nombres_rep"]); $fecha_nac_rep = $_POST["fecha_nac_rep"];
        $direccion_rep =  strtoupper($_POST["direccion_rep"]); $telefono_rep = $_POST["telefono_rep"];
        $correo_rep = $_POST["correo_rep"]; $ocupacion_rep =  strtoupper($_POST["ocupacion_rep"]);
        $direccion_trab_rep =  strtoupper($_POST["direccion_trab_rep"]); $observacion =  strtoupper($_POST["observacion"]);

       

        $lugar_nacimiento = $pais."/".$estado."/".$municipio."/".$parroquia;
        $red_social = $redes.": ".$redes2;


      
      
        include_once 'conectar.php';
        include_once 'funciones.php';

      //  consultar("representantes","ced_rep",$cedula_rep,$conexion);

        //var_dump($conexion);

        if(!consultar("representantes","ced_rep",$cedula_rep,$conexion)){
          var_dump(!consultar("representantes","ced_rep",$cedula_rep,$conexion)); 

              $guardar_rep = "INSERT INTO representantes (ced_rep,apellidos_rep,nombres_rep,fecha_nac_rep,direccion_rep,telefonos_rep,e_mail_rep,ocupacion_rep,direccion_trabajo_rep)VALUES (?,?,?,?,?,?,?,?,?)";

              $sentencia_rep = $conexion->prepare($guardar_rep);

              $sentencia_rep->execute(array($cedula_rep,$apellidos_rep,$nombres_rep,$fecha_nac_rep,$direccion_rep,$telefono_rep,$correo_rep,$ocupacion_rep,$direccion_trab_rep));

              $sentencia_rep=null;



        }
                

       // consultar("estudiantes","ced_est",$cedula,$conexion);
       // var_dump($respuesta_F);

        if(!consultar("estudiantes","ced_est",$cedula,$conexion)){

          $guardar_est = "INSERT INTO estudiantes (ced_est,apellidos_est,nombres_est,genero_est,fecha_nac_est,lugar_nac_est,direccion_est,telefonos_est,e_mail_est,redes_sociales_est,fecha_ing_est,cedu_rep,enfer_dis,estatus_est,observacion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

          $sentencia_est = $conexion->prepare($guardar_est);

          $sentencia_est->execute(array($cedula,$apellidos,$nombres,$tipo,$fecha_nac,$lugar_nacimiento,$direccion,$telefono,$correo,$red_social,$fecha_ing,$cedula_rep,$enfermedad,$status,$observacion));

             // $sentencia_est = null;

          if($sentencia_est)
          {
            echo("<script type='text/javascript'>alert('$cedula Se Registró con Éxito!!!'); </script>");
          }else{
            echo '<script language="javascript">alert("ERROR LLAMAR A FRANCISCO FARIAS 0424-8324623");</script>';
          }


        }else{
          echo("<script type='text/javascript'>alert('OJO: $cedula Se Registró Previamente'); </script>");
        }
        
          $conexion = null;  $sentencia_est=null;


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
    <title>Registro de Estudiantes</title>
</head>
<body>
       

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header  text-center w-100" style="background: #3563A9">
          <h5 class="modal-title w-100 text-white fs-4 fw-bold ">Registro de Estudiantes</h5>
          <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="">X</a>
          
        </div>
        <div class="modal-body " style="background:  #E9ECEF;">
         
         
            <form action="" class="formulario" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >


               

                





                     <!-- ********** PASO 1 ************ -->
                   <div class="pasos datos_personales activo text-center mr-4 " id="paso-1">
                     <h4 class="text-white" style="background: #3563A9">Datos Personales</h4>

                    
                     

                        <input type="text" class="form-control mb-2 text-center" placeholder="Cédula" required maxlength="8" name="cedula" required id="cedula_est"> 
                    




                         <!-- ******  FOTO **************  -->

                     <div class="text-center mb-1">
                             
                        <canvas id="canvas_est" style="height: 120px; width: 120px;" class="bg-warning mt-1 d-none"></canvas>
    
                        <video id="video_est" src="" style="height: 120px; width: 120px;" class="bg-dark mt-1"></video>
                     
                     </div>
    
    
                    <div class="text-center mb-2">
    
                        <button class="btn btn-primary " id="boton_est">Tomar foto</button>
                         <button class="btn btn-warning d-none" id="boton2_est">Otra Foto</button>
    
    
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
                     <input type="date" class="form-control" name="fecha_nac">
                        
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
                    <input type="text" class="form-control mb-2 text-center" placeholder="Teléfono" name="telefono"> 
                    <input type="email" class="form-control mb-2 text-center" placeholder="E-mail" name="correo"> 
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
                  <h4 class="text-white" style="background: #3563A9">Otros Datos</h4>
                      <div class="mb-2">
                          <label for="" class=" text-center my-1 w-100"><span class="">Fecha de Ingreso</span></label>
                          <input type="date" name="fecha_ing" class="form-control mb-2 " required>
                      </div>

                     
                      <input type="text" class="form-control mb-2 text-center" placeholder="Efermedad o Discapacidad" name="enfermedad"> 

                      <h4 class="text-white" style="background: #3563A9">Información del Representante</h4>
                      <input type="text" class="form-control mb-2 text-center" placeholder="Cédula" name="cedula_rep" required id="cedula_rep"  maxlength="8"> 


                      <!-- *****FOTO REPRESENTANTE ******-->

                      <div class="text-center mb-1">
                             
                          <canvas id="canvas_rep" style="height: 120px; width: 120px;" class="bg-warning mt-1 d-none"></canvas>
      
                          <video id="video_rep" src="" style="height: 120px; width: 120px;" class="bg-dark mt-1"></video>
                       
                       </div>
      
      
                      <div class="text-center mb-2">
      
                          <button class="btn btn-primary " id="boton_rep">Tomar foto</button>
                           <button class="btn btn-warning d-none" id="boton2_rep">Otra Foto</button>
      
      
                      </div>


                      <input type="text" class="form-control mb-2 text-center" placeholder="Apellidos" name="apellidos_rep" required> 
                      <input type="text" class="form-control mb-2 text-center" placeholder="Nombres" name="nombres_rep" required>
                      <label for="" class=" text-center w-100 mb-1 "><span>Fecha de Nacimiento</span></label>
                      <input type="date" class="form-control" name="fecha_nac_rep" required>



                    



                        
                      <button class="btn btn-danger my-2 atras boton" data-actual="3" data-siguiente="2">Atrás</button>
                      <button class="btn btn-primary my-2 siguiente boton" data-actual="3" data-siguiente="4">Siguiente</button>
                  
                    
                      
                    

                </div>

                 <!-- ********** PASO 4 ************ -->

                 <div class="pasos datos_laborales text-center " id="paso-4">
                  <h4 class="text-white" style="background: #3563A9">Información del Representante</h4>
                                               
                        <input type="text" class="form-control mb-2 text-center" placeholder="Dirección" name="direccion_rep" required> 
  
                        
                        <input type="text" class="form-control mb-2 text-center" placeholder="Teléfonos" name="telefono_rep" required> 

                        <input type="text" class="form-control mb-2 text-center" placeholder="E-mail" name="correo_rep"> 

                        <input type="text" class="form-control mb-2 text-center" placeholder="Ocupación" name="ocupacion_rep" required>

                        <input type="text" class="form-control mb-2 text-center" placeholder="Dirección del Trabajo" name="direccion_trab_rep">

                        <div class="mb-2">
                           
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Obsevaciones...." name="observacion"></textarea>
                        </div>
                       
  
  
  
                      
  
                            
                                      

                 <button class="btn boton btn-danger my-2 atras" data-actual="4" data-siguiente="3">Atrás</button>
                 <button type="submit" name="registrar" class="btn btn-success my-2">Registrar</button>

              </div>

            </form>











        </div>
       
      </div>
    </div>
  </div>



<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>



<script>
    var formulario = document.querySelector(".formulario");
var boton = document.querySelector(".boton");

$(document).ready(function()
{
      

      $(".modal").modal("show");

                   
});

formulario.addEventListener("click", function(e){

      e.stopPropagation();

     
      var elemento = e.target;

      var siguiente = elemento.classList.contains("siguiente");
      var regresar = elemento.classList.contains("atras");

      if(siguiente || regresar){

            var actual = document.getElementById("paso-"+elemento.dataset.actual);
            var sigue = document.getElementById("paso-"+elemento.dataset.siguiente);
           

            if(elemento.dataset.siguiente == 2){
                  $(".modal").css("height","400px");
                }
      
                if(elemento.dataset.siguiente == 3){
                  $(".modal").css("height","1000px");
                }
                if(elemento.dataset.siguiente == 4){
                  $(".modal").css("height","550px");
                }
                if(elemento.dataset.siguiente == 1){
                  $(".modal").css("height","1000px");
                }

                  actual.classList.remove("activo")
                 
                  sigue.classList.add("activo")

                  if(siguiente){
                        actual.classList.add("izquierda")
                              
                  }else{

                      sigue.classList.remove("izquierda");
                  }
            
          

      }


})



/* ********************** VALIDAR SÓLO NYMEROS ******************************** */
formulario.cedula_est.addEventListener('keypress', function (e){
            if (!soloNumeros(event)){
                    e.preventDefault();

                }
        })

  formulario.cedula_rep.addEventListener('keypress', function (e){
            if (!soloNumeros(event)){
                    e.preventDefault();

                }
        })

                      

           // Solo permite introducir numeros.
                function soloNumeros(e){
                    var key = e.charCode;
                   
                    return key >= 48 && key <= 57;
                }



var video_est = document.getElementById("video_est");
var canvas_est = document.getElementById("canvas_est");
var tomar_est = document.getElementById("boton_est");
var otra_est = document.getElementById("boton2_est");


var video_rep = document.getElementById("video_rep");
var canvas_rep = document.getElementById("canvas_rep");
var tomar_rep = document.getElementById("boton_rep");
var otra_rep = document.getElementById("boton2_rep");

var campo, canvass, videos, botones, otrafoto, guarda, mensaje;

function tieneSoporteUserMedia(){
    return !!(navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
  }

  function _getUserMedia(){
    return (navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
  }


  if (tieneSoporteUserMedia()) {
    _getUserMedia(
        {video: true},
        function (stream) {
            console.log("Permiso concedido");
            video_est.srcObject = stream;
            video_rep.srcObject = stream;
           

            video_est.play();
            video_rep.play();
           

            
        }, function (error) {
            console.log("Permiso denegado o error: ", error);
        });
} else {
    alert("Lo siento. Tu navegador no soporta esta característica");
}


tomar_est.addEventListener("click", function(){

    pinta_guarda("est");
})

tomar_rep.addEventListener("click", function(){

  pinta_guarda("mp");
})




function pinta_guarda(valor){

if (valor =="est"){

     campo = "cedula_est";
     canvass = document.querySelector('#canvas_est');
     videos = video_est;
     botones = tomar_est;
     otrafoto = otra_est;
     guarda = "../fotos/estudiantes/";
     mensaje = "del o la Estudiante";


}

if(valor == "mp"){

   campo = "cedula_rep";
   canvass = document.querySelector('#canvas_rep');
   videos = video_rep;
   botones = tomar_rep;
   otrafoto = otra_rep;
   guarda = "../fotos/madres_padres/";
   mensaje = "del Padre, Madre o Representante";
}




  console.log(document.getElementById(campo).value)



if(document.getElementById(campo).value!=0){

  //Pausar reproducción
videos.pause();

canvass.classList.remove("d-none");
// canvas.style.position="relative";
videos.classList.add("d-none");
botones.classList.add("d-none");
otrafoto.classList.remove("d-none");

//Obtener contexto del canvas y dibujar sobre él
var contexto = canvass.getContext("2d");
canvass.width = videos.videoWidth;
canvass.height = videos.videoHeight;
contexto.drawImage(videos, 0, 0, canvass.width, canvass.height);

var foto = canvass.toDataURL(); //Esta es la foto, en base 64
foto = encodeURIComponent(foto);

const fotos = {
 "captura": foto,
 "cedula": document.getElementById(campo).value,
 "guarda":guarda,
 // Aquí más datos...
};
// Aquí la ruta en donde enviamos la foto. Podría ser una absoluta o relativa
const ruta = "http://localhost/PROYECTO_LICEO/php/guardar_foto.php";
fetch(ruta, {
 method: "POST",
 body: JSON.stringify(fotos),
 headers: {
   "Content-type": "application/x-www-form-urlencoded",
 }
})
 .then(resultado2 => resultado2.json())
 .then(nombreDeLaFoto => {
   // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
   console.log({ nombreDeLaFoto });
   alert(`Guardada como ${nombreDeLaFoto}`);

 });


//Reanudar reproducción
videos.play();


}else{

   alert("Debe Ingresar Cédula "+mensaje);
}








}





otra_est.addEventListener("click", function(){

/*  canvas.classList.add("d-none");
  
  video.classList.remove("d-none");
  btn.classList.remove("d-none");
  btn_otrafoto.classList.add("d-none");*/

  reanudar();

})

otra_rep.addEventListener("click", function(){

  /*canvas2.classList.add("d-none");
  
  video2.classList.remove("d-none");
  btn2.classList.remove("d-none");
  btn_otrafoto2.classList.add("d-none");*/

  reanudar();

})

function reanudar(){

  canvass.classList.add("d-none");
  
  videos.classList.remove("d-none");
  botones.classList.remove("d-none");
  otrafoto.classList.add("d-none");


}




</script>



</body>



</html>