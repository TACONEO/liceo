<script > 

        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
        
</script>

<?php 

session_start();

if(isset($_SESSION["admin"]) or isset($_SESSION["DOCENTE-DE"]) or isset($_SESSION["DOCENTE"]) or isset($_SESSION["ADMINISTRATIVO"])  or isset($_SESSION["DOCENTE-D"])){

      
  include_once 'conectar.php';
  include_once 'funciones.php';
  $control = false; $accion ="";
       if(isset($_POST["ejecutar"])){
             
         
                $cedula = $_POST["cedula"];
                $opcion = $_POST["opcion"];
  
               // include_once 'conectar.php';
              //  include_once 'funciones.php';
  
                $tabla1 = "representantes"; $tabla2= "estudiantes";
                $parametro1= "ced_rep"; $parametro2="cedu_rep"; $parametro3 ="ced_est";
  
                $resultado_est = consultarDosTablas($tabla1,$tabla2,$parametro1,$parametro2,$parametro3,$cedula,$conexion);
  
                //var_dump($resultado_est);
  
                $tabla="personal"; $parametro = "ced_per";
  
  
                $resultado_per = consultar($tabla,$parametro,$cedula,$conexion);
  
                if(!$resultado_est && !$resultado_per)
                {
                  echo("<script type='text/javascript'>alert('OJO: Cédula $cedula No Está Registrada en Nuestra Bases de Datos'); </script>");
                }
                else{
  
                  $control = true;
  
                      if($resultado_est && $opcion=="C"){$accion="CE";}
                      if($resultado_est && $opcion=="A"){$accion="AE";}
                      if($resultado_est && $opcion=="E"){$accion="EE"; $general= $resultado_est["ced_est"];}
  
                      if($resultado_per && $opcion=="C"){$accion="CP";}
                      if($resultado_per && $opcion=="A"){$accion="AP";}
                      if($resultado_per && $opcion=="E"){$accion="EP"; $general=$resultado_per["ced_per"];}
  
  
  
                      
  
  
                }
  
                     
  
      }
  
      if(isset($_POST["registrar"])){
  
        echo ("SIIIIIIIIIIII");
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
    <title>Acción CAE</title>


</head>
<body>

        <div class="modal fade modal1" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header text-center w-100" style="background: #3563A9">
                      <h5 class="modal-title text-center w-100 text-white fs-4 fw-bold">
                      
                        <?php 

                            if(!$control){echo "Acción CAE";}
                            if($accion == "CE"){echo "Consultar Estudiante";}
                            if($accion == "AE"){echo "Actualizar Estudiante";}
                            if($accion == "EE" or $accion=="EP"){echo "Eliminar E / P";}
                            if($accion == "CP"){echo "Consultar Personal";}
                            if($accion == "AP"){echo "Actualizar Personal";}
                        
                        
                        
                        ?>
                      
                      
                      </h5>
                      <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="">X</a>
                    </div>
                    <div class="modal-body text-center">
                           
                    <form  method="POST" id="formulario" class="<?php if($control && ($accion!="EE" && $accion!="EP")){echo 'formulario';} ?>"  action="<?php if($accion=='CE'){echo htmlspecialchars($_SERVER['PHP_SELF']);} ?>" >


                        <!--  FORMULARIO PRINCIPAL DE OPCIONES   -->
                                <?php 
                                
                                    if (!$control){



                                          echo '
                                          
                                          <input type="text" class="form-control text-center mb-2" name="cedula" placeholder="Ingrese su Cédula" maxlength="8" required>


                                          <div class="mb-2 text-center">
            
                                                  <div class="form-check form-check-inline text-center">
                                                     <input class="form-check-input " checked type="radio" name="opcion"      id="inlineRadio1"  value="C" style=" height: 15px; width:15px;">
                                                      <label class="form-check-label " for="inlineRadio1">Consultar</label>
                                                </div>
                                            <div class="form-check form-check-inline text-center">
                                                    <input class="form-check-input " type="radio" name="opcion"                  id="inlineRadio2" value="A" style=" height: 15px; width:15px;">
                                                 <label class="form-check-label " for="inlineRadio2">Actualizar</label>
                                          </div>
            
                                          <div class="form-check form-check-inline text-center">
                                                    <input class="form-check-input " type="radio" name="opcion"                  id="inlineRadio2" value="E" style=" height: 15px; width:15px;">
                                                 <label class="form-check-label " for="inlineRadio2">Eliminar</label>
                                          </div>
            
                                        </div>
            
            
            
            
                                            <button class="btn btn-primary mt-2" type="submit" name="ejecutar">Ejecutar</button>


                                          ';

                                        






                                    }

                                    if($accion=="CE" or $accion=="AE"){
                                     
                                        include_once 'consultar_est.php';
                                    }

                                    if($accion=="EE" or $accion=="EP"){
                                      include_once 'eliminar.php';
                                    }

                                    if($accion=="CP" or $accion=="AP"){
                                     
                                      include_once 'consultar_per.php';
                                  }
                                
                                
                                
                                
                                
                                ?>

                                
                      </form>



                    </div>
                    
                  </div>
                </div>
              </div>




<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>
<!--<script src="../js/js.js"></script>-->

<script>

      <?php 


                    if(!$control){

                      echo '
                                  
                      $(document).ready(function(){

                        $(".modal1").modal("show");
                    })
                    var formulario = document.querySelector("#formulario");
            
                    formulario.cedula.addEventListener("keypress", function (e){
                        if (!soloNumeros(event)){
                                e.preventDefault();
            
                            }
                    })
            
                                  
            
                       // Solo permite introducir numeros.
                            function soloNumeros(e){
                                var key = e.charCode;
                               
                                return key >= 48 && key <= 57;
                            }
            
                      
                      
                      ';


                    }


                    if($accion=="CE" or $accion=="AE" or $accion=="CP" or $accion=="AP"){



                              echo '
                              
                              var formulario = document.querySelector(".formulario");
                              var boton = document.querySelector(".boton");
                              
                              $(document).ready(function()
                              {
                                    
                              
                                    $(".modal1").modal("show");
                              
                                                 
                              });
                              
                              formulario.addEventListener("click", function(e){

                              
                                  e.preventDefault();
                               

                              
                                
                              
                                   
                                    var elemento = e.target;
                              
                                    var siguiente = elemento.classList.contains("siguiente");
                                    var regresar = elemento.classList.contains("atras");
                              
                                    if(siguiente || regresar){
                              
                                          var actual = document.getElementById("paso-"+elemento.dataset.actual);
                                          var sigue = document.getElementById("paso-"+elemento.dataset.siguiente);
                                         
                              
                                          if(elemento.dataset.siguiente == 2){
                                                $(".modal1").css("height","400px");
                                              }
                                    
                                              if(elemento.dataset.siguiente == 3){
                                                $(".modal1").css("height","1000px");
                                              }
                                              if(elemento.dataset.siguiente == 4){
                                                $(".modal1").css("height","550px");
                                                
                                              }
                                              if(elemento.dataset.siguiente == 1){
                                                $(".modal1").css("height","1000px");
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
                              
                              
                              ';



                    }

                   

                    if($accion=="AE"){

                        echo '
                        var reg = document.querySelector("#registrar");
                        reg.addEventListener("click", function(e){

                          
               
                          console.log("click click")

                            var datos = new FormData(formulario)
                            console.log(datos.get("cedula"))

                            fetch("realizar_act_est.PHP",{method:"post", body:datos})
                            .then(resp => resp.json())
                            .then(data => {
                                  
                                  alert(data)
                                  location.reload();
                            })
               
                        }) 
                        ';

                    }

                    if($accion =="EE" or $accion=="EP"){
                      
                        echo '
                        
                        

                        
                        
                        $(document).ready(function()
                        {
                              
                        
                              $(".modal1").modal("show");
                        
                                           
                        });

                        var formulario =  document.querySelector("#formulario");
                        var confirmar = document.querySelector("#confirmar");

                        confirmar.addEventListener("click", function(e){

                          e.preventDefault();
                              
                            
                            var datos = new FormData(formulario)
                            console.log(datos.get("cedula"))

                           

                            fetch("ejecutar_eliminar.php",{method:"post", body:datos})
                            .then(resp => resp.json())
                            .then(data => {
                                  
                                  alert(data)
                                  location.href ="administrar.php";
                            })
               
                        }) 
                        
                        
                        ';

                        
                      
                      
                    }

                    if($accion=="AP"){

                      
                      echo '
                    
                     
                      formulario.actualizar.addEventListener("click", function(e){

                       
                            datos = new FormData(formulario)


                          fetch("realizar_act_per.php",{method:"post", body:datos})
                          .then(resp => resp.json())
                          .then(data => {
                                
                                alert(data)
                                location.reload();
                          })
                          
             
                      }) 
                      ';
                    }




      ?>

             
</script>
</body>
</html>