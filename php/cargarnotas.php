<?php ob_start();?>
<?php
    session_start();
    include_once 'conectar.php';

    if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["DOCENTE-D"])){

    $lapso = $_POST["lapso"];
    $cedula = $_POST["cedula"];
    $codigo = $_POST["codigo"];
    $nota = $_POST["nota"];
    $periodo = $_POST["periodo"];
    $ina = $_POST["ina"];
    $control = 0;

    if($lapso!=0){
        for($i=0; $i<count($_POST["cedula"]); $i++)
        {

            $seleccion = 'SELECT * FROM notas where cie=? AND codi_mat=? AND periodo=?';
            $sentencia_nota = $conexion->prepare($seleccion);
            $sentencia_nota->execute(array($cedula[$i],$codigo,$periodo));
            $fila = $sentencia_nota->fetch();

                  if(!$fila){
                       

                        $guardar = 'INSERT INTO notas (cie,codi_mat,lapso1,ina1,periodo) VALUES (?,?,?,?,?)';
                        $sentencia_g_n = $conexion ->prepare($guardar);
                        $sentencia_g_n->execute(array($cedula[$i],$codigo,$nota[$i],$ina[$i],$periodo));
                           
                        
                    }
                   if($fila && $lapso==="1"){
                       echo "ERROR: LAS NOTAS DEL PRIMER LAPSO SE CARGARON PREVIAMENTE";
                       $control = 1;  
                        break;
                     
                   }

                   if($fila["lapso2"]==="" && $lapso==="2"){
                      
                        $actualizar = 'UPDATE notas SET lapso2=?,ina2=? WHERE cie=? AND codi_mat=? AND periodo=?';
                        $sentencia_a_n = $conexion->prepare($actualizar);
                        $sentencia_a_n->execute(array($nota[$i],$ina[$i],$cedula[$i],$codigo,$periodo));

                      

                   }

                   if($fila["lapso2"]!="" && $lapso==="2"){

                         echo "ERROR: LAS NOTAS DEL SEGUNDO LAPSO SE CARGARON PREVIAMENTE";
                         $control = 1;
                         break;
                   }

                   if($fila["lapso3"]==="" && $lapso==="3"){

                                if( strtoupper($nota[$i])==="A" || strtoupper($nota[$i])==="B" || strtoupper($nota[$i])==="C"|| strtoupper($nota[$i])==="D" || strtoupper($nota[$i])==="E"){

                                    $notaF = calculo(strtoupper($fila["lapso1"]),strtoupper($fila["lapso2"]),strtoupper($nota[$i]));


                                }else{

                                       $notaF = (intval($fila["lapso1"]) + intval($fila["lapso2"]) + intval($nota[$i]))/3;

                                       $notaF = round( $notaF);
                                       $notaF = strval($notaF);

                                }

                                
                      
                  
                             $actualizar = 'UPDATE notas SET lapso3=?,ina3=?,nota_f=? WHERE cie=? AND codi_mat=? AND periodo=?';
                             $sentencia_a_n = $conexion->prepare($actualizar);
                             $sentencia_a_n->execute(array($nota[$i],$ina[$i],$notaF,$cedula[$i],$codigo,$periodo));

                          

                    }

                    if($fila["lapso3"]!="" && $lapso==="3"){

                        echo "ERROR: LAS NOTAS DEL TERCER LAPSO SE CARGARON PREVIAMENTE";
                        $control = 1;
                        break;
                  }


    
            
           
        }

        if($control===0){
            echo "LAS NOTAS DEL LAPSO ".$lapso." SE CARGARON SATISFACTORIAMENTE!!!";
           
            
        }

    }
    else{

        echo "ERROR DEBE SELECCIONAR UN LAPSO";
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


 }
 else{

    header( "refresh:0.1; url=../index.php" );
  }

   
?>
<?php ob_end_flush();?>