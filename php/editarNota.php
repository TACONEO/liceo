<?php ob_start();?>

<script > 
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>
<?php 

    session_start();

    if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["ADMINISTRATIVO"])  || isset($_SESSION["DOCENTE-D"]))
    {

        if(isset($_POST["editar"]))
        {
           $cedula = $_POST["cedula"];
           $codigo = $_POST["codigo"];
           $nota = $_POST["nota"];
           $periodo = $_POST["periodo"];
           $lapso = $_POST["lapso"];


           ejecutar($cedula,$codigo,$periodo,$lapso,$nota);

        }

    }
    else{

        header( "refresh:0.1; url=../index.php" );
    }

    function ejecutar($cedula,$codigo,$periodo,$lapso,$nota)
    {
            include_once 'conectar.php';
            include_once 'funciones.php';
           
             if($periodo == "0")
             {
                echo '<script language="javascript">alert("Atención: Debe Seleccionar un Periodo");</script>'; header( "refresh:0.1; url=editarNota.php" );
             }
             if($lapso == "0" )
             {
                echo '<script language="javascript">alert("Atención: Debe Seleccionar un Lapso");</script>'; $control = 1; header( "refresh:0.1; url=editarNota.php" );
             }


           /* $revisar = 'SELECT * FROM notas WHERE cie = ? AND codi_mat = ? AND periodo = ?';
            $sentencia_rev = $conexion -> prepare($revisar);
            $sentencia_rev->execute(array($cedula,$codigo,$periodo));
            $resultado_rev = $sentencia_rev->fetch();*/

            $resultado_rev = consultar33("notas","cie","codi_mat","periodo",$cedula,$codigo,$periodo,$conexion);

           

            if($resultado_rev)
            {
                $actualizar = "UPDATE notas SET $lapso = ? WHERE cie = ? AND codi_mat = ? AND periodo = ?";

                $sentencia_act = $conexion->prepare($actualizar);
                $sentencia_act->execute(array($nota,$cedula,$codigo,$periodo));

                // *** PARA RECALCULAR EL PROMEDIO ********

                $resultado_rev = consultar33("notas","cie","codi_mat","periodo",$cedula,$codigo,$periodo,$conexion);

                if( strtoupper($nota)==="A" || strtoupper($nota)==="B" || strtoupper($nota)==="C"|| strtoupper($nota)==="D" || strtoupper($nota)==="E")
                {

                    $notaF = calculo(strtoupper($resultado_rev["lapso1"]),strtoupper($resultado_rev["lapso2"]),strtoupper($resultado_rev["lapso3"]));


                }else{

                       
                       $notaF = (intval($resultado_rev["lapso1"]) + intval($resultado_rev["lapso2"]) + intval($resultado_rev["lapso3"]))/3;

                     
                       $notaF = round( $notaF);
                       $notaF = strval($notaF);

                      
                       

                    }

                    $actualizar = "UPDATE notas SET nota_f=? WHERE cie = ? AND codi_mat = ? AND periodo = ?";

                    $sentencia_act = $conexion->prepare($actualizar);
                    $sentencia_act->execute(array($notaF,$cedula,$codigo,$periodo));


                echo '<script language="javascript">alert("Actualización Exitosa!!!")</script>';
            }else{
                echo '<script language="javascript">alert("Registro NO Encontardo")</script>';
            }

               
            


    }

    function calculo($nota1,$nota2,$nota3)
    {
            $cualitativa = ["A","B","C","D","E"];
            $cuantitativa =["20","18","16","14","12"];

           
                    $suma = 0;
          
                for($contador = 0; $contador < 5; $contador++)
                {   
                   
                        if($nota1 === $cualitativa[$contador])
                        {
                            $nota1 = $cuantitativa[$contador];

                            $suma = $suma +  intval($nota1);
                        }

                        if($nota2 === $cualitativa[$contador])
                        {
                            $nota2 = $cuantitativa[$contador];

                            $suma = $suma +  intval($nota2);
                        }

                        if($nota3 === $cualitativa[$contador])
                        {
                            $nota3 = $cuantitativa[$contador];

                            $suma = $suma +  intval($nota3);
                        }
                }
          
              //  echo '<script language="javascript">alert("SUMA: '.$suma.'");</script>';

                $def = ($suma / 3);

              //  echo '<script language="javascript">alert("Def: '.$def.'");</script>';

          if($def === 20){ $def = "A";}
          if($def === 18){ $def = "B";}
          if($def === 16){ $def = "C";}
          if($def === 14){ $def = "D";}
          if($def === 12){ $def = "E";}

          if($def > 18 && $def < 20){ $def = "A";}
          if($def > 16 && $def < 18){ $def = "B";}
          if($def > 14 && $def < 16){ $def = "C";}
          if($def > 12 && $def < 14){ $def = "D";}

         // echo '<script language="javascript">alert("Def: '.$def.'");</script>';

          return $def;

    }

