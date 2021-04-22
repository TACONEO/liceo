<?php

    include '../fpdf/fpdf.php';
    
    session_start();
    include_once 'conectar.php';
    

    $grado = "7" ;  //$_POST["grado"];
    $seccion = "A" ;  //$_POST["seccion"];
    $periodo = "2020-2021";   //$_POST["periodo"];

   // echo json_encode("EXITO");
  //  $pagina = new fpdf();

  //  $pagina->addPage('portrait','letter');
   //$pagina->addfont('time',"BI","../fpdf/font/times.php");

   $seleccion = 'SELECT cie FROM inscripcion WHERE grado=? AND seccion=? AND periodo=?';
   $sentencia = $conexion->prepare($seleccion);
   $sentencia->execute(array($grado,$seccion,$periodo));
   $resultado = $sentencia->fetchAll();

      
       
        



if($resultado)
{
    /*Class PDF extends FPDF
    {
    
    
        
        function Footer(){
    
            $this->SetY(-15);
    
            $this->SetFont('courier',"B",10);
            $this->settextcolor(0,0,0);
           $this->cell(0,5,utf8_decode("Este Documento será Válido siempre que posea el Sello y las firmas solicitadas"),0,0,'C');
    
            }
    }
    
        $pagina = new fpdf();
        $pagina->addpage('portrait','letter');
    
    
        $pagina->setfont('arial','b',12);
        $pagina->image("../img/logo.png",57,4,25,25);
       // $pagina->write(18,"Liceo Aragua de Barcelona");
       //$pagina->SetFillColor(100,100,50);
        $pagina->cell(0,10,"Liceo Aragua de Barcelona",0,0,"C");
        $pagina->ln(30);
    
        $pagina->SetLineWidth(1);
        $pagina->SetDrawColor(52, 152, 219);
        $pagina->line(12,35,200,35);*/


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
                            $pagina->write(5,utf8_decode("Grado y Sección: ".$grado.$seccion )); $pagina->ln();
                            $pagina->write(5,utf8_decode("Año Escolar: ".$periodo)); $pagina->ln();
    
                            // *******************************

                            $pagina->SetLineWidth(1);
                            $pagina->SetDrawColor(52, 152, 219);
                            $pagina->line(12,60,200,60);
                        
                            $pagina->ln();
                            $pagina->setfont('courier','BI',16);
                            $pagina->cell(0,10,utf8_decode("Boletín Informativo"),0,0,"C");
                            $pagina->ln();
                        
                            $pagina->SetLineWidth(1);
                            $pagina->SetDrawColor(52, 152, 219);
                            $pagina->line(12,70,200,70);
                        
                            $pagina->ln();
                        
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
                            $pagina->text(18,225,"Firma Docente");
                            
                            // ***************************************
                            
                            // ******** SELLO ************
                            
                            $pagina->text(100,220,"SELLO");
                            
                            // **************************
                            
                            
                            // ****** FIRMA DIRECTOR *******//
                            
                            $pagina->line(158,220,196,220);
                            $pagina->text(161,225,"Firma Direector(a)");
                            
                            
                            
                            
                            
                            $pagina->OutPut('F','C:/carpeta/'.$fila['cie'].'.pdf');

              


               

                 

                
              
    }

 }
    
    
    
  
 










?>