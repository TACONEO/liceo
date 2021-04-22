<?php

    include '../fpdf/fpdf.php';
    include '../fpdf/font/timesbi.php';

    $pagina = new fpdf();

    $pagina->addPage('portrait','letter');
   //$pagina->addfont('time',"BI","../fpdf/font/times.php");

   Class PDF extends FPDF
{


    
    function Footer(){

        $this->SetY(-15);

        $this->SetFont('courier',"B",10);
        $this->settextcolor(0,0,0);
       $this->cell(0,5,utf8_decode("Este Documento será Válido siempre que posea el Sello y las firmas solicitadas"),0,0,'C');

        



       
    }
}

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

// ******* DATOS DEL ESTUDIANTE ************************
    $pagina->setfont('courier','BI',11);
    $pagina->write(5,"Estudiante: Francisco Antonio Farias Torrealba"); $pagina->ln();
    $pagina->write(5,utf8_decode("Grado y Sección: 4A")); $pagina->ln();
    $pagina->write(5,utf8_decode("Año Escolar: 2020-2021")); $pagina->ln();

// ******************************************************************


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
    $cotador = 0;

// *************** CONTENIDO DE TABLA **************************
    while($cotador<12)
    {
        $pagina->cell(10,8,$cotador+1,1,0,"C",1);
        $pagina->cell(40,8,utf8_decode("Asignatura".$cotador),1,0,"C",1);
        $pagina->cell(30,8,utf8_decode("0"),1,0,"C",1);
        $pagina->cell(12,8,utf8_decode("0"),1,0,"C",1);
        $pagina->cell(30,8,utf8_decode("0"),1,0,"C",1);
        $pagina->cell(12,8,utf8_decode("0"),1,0,"C",1);
        $pagina->cell(30,8,utf8_decode("0"),1,0,"C",1);
        $pagina->cell(12,8,utf8_decode("0"),1,0,"C",1);
        $pagina->cell(12,8,utf8_decode("0"),1,0,"C",1);
        $pagina->ln();
        $cotador++;

    }

//*************************************************************** */

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





$pagina->OutPut();










?>