?>




<?php ob_end_flush(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <title>Editar Nota</title>
</head>
<body>
    
<div class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header text-center w-100 " style="background: #ff8303;">
        <h5 class="modal-title w-100 text-white fs-4 fw-bold">Editar Nota</h5>
        <a href="administrar.php" class="text-white fs-5 fw-bold " data-bs-dismiss="" aria-label="" style="text-decoration:none;">X</a>
      </div>
      <div class="modal-body">
        <form action="" id="editarNota"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <input type="text" class="form-control my-2 text-center fs-5 fw-bold" maxlength="8" placeholder="Ingrese Cédula" name="cedula" required>

                <input type="text" class="form-control my-2 text-center fs-5 fw-bold" maxlength="2" placeholder="Ingrese Cód. de Materia" name="codigo" required >

                <input type="text" class="form-control my-2 text-center fs-5 fw-bold" maxlength="2" placeholder="Ingrese Nueva Nota" name="nota" required >

                <select class="form-select form-control text-center fs-5 fw-bold" aria-label="Default select example" name="periodo" id="periodo"> 
                </select>

                <select class="form-select my-2 form-control text-center fs-5 fw-bold" aria-label="Default select example" name="lapso">
                        <option value="0">Seleccione el Lapso</option>
                        <option value="lapso1" class="text-center">Lapso 1</option>
                        <option value="lapso2" class="text-center">Lapso 2</option>
                        <option value="lapso3" class="text-center">Lapso 3</option>
                          
                          
                </select>

                <button type="submit" class="form-control btn btn-warning fs-5 fw-bold text-white" name="editar" >Editar</button>

        
        
        
        </form>
      
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

var fecha = new Date();
var anno = fecha.getFullYear();
var mes = fecha.getMonth();
var lapsos = '1';


var selec_periodo = document.getElementById("periodo");
var opcion = document.createElement("option");
opcion.value = "0";
opcion.text = "Seleccione el Periodo";
selec_periodo.add(opcion);


if(mes < 7)
{
   var inicio = anno - 1;
   var fin = anno;

   var periodo = inicio.toString()+"-"+fin.toString();
  // console.log(periodo)

  opcion = document.createElement("option");
  opcion.value = periodo;
  opcion.text = periodo;
  selec_periodo.add(opcion);

   var i = 0;
    
    while(i < 4){
        inicio = inicio - 1;
        fin = fin - 1 ;

        periodo = inicio.toString()+"-"+fin.toString();
       // console.log(periodo);
        opcion = document.createElement("option");
        opcion.value = periodo;
        opcion.text = periodo;
        selec_periodo.add(opcion);

        i++;

    }
      
}

if(mes >=7){

    var inicio = anno ;
    var fin = anno + 1 ;
 
    var periodo = inicio.toString()+"-"+fin.toString();
   // console.log(periodo)
 
   opcion = document.createElement("option");
   opcion.value = periodo;
   opcion.text = periodo;
   selec_periodo.add(opcion);
 
    var i = 0;
     
     while(i < 4){
         inicio = inicio - 1;
         fin = fin - 1 ;
 
         periodo = inicio.toString()+"-"+fin.toString();
         //console.log(periodo);
         opcion = document.createElement("option");
         opcion.value = periodo;
         opcion.text = periodo;
         selec_periodo.add(opcion);
 
         i++;
 
     }


}


var editar = document.getElementById("editarNota");


    editar.cedula.addEventListener("keypress", function(e){

        

        if(!solonumeros(event))
        {
            e.preventDefault();
        }

        
    })

    editar.codigo.addEventListener("keypress", function(e){

            if(!solonumeros(event))
            {
                e.preventDefault();
            }
    })

    function solonumeros(e)
        {
                var key = e.charCode;

            return key >= 48 && key <= 57;
        }

</script>
</body>
</html>