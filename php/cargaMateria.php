<?php


     
    session_start();

if(!isset($_SESSION["admin"]) && !isset($_SESSION["DOCENTE-DE"]) && !isset($_SESSION["DOCENTE"]) && !isset($_SESSION["DOCENTE-D"]) && !isset($_SESSION["ADMINISTRATIVO"]))
{
      
          header( "refresh:0.1; url=../index.php" );
}
else
{

        include_once 'conectar.php';

        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $area =  $_POST["area"];
        $grado =  $_POST["grado"];

        include_once 'funciones.php';


        $resultado = consultar("materias","cod_mat",$codigo,$conexion);

        if(!$resultado){

            $guardar = "INSERT INTO materias (cod_mat,nombre_mat,grado,area) VALUES (?,?,?,?)";
            $preparar_G = $conexion->prepare($guardar);
            $preparar_G->execute(array($codigo,$nombre,$grado,$area));

            $conexion = null; $preparar_G = null;  $sentencia_F = null;

            echo json_encode('Asignatura Cargada con Éxito!!!');
        }
        else{

            $conexion = null;  $sentencia_F = null;
            echo json_encode ("Atención: Este Código ya Existe Registrado");
        }

      
      











}


?>