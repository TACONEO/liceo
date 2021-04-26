<?php

    include '../fpdf/fpdf.php';
    
    session_start();
    include_once 'conectar.php';
    
    if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["DOCENTE-D"])){
        
    $grado = $_POST["grado"];
    $seccion = $_POST["seccion"];
    $periodo = $_POST["periodo"];

 
  

   $seleccion = 'SELECT cie FROM inscripcion WHERE grado=? AND seccion=? AND periodo=?';
   $sentencia = $conexion->prepare($seleccion);
   $sentencia->execute(array($grado,$seccion,$periodo));
   $resultado = $sentencia->fetchAll();

      
       
    $generar = 0;



if($resultado)
{
      Class PDF extends FPDF
        {
        
        
            
            function Footer(){
        
                $this->SetY(-15);
        
                $this->SetFont('courier',"B",10);
                $this->settextcolor(0,0,0);
               $this->cell(0,5,utf8_decode("Este Documento será Válido siempre que posea el Sello y las firmas solicitadas"),0,0,'C');
        
                }
        }


 foreach($resultado as $fila)
 {

    
    
        $pagina = new pdf();
        $pagina->addpage('portrait','letter');
    
    
        $pagina->setfont('arial','b',12);
        $pagina->image("../img/logo.png",57,4,25,25);
       // $pagina->write(18,"Liceo Aragua de Barcelona");
       //$pagina->SetFillColor(100,100,50);
        $pagina->cell(0,10,"Liceo Aragua de Barcelona",0,0,"C");
        $pagina->ln(30);
    
        $pagina->SetLineWidth(1);
        $pagina->SetDrawColor(52, 152, 219);
        $pagina->line(12,35,200,35);
              $seleccion2 = 'SELECT apellidos_est,nombres_est FROM estudiantes WHERE ced_est=?';
              $sentenciar2 = $conexion->prepare($seleccion2);
              $sentenciar2->execute(array($fila["cie"]));    
              $resultados2 = $sentenciar2->fetch(); 

              $seleccion3 = 'SELECT * FROM notas WHERE cie=? AND periodo=?';
              $sentenciar3 = $conexion->prepare($seleccion3);
              $sentenciar3->execute(array($fila["cie"],$periodo));    
              $resultados3 = $sentenciar3->fetchAll(); 
                  $contar = 0;

                 if($resultados3)
                 {
                     foreach($resultados3 as $filanotas)
                      {
                      
                            // echo $filanotas["codi_mat"]

                            $seleccion4 = 'SELECT nombre_mat FROM materias WHERE cod_mat=?';
                            $sentenciar4 = $conexion->prepare($seleccion4);
                            $sentenciar4->execute(array($filanotas["codi_mat"]));    
                            $resultados4 = $sentenciar4->fetch(); 

                            if($contar == 0)
                            {
                                // ******* DATOS DEL ESTUDIANTE ************************
                                    $pagina->setfont('courier','BI',11);
                                    $pagina->write(5,utf8_encode("Estudiante: ".$resultados2["apellidos_est"]." ".$resultados2["nombres_est"])); $pagina->ln();
                                    $pagina->write(5,utf8_decode("Cédula: ".$fila["cie"])); $pagina->ln();
                                    $pagina->write(5,utf8_decode("Grado y Sección: ".$grado.$seccion )); $pagina->ln();
                                    $pagina->write(5,utf8_decode("Año Escolar: ".$periodo)); $pagina->ln();
            
                                    // *******************************

                                    $pagina->SetLineWidth(1);
                                    $pagina->SetDrawColor(52, 152, 219);
                                    $pagina->line(12,65,200,65);
                                
                                    $pagina->ln();
                                    $pagina->setfont('courier','BI',16);
                                    $pagina->cell(0,10,utf8_decode("Boletín Informativo"),0,0,"C");
                                    $pagina->ln();
                                
                                    $pagina->SetLineWidth(1);
                                    $pagina->SetDrawColor(52, 152, 219);
                                    $pagina->line(12,75,200,75);
                                
                                    $pagina->ln(4);
                        
                                // ***** ENCABEZADO DE TABLA ******************
                                    $pagina->SetLineWidth(1);
                                    $pagina->SetDrawColor(255,255,255);
                                    $pagina->Setfillcolor(52, 152, 219);
                                    $pagina->setfont('arial','BI',12);
                                    $pagina->settextcolor(248, 249, 249);
                                    $pagina->cell(10,10,utf8_decode("N°"),1,0,"C",1);
                                    $pagina->cell(40,10,utf8_decode("Asignatura"),1,0,"C",1);
                                    $pagina->cell(30,10,utf8_decode("Lapso 1"),1,0,"C",1);
                                    $pagina->cell(12,10,utf8_decode("Inas."),1,0,"C",1);
                                    $pagina->cell(30,10,utf8_decode("Lapso 2"),1,0,"C",1);
                                    $pagina->cell(12,10,utf8_decode("Inas."),1,0,"C",1);
                                    $pagina->cell(30,10,utf8_decode("Lapso 3"),1,0,"C",1);
                                    $pagina->cell(12,10,utf8_decode("Inas."),1,0,"C",1);
                                    $pagina->cell(12,10,utf8_decode("Def."),1,0,"C",1);
                                
                                //**************************************************** */
                        
                                    $pagina->ln();
                                
                                    $pagina->setfont('arial','',11);
                                    $pagina->settextcolor(8,8,8,);
                                    $pagina->SetDrawColor(255,255,255);
                                    $pagina->Setfillcolor(220, 228, 228);
                                    $pagina->setlinewidth(1);

                            }

                                    
                                    // *************** CONTENIDO DE TABLA **************************
                                
                            
                                        $pagina->cell(10,8,$contar+1,1,0,"C",1); $contar++;
                                        $pagina->cell(40,8,utf8_decode($resultados4["nombre_mat"]),1,0,"C",1);
                                        $pagina->cell(30,8,$filanotas["lapso1"],1,0,"C",1);
                                        $pagina->cell(12,8,$filanotas["ina1"],1,0,"C",1);
                                        $pagina->cell(30,8,$filanotas["lapso2"],1,0,"C",1);
                                        $pagina->cell(12,8,$filanotas["ina2"],1,0,"C",1);
                                        $pagina->cell(30,8,$filanotas["lapso3"],1,0,"C",1);
                                        $pagina->cell(12,8,$filanotas["ina3"],1,0,"C",1);
                                        $pagina->cell(12,8,$filanotas["nota_f"],1,0,"C",1);
                                        $pagina->ln();
                                    
                                    //***************************** */


                         }

                            // ******* FIRMA DOCENTE *****************
                            $pagina->SetLineWidth(0);
                            $pagina->SetDrawColor(0,0,0);
                            $pagina->line(12,220,50,220);
                            $pagina->text(18,225,utf8_decode("Docente Guía"));
                            
                            // ***************************************
                            
                            // ******** SELLO ************
                            
                            $pagina->text(100,220,"SELLO");
                            
                            // **************************
                            
                            
                            // ****** FIRMA DIRECTOR *******//
                            
                            $pagina->line(150,220,192,220);
                            $pagina->text(161,225,"Director(a)");
                            
                            
                            if($filanotas["lapso1"]!="" && $filanotas["lapso2"]==="" && $filanotas["lapso3"] ==="")
                            {
                                $lapso = "Lapso1";  
                            }

                            if($filanotas["lapso1"]!="" && $filanotas["lapso2"]!="" && $filanotas["lapso3"] ==="")
                            {
                                $lapso = "Lapso2"; 
                            }

                            if($filanotas["lapso1"]!="" && $filanotas["lapso2"]!="" && $filanotas["lapso3"] !="")
                            {
                                $lapso = "Lapso3";
                            }
                            
                           
                            $ruta = 'c:/'.$periodo.'/'.$grado.$seccion.'/'.$lapso;

                            if(!is_dir($ruta))
                            {
                                $crear = mkdir($ruta,0777,true);
                            }

                            $generar = 1;
                             $pagina->OutPut('F',$ruta.'/'.$fila['cie'].'.pdf');
                            
                        }
                           
                                
     }

    $sentencia = null; $sentenciar2 = null; $sentenciar3 = null; $sentenciar4 = null; $conexion = null;

    if($generar > 0){
        echo json_encode('Boletines de '.$grado.$seccion.' Se Generaron Satisfactoriamente!!!');

    }
    else{  
        echo json_encode('IMPORTANTE: '.$grado.$seccion.' NO POSEE NOTAS REGISTRADAS PARA EL PERIODO '.$periodo);
    }
   
 }
 else{

    $sentencia = null; $conexion = null;
    echo json_encode('Atención: '.$grado.$seccion.' No tiene Estudiantes Registrados en el Periodo '.$periodo);
 }
    
    
    
}
else{

    header( "refresh:0.5; url=../index.php" );
} 
 










?>