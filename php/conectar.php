<?php

    $us = "root";
    $contra = "";

try {
    
    $conexion = new PDO('mysql:host=localhost;dbname=liceo', $us, $contra);

    

   
  
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>