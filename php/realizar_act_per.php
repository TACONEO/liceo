<?php ob_start();?>
<?php

include_once 'conectar.php';





$cedula = $_POST["cedula"]; $apellidos = strtoupper($_POST["apellidos"]);
        $nombres = strtoupper($_POST["nombres"]); $tipo = $_POST["tipo"];
        $fecha_nac = $_POST["fecha_nac"]; $pais = strtoupper($_POST["pais"]); $estado = strtoupper($_POST["estado"]); $municipio = strtoupper($_POST["municipio"]);$parroquia = strtoupper($_POST["parroquia"]); $direccion = strtoupper($_POST["direccion"]); $telefono = $_POST["telefono"];
        $correo = strtoupper($_POST["correo"]); $redes = strtoupper($_POST["redes"]);  $redes2 = strtoupper($_POST["redes2"]); $fecha_ing = $_POST["fecha_ing"];  $cargo = strtoupper($_POST["cargo"]);
        $codigo_cargo = strtoupper($_POST["codigo_cargo"]); $condicion_cargo = $_POST["condicion_cargo"]; $titulo = strtoupper($_POST["titulo"]);
        $status= strtoupper($_POST["estado"]) ;

        $lugar_nacimiento = $pais."/".$estado."/".$municipio."/".$parroquia;
        $red_social = $redes.": ".$redes2;


        $actualizar_per = 'UPDATE personal SET apellidos=?,nombres=?,genero=?,fecha_nac=?,lugar_nac=?,direccion=?,telefonos=?,e_mail=?,redes_sociales=?,fecha_ing=?,cargo=?,cod_cargo=?,condicion=?,titulo=?,estatus=? WHERE ced_per=?';

                  $sentencia_act_per = $conexion->prepare($actualizar_per);

                  $sentencia_act_per->execute(array($apellidos,$nombres,$tipo,$fecha_nac,$lugar_nacimiento,$direccion,$telefono,$correo,$red_social,$fecha_ing,$cargo,$codigo_cargo,$condicion_cargo,$titulo,$status,$cedula));

            $conexion=null; $sentencia_act_per=null;

            echo json_encode("ACTUALIZACIÓN EXITOSA!!!");

?>
<?php ob_end_flush();?>