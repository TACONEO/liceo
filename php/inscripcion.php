<script > 

        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
        
</script>

<?php 

session_start();
if(isset($_SESSION["admin"]) or isset($_SESSION["DOCENTE-DE"]) or isset($_SESSION["DOCENTE"]) or isset($_SESSION["ADMINISTRATIVO"])  or isset($_SESSION["DOCENTE-D"]))
{

        if(isset($_POST["inscribir"])){
          
            $cedu = $_POST["cedula"];
            $grado = $_POST["grado"];
            $seccion = $_POST["seccion"];
            $periodo =$_POST["periodo"];
            $opcion = $_POST["opcion"];

            include_once 'conectar.php';
            include_once 'funciones.php';

            $resp = consultar("estudiantes","ced_est",$cedu,$conexion);

            if($resp){ 

                if($resp["estatus_est"]==="ACTIVO")
                {

                  $resp = consultar2("inscripcion","cie","periodo",$cedu,$periodo,$conexion);

                  if($opcion==="I"){
                        if(!$resp){
                           $inscripcion = 'INSERT INTO inscripcion (cie,grado,seccion,periodo) VALUES(?,?,?,?)';

                           $sentencia_inscrip = $conexion->prepare($inscripcion);
                           $sentencia_inscrip->execute(array($cedu,$grado,$seccion,$periodo));

                                                     
                              if($sentencia_inscrip){
                                echo("<script type='text/javascript'>alert('INSCRIPCIÓN EXITOSA!!!'); </script>");
                              }else{
                                echo("<script type='text/javascript'>alert('ERROR: LLAMAR A FRANCISCO FARIAS'); </script>");
                              }

                              
                          
                         }
                         else{
                          echo("<script type='text/javascript'>alert('ESTA INSCRIPCIÓN YA EXISTE PARA ESTE PERIODO'); </script>");
                          }

                          $conexion=null; $sentencia_inscrip=null; $sentencia_F=null;
                  
                  }
                  else{

                        if($resp){

                              $actualizar = 'UPDATE inscripcion SET grado=?,seccion=?,periodo=? WHERE cie=?';
                              $sentencia_act = $conexion->prepare($actualizar);
                              $sentencia_act->execute(array($grado,$seccion,$periodo,$cedu));

                              echo("<script type='text/javascript'>alert('ACTUALIZACIÓN EXITOSA!!!'); </script>");

                              $conexion=null; $sentencia_act=null; $sentencia_F=null;
                              
                        }
                    
                  }
                }
                else{
                  echo("<script type='text/javascript'>alert('AMIG@ ESTUDIANTE UD. SE ENCUENTRA INACTIV@!!!'); </script>");
                  $conexion=null;  $sentencia_F=null;

                }
               
             
            }
            else
            {
              $conexion = null; $sentencia_F=null;
              echo("<script type='text/javascript'>alert('OJO: Cédula $cedu No Existe en Nuestra Base de Datos'); </script>");
            }




               

        }
       


}
else{

  header( "refresh:0.2; url=../index.php" );
}





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Inscripción</title>
</head>
<body>
    
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header text-center w-100 bg-success">
        <h5 class="modal-title w-100 text-white fs-4 fw-bold" >Inscripción</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="">X</a>
      </div>
      <div class="modal-body text-center">
      
            <form action="" id="app" class="formu" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <input type="text" class="form-control mb-2 text-center" maxlength="8" placeholder="Ingrese Cédula" name="cedula" required>

                <label for="" class=" text-center my-1 w-100 fs-6 fw-bold mb-2"><span class="">Grado</span></label>
                      <select id="" class="form-select mb-2"  name="grado" required>
                          <option value="7">7mo</option>
                          <option value="8">8vo</option>
                          <option value="9">9no</option>
                          <option value="4">4to. Año</option>
                          <option value="5">5to. Año</option>
                          
                        </select>

                 <label for="" class=" text-center my-1 w-100 fs-6 fw-bold mb-2"><span class="">Sección</span></label>
                      <select id="" class="form-select mb-2"  name="seccion" required>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                          <option value="F">F</option>
                          <option value="G">G</option>
                          <option value="H">H</option>
                          <option value="I">I</option>
                          
                        </select>

                        <label for="" class=" text-center my-2 w-100 fs-6 fw-bold"><span class="">Periodo</span></label>
                        <input type="text" class="form-control text-center" v-model="fechas" name="periodo" readonly>

                        <div class="my-2 text-center">
                              <div class="form-check form-check-inline text-center fprm-control">
                                                    <input class="form-check-input " type="radio" name="opcion"                  id="inlineRadio2" value="I" style=" height: 15px; width:15px;" checked >
                                                 <label class="form-check-label " for="inlineRadio2">Inscripción</label>
                             </div>
            
                               <div class="form-check form-check-inline text-center fprm-control">
                                                    <input class="form-check-input " type="radio" name="opcion"                  id="inlineRadio2" value="A" style=" height: 15px; width:15px;">
                                                 <label class="form-check-label " for="inlineRadio2">Actualizar</label>
                               </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-2 fs-6 fw-bold" name="inscribir">Inscribir</button>
            
            
            </form>
      </div>
      
    </div>
  </div>
</div>


<script src="../vue/vue.js"></script>
<script src="../js/app.js"></script>
<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>

<script>

            $(document).ready(function(){

            $(".modal").modal("show");
            })

           
            /************* VUE EN ISCRIPCION **********/



var formulario = document.querySelector(".formu");
            
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



</script>
</body>
</html>