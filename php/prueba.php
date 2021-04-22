<?php

   /* include_once 'conectar.php';

    $prueba = "12819998";

    $seleccion = "SELECT * FROM personal C, personal_usu_ci O, usuario u WHERE C.ced_per = O.cedula_vin AND u.usuario = o.usuario_vin";
    $sentenciar = $conexion->prepare($seleccion);
    $sentenciar->execute(array());

    $reultados = $sentenciar->fetch();

    var_dump ($reultados);*/

      $entero = 05; $cadena = "07";

      $string = strval($entero); $entero2 = intval($cadena);

      echo $string; echo "<br>";
      echo $entero2+2;
  ?>  