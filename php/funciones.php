<?php


        function consultar($tabla, $parametro, $comparar,$conexion){

            
            $consulta_F = "SELECT * FROM $tabla WHERE $parametro = ?";
            $sentencia_F =  $conexion->prepare($consulta_F);
            $sentencia_F->execute(array($comparar));
            $respuesta_F = $sentencia_F->fetch();

            return $respuesta_F;

           
               /* if($respuesta_F){
                    return true;
                }else{
                    return false;
                }*/

        }

        function consultar2($tabla, $parametro, $parametro2, $comparar, $comparar2, $conexion){

            
            $consulta_F = "SELECT * FROM $tabla WHERE $parametro = ? AND $parametro2 = ?";
            $sentencia_F =  $conexion->prepare($consulta_F);
            $sentencia_F->execute(array($comparar,$comparar2));
            $respuesta_F = $sentencia_F->fetch();

            return $respuesta_F;

           
               /* if($respuesta_F){
                    return true;
                }else{
                    return false;
                }*/

        }

        function consultar3($tabla, $parametro, $parametro2, $parametro3,$parametro4, $comparar, $comparar2,$comparar3,$comparar4, $conexion){

            
            $consulta_F = "SELECT * FROM $tabla WHERE $parametro = ? AND $parametro2 = ? AND $parametro3=? AND $parametro4=?";
            $sentencia_F =  $conexion->prepare($consulta_F);
            $sentencia_F->execute(array($comparar,$comparar2,$comparar3,$comparar4));
            $respuesta_F = $sentencia_F->fetch();

            return $respuesta_F;

           
               /* if($respuesta_F){
                    return true;
                }else{
                    return false;
                }*/

        }

        function consultarDosTablas($tabla1,$tabla2,$parametro1,$parametro2,$parametro3,$cedula,$conexion){

            $seleccion2 = "SELECT * 
            FROM $tabla1 rep
           INNER JOIN $tabla2 est ON rep.$parametro1 = est.$parametro2 
            WHERE est.$parametro3 =".$cedula;
            $sentenciar2 = $conexion->prepare($seleccion2);
            $sentenciar2->execute(array());

            $reultados2 = $sentenciar2->fetch();

            return $reultados2;
        }

       

?>