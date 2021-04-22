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
            $codigo = $_POST["codigo"];
            $codigo2 = $_POST["codigo2"];
            $seccion = $_POST["seccion"];
            $periodo =$_POST["periodo"];
            $opcion = $_POST["opcion"];
            $guia = $_POST["guia"];
            $seccion2 = $_POST["seccion2"];
           

            if($guia==="0"){$guia = 0;}else{$guia=1;}

            include_once 'conectar.php';
            include_once 'funciones.php';

            $resp = consultar("personal","ced_per",$cedu,$conexion);

            if($resp){ 

                if($resp["estatus"]==="ACTIVO"){

                  $resp = consultar3("doc_mat_secc","cid","cod_mat","seccion","periodo",$cedu,$codigo,$seccion,$periodo,$conexion);
                  $resp2 = consultar("materias","cod_mat",$codigo,$conexion);
   
                     if($opcion==="I"){
                           if(!$resp && $resp2){
                              $inscripcion = 'INSERT INTO doc_mat_secc (cid,cod_mat,seccion,periodo,guia) VALUES(?,?,?,?,?)';
   
                              $sentencia_inscrip = $conexion->prepare($inscripcion);
                              $sentencia_inscrip->execute(array($cedu,$codigo,$seccion,$periodo,$guia));
   
                                                        
                                 if($sentencia_inscrip){
                                   echo("<script type='text/javascript'>alert('ASIGNACIÓN EXITOSA!!!'); </script>");
                                 }else{
                                   echo("<script type='text/javascript'>alert('ERROR: LLAMAR A FRANCISCO FARIAS'); </script>");
                                 }
   
                                 
                             
                            }
                            else{
                                 if(!$resp2){
                                   echo("<script type='text/javascript'>alert('ERROR EN CÓDIGO DE MATERIA!!!'); </script>");
   
                                 }else{
                                   echo("<script type='text/javascript'>alert('ASIGNACIÓN DOCENTE-MATERIA YA EXISTE PARA ESTE PERIODO!!!'); </script>");
                                 }
                             
                             }
   
                             $conexion=null; $sentencia_inscrip=null; $sentencia_F=null;
                     
                     }
                     else{
   
                           if($resp && $resp2){
                               $id = $resp["id"]; $control = 0;
                             
                                 if($codigo2!=""){
   
                                     $resp2 = consultar("materias","cod_mat",$codigo,$conexion);
                                     if(!$resp2){
                                       $control =1;
                                     }else{
                                       $codigo = $codigo2;
                                     }
   
                                 }
   
                                 if($seccion2!="" && $control==0){
   
                                     $seccion = $seccion2;
                                 }
   
                                 if($control==0){
   
                                   $resp = consultar3("doc_mat_secc","cid","cod_mat","seccion","periodo",$cedu,$codigo,$seccion,$periodo,$conexion);
   
                                     if(!$resp){
                                          // *********************
                                            $actualizar = 'UPDATE doc_mat_secc SET cod_mat=?,seccion=?,guia=? WHERE id=?';
                                            $sentencia_act = $conexion->prepare($actualizar);
                                            $sentencia_act->execute(array($codigo,$seccion,$guia,$id));
     
                                            echo("<script type='text/javascript'>alert('ACTUALIZACIÓN EXITOSA!!!'); </script>");
                                     // **********
   
                                     }
                                     else{
                                       echo("<script type='text/javascript'>alert('ASIGNACIÓN DOCENTE-MATERIA YA EXISTE PARA ESTE PERIODO!!!'); </script>");
                                     }
   
                                  
                                 }
                                 else{
   
                                   echo("<script type='text/javascript'>alert('ERROR EN CÓDIGO DE MATERIA!!!'); </script>");
   
                                 }
   
   
                                 
   
   
                                 
   
                                 $conexion=null; $sentencia_act=null; $sentencia_F=null;
                                 
                           }
                           else{
                             $conexion=null; $sentencia_F=null;
                             echo("<script type='text/javascript'>alert('ERROR EN CÓDIGO DE MATERIA!!!'); </script>");
                           }
                       
                     }

                }else{

                  echo("<script type='text/javascript'>alert('DOCENTE INACTIVO!!!'); </script>");
                  $conexion=null; $sentencia_F=null;
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
      <div class="modal-header text-center w-100 bg-danger">
        <h5 class="modal-title w-100 text-white fs-4 fw-bold" >Asignar Sección</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="">X</a>
      </div>
      <div class="modal-body text-center">
      
            <form action="" id="app" class="formu" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <input type="text" class="form-control mb-2 text-center" maxlength="8" placeholder="Ingrese Cédula del Docente" name="cedula" required>

                <input type="text" class="form-control mb-3 text-center" maxlength="2" placeholder="Ingrese Código de Materia" name="codigo" required>

                <input type="text" class="form-control mb-3 text-center d-none" maxlength="2" placeholder="Ingrese Nuevo Código de Materia"  name="codigo2"  id="codigo_mat">

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

                        <label for="" class=" text-center my-1 w-100 fs-6 fw-bold mb-2   d-none" id="etiqueta"><span class="">Nueva Sección</span></label>
                      <select id="select2" class="form-select mb-2  d-none"  name="seccion2" >
                          <option value="">Selecciona Nueva Sección</option>
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
                        <input type="text" class="form-control text-center mb-2" v-model="fechas" name="periodo" readonly>

                        <label for="" class=" text-center my-2 w-100 fs-6 fw-bold mb-3"><span class="">¿Es Guía?</span></label>
                      <select id="" class="form-select mb-1"  name="guia" required>
                          <option value="0">No</option>
                          <option value="1">Si</option>
                                                   
                        </select>

                        <div class="my-2 text-center">
                              <div class="form-check form-check-inline text-center fprm-control">
                                                    <input class="form-check-input quitar" type="radio" name="opcion"                  id="inlineRadio2" value="I" style=" height: 15px; width:15px;" checked >
                                                 <label class="form-check-label " for="inlineRadio2">Asignar</label>
                             </div>
            
                               <div class="form-check form-check-inline text-center fprm-control">
                                                    <input class="form-check-input actualizar" type="radio" name="opcion"                  id="inlineRadio2" value="A" style=" height: 15px; width:15px;">
                                                 <label class="form-check-label " for="inlineRadio2">Actualizar</label>
                               </div>
                        </div>

                        <button type="submit" class="btn btn-danger mt-2 fs-6 fw-bold" name="inscribir">Ejecutar</button>
            
            
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

/*const app = new Vue({
  el: '#app',
  data:{

    periodo: ''

  },
  computed:{

    fechas(){

        var fecha = new Date();
        this.periodo = fecha.getMonth()+1;

        if(fecha.getMonth()+1 >=1 && fecha.getMonth()+1 <=7 )
        {
            this.periodo = (fecha.getFullYear()-1)+'-'+fecha.getFullYear();
        }
        else{
            this.periodo = fecha.getFullYear()+'-'+(fecha.getFullYear()+1);
        }
        return this.periodo
    }

  }



})*/

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

  var codigo_mat = document.querySelector("#codigo_mat");
  var opcion = document.querySelector(".actualizar");
  var opcion2 = document.querySelector(".quitar");

  opcion.addEventListener("click", function(){
  

        codigo_mat.classList.remove("d-none");
        document.querySelector("#etiqueta").classList.remove("d-none");
        document.querySelector("#select2").classList.remove("d-none");


  })

  opcion2.addEventListener("click", function(){
  

  codigo_mat.classList.add("d-none");
  document.querySelector("#etiqueta").classList.add("d-none");
  document.querySelector("#select2").classList.add("d-none");


})



</script>
</body>
</html>