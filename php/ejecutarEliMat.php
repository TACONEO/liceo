<?php ob_start();?>
<?php

session_start();
include_once 'conectar.php';
include_once 'funciones.php';

$codigo = $_POST["codigo"];



if(isset($_SESSION["admin"]) || isset($_SESSION["DOCENTE-DE"]) || isset($_SESSION["DOCENTE"]) || isset($_SESSION["ADMINISTRATIVO"])  || isset($_SESSION["DOCENTE-D"]))
{  

    $verificar = consultar("materias","cod_mat",$codigo,$conexion);

        if($verificar)
        {

                $eliminar = 'DELETE FROM materias WHERE cod_mat=?';
                $sentencia_Eli = $conexion->prepare($eliminar);
                $sentencia_Eli->execute(array($codigo));

                $conexion = null; $sentencia_F = null;
                echo json_encode("La Asignatura Fue Eliminada");

        }
        else{

            $conexion = null; $sentencia_F = null;
            echo json_encode("Error: Verifique el Código");
        }








}else{

    header( "refresh:0.5; url=../index.php" );
} 




?>
<?php ob_end_flush();?>