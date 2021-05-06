<?php ob_start();?>
<?php


include_once 'conectar.php';

    $datos = $_POST['cedula'];
    $opcion = $_POST['opcion'];

    if($opcion == "EE"){

        $tabla = "estudiantes"; $condicion = "ced_est";
        unlink("../fotos/estudiantes/$datos.png");
    }

    if($opcion == "EP"){

        $tabla = "personal"; $condicion = "ced_per";

        unlink("../fotos/personal/$datos.png");
    }

    $eliminar = "DELETE FROM $tabla WHERE $condicion = ?";
    $sentencia_E = $conexion->prepare($eliminar);
    $sentencia_E->execute(array($datos));

    if($sentencia_E){

        echo json_encode("LA PERSONA CON NÚMERO DE ".$datos." FUE ELIMINAD@");
    }
    else{

        echo json_encode("NO REGISTRAD@");
    }

?>
<?php ob_end_flush();?>