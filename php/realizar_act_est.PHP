<?php

include_once 'conectar.php';
//include_once 'funciones.php';






$cedula = $_POST["cedula"]; $apellidos = strtoupper($_POST["apellidos"]);
$nombres = strtoupper($_POST["nombres"]); $tipo = $_POST["tipo"];
$fecha_nac = $_POST["fecha_nac"]; $pais = strtoupper($_POST["pais"]); $estado = strtoupper($_POST["estado"]); $municipio = strtoupper($_POST["municipio"]);$parroquia = strtoupper($_POST["parroquia"]); $direccion = strtoupper($_POST["direccion"]); $telefono = $_POST["telefono"];
$correo = strtoupper($_POST["correo"]); $redes = $_POST["redes"];  $redes2 = strtoupper($_POST["redes2"]); $fecha_ing = $_POST["fecha_ing"];  $enfermedad = strtoupper($_POST["enfermedad"]);
$status= "ACTIVO";

// INFORMACION REPRESENTANTE
$cedula_rep = $_POST["cedula_rep"]; $apellidos_rep = strtoupper($_POST["apellidos_rep"]); $nombres_rep = strtoupper($_POST["nombres_rep"]); $fecha_nac_rep = $_POST["fecha_nac_rep"];
$direccion_rep =  strtoupper($_POST["direccion_rep"]); $telefono_rep = $_POST["telefono_rep"];
$correo_rep = $_POST["correo_rep"]; $ocupacion_rep =  strtoupper($_POST["ocupacion_rep"]);
$direccion_trab_rep =  strtoupper($_POST["direccion_trab_rep"]); $observacion =  strtoupper($_POST["observacion"]);



$editar_rep = "UPDATE representantes SET apellidos_rep=?,nombres_rep=?,fecha_nac_rep=?,direccion_rep=?,telefonos_rep=?,e_mail_rep=?,ocupacion_rep=?,direccion_trabajo_rep=? WHERE ced_rep=? ";
$sentencia_edit_rep = $conexion->prepare($editar_rep);
$sentencia_edit_rep->execute(array($apellidos_rep,$nombres_rep,$fecha_nac_rep,$direccion_rep,$telefono_rep,$correo_rep,$ocupacion_rep,$direccion_trab_rep,$cedula_rep));



$lugar_nacimiento = $pais."/".$estado."/".$municipio."/".$parroquia;
$red_social = $redes.": ".$redes2;


$editar_est = "UPDATE estudiantes SET apellidos_est=?,nombres_est=?,genero_est=?,fecha_nac_est=?,lugar_nac_est=?,direccion_est=?,telefonos_est=?,e_mail_est=?,redes_sociales_est=?,fecha_ing_est=?,cedu_rep=?,enfer_dis=?,estatus_est=?,observacion=? WHERE ced_est=?";

$sentencia_edit_est = $conexion->prepare($editar_est);

$sentencia_edit_est->execute(array($apellidos,$nombres,$tipo,$fecha_nac,$lugar_nacimiento,$direccion,$telefono,$correo,$red_social,$fecha_ing,$cedula_rep,$enfermedad,$status,$observacion,$cedula));

$conexion = null;  $sentencia_edit_est=null; $sentencia_edit_rep=null;

echo json_encode("ACTUALIZACIÓN EXITOSA!!!");






?>


