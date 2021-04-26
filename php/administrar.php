<?php

    session_start();
    
    if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["ADMINISTRATIVO"])  || isset($_SESSION["DOCENTE-D"])){

     
          
        if(isset($_SESSION["admin"])){$sesion = $_SESSION["admin"];}
        if(isset($_SESSION["DOCENTE-DE"])){$sesion = $_SESSION["DOCENTE-DE"];}
        if(isset($_SESSION["DOCENTE-D"])){$sesion = $_SESSION["DOCENTE-D"];}
        if(isset($_SESSION["DOCENTE"])){$sesion = $_SESSION["DOCENTE"];}
        if(isset($_SESSION["ADMINISTRATIVO"])){$sesion = $_SESSION["ADMINISTRATIVO"];}


           
           
    }else{

          if(isset($_SESSION["estudiante"])){

            header( "refresh:0.5; url= mod_estudiantes.php" );
          }else{

            header( "refresh:0.5; url=../index.php" );
          }

       
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

<style>


  /* .burbuja{
       
        background: #3563A9;
        opacity: .3;
        position: absolute;
        bottom: -90;
        border-radius: 50%;

        animation: burbujas 2s linear infinite;

    }

    .burbuja:nth-child(1){

      width: 80px; height: 80px;  left:5%;

      animation-duration: 2s;

    }

    .burbuja:nth-child(2){

        width: 100px; height: 100px;  left:35%;

          animation-duration: 4s;

}

.burbuja:nth-child(3){

width: 60px; height: 60px;  left:55%;

  animation-duration: 5s;

}

.burbuja:nth-child(4){

width: 120px; height: 120px;  left:85%;

  animation-duration: 4s;

}
.burbuja:nth-child(5){

width: 60px; height: 60px;  left:45%;

  animation-duration: 2.4s;

}

    @keyframes burbujas {

      0%{bottom: 0; opacity: 0;}
      30%{ transform: translateX(20px);}
      40%{  transform: translateX(14px);}
      50%{opacity: .4;}
      100%{ bottom: 100vh; opacity: 0;}
      
    }*/



</style>

<title>LICEO ARAGUA DE BARCELONA</title>
 </head>
 <body class="admin">

 <!-- NAV-->
 <nav class="navbar navbar-expand-md navbar-light container-fluid sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand ancla_logo  p-1 " href="#">

          <img src="../img/logo.png" alt="logo" class="rounded-circle logo">
          <div class="p-2 nombre_logo">Liceo Aragua de Barcelona</div>
      </a>
      <button class="navbar-toggler border border-white " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse   justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav p-2 ">
          
         
        <li class="nav-items enlaces_nav  d-flex" >
            <a href="" class=" text-white fs-5 fw-bold mx-2 align-items-center">Bienvenido: <?php echo $sesion ?></a>

            <a href="cerrar.php" class="btn btn-outline-light fw-bold ">Cerrar</a>
            
        </li>

          <li class="nav-items enlaces_nav" >
           
          </li>
         

          
        </ul>
        
      </div>
    </div>
  </nav>
   <!-- FIN NAV-->

   <section class="container-fluid " style="background: #E5E8E8 ; opacity:.7;">

   <?php if (isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE-D"])): ?>

      <div class="row ">

          <div class="col-md-3  text-center p-3">

              <a href="registro_per.php" class="btn btn-outline-danger p-3 fs-5 fw-bold">Registro de Personal</a>
          </div>
          <div class="col-md-3  p-3 text-center">
          <a href="registro_est.php" class="btn btn-outline-success   p-3 fs-5 fw-bold">Registro de Estudiantes</a>
          </div>
         
          <div class="col-md-3  p-3 text-center">
          <a href="cae.php" class="btn btn-outline-primary p-3 fs-5 fw-bold ">Acciones C A E</a>
          </div>

          <div class="col-md-3  p-3 text-center">
              <a href="materias.php" class="btn btn-outline-danger p-3 fs-5 fw-bold ">Cargar Asignaturas</a>
        </div>
         
      </div>

     

      <div class="row my-2 ">

          <div class="col-md-3  text-center p-3">

              <a href="doc_mat_secc.php
              " class="btn btn-outline-primary p-3 fs-5 fw-bold">Asignar Sección</a>
          </div>

          <div class="col-md-3  p-3 text-center">
          <a href="inscripcion.php" class="btn btn-outline-dark  p-3 fs-5 fw-bold">Inscripción</a>
          </div>

        
             <div class="col-md-3  p-3 text-center">
             <a href="notas.php" class="btn btn-outline-danger p-3 fs-5 fw-bold ">Cargar Notas</a>
              </div>


            <div class="col-md-3  p-3 text-center">
                <a href="boletin_datos.php" class="btn btn-outline-success p-3 fs-5 fw-bold">Generar Boletín</a>
           </div>
       

      </div>

      <div class="row my-2 ">
         <div class="col-md-3  text-center p-3">

            <a href="consultaMateria.php" class="btn btn-outline-dark p-3 fs-5 fw-bold">Consultar Asignatura</a>
        </div>

        <div class="col-md-3  text-center p-3">

            <a href="actualizaMateria.php" class="btn btn-outline-success p-3 fs-5 fw-bold">Actualizar Asignatura</a>
        </div>

        <div class="col-md-3  text-center p-3">

            <a href="eliminarMateria.php" class="btn btn-outline-primary p-3 fs-5 fw-bold">Eliminar Asignatura</a>
        </div>
        
       
          
      </div>
    <?php endif ?>





   <?php if (isset($_SESSION["ADMINISTRATIVO"])): ?>

      <div class="row">

            <div class="col-md-6 p-3 text-center">
                
              <a href="registro_est.php" class="btn btn-outline-success  p-3 fs-5 fw-bold">Registro de Estudiantes</a>
            
            </div>

            <div class="col-md-6 p-3 text-center">

                     <a href="cae.php" class="btn btn-outline-warning p-3 fs-5 fw-bold ">Acciones C A E</a>
            </div>
      </div>

      <div class="row my-2">

                <div class="col-md-6 p-3 text-center">

                       <a href="inscripcion.php" class="btn btn-outline-dark  p-3 fs-5 fw-bold">Inscripción</a>
                </div>
                <div class="col-md-6 p-3 text-center">

                       <a href="" class="btn btn-primary p-3 fs-5 fw-bold ">Consultas Avanzadas</a>
                </div>
      </div>



    <?php endif ?>



   </section>
     

<div class="burbujas container-fluid">
    <div class="burbuja"></div>
    <div class="burbuja"></div>
    <div class="burbuja"></div>
    <div class="burbuja"></div>
    <div class="burbuja"></div>

</div>
 <script src="../js/bootstrap.bundle.min.js" ></script>
<script src="../js/jquery-3.5.1.min.js"></script>


 </body>
 </html>