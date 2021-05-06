<?php ob_start();?>

<?php

$grado = $_POST["grado_seccion"]; $periodo = $_POST["periodo2"]; $lapso = $_POST["lapso"];



$zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open("boletas.zip",ZipArchive::CREATE);

 // Añadimos un directorio
 //$dir = 'Boletines/2020-2021/7A/lapso3';
 $dir = 'Boletines/'.$periodo.'/'.$grado.'/'.$lapso;

 $ruta = '../'.$dir;
 $zip->addEmptyDir($dir);

  // Abrimos la carpeta que nos pasan como parámetro

  //$ruta = "../Boletines/2020-2021/7A/lapso3";
    $dire = opendir($ruta);
    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dire)){
        // Tratamos los elementos . y .. que tienen todas las carpetas
        if( $elemento != "." && $elemento != ".."){
            // Si es una carpeta
            if( is_dir($ruta.$elemento) ){
                // Muestro la carpeta
                echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";
            // Si es un fichero
            } else {
                // Muestro el fichero
               // echo "<br />". $elemento;
                $zip->addFile($ruta."/".$elemento,$dir."/".$elemento);
            }
        }
    }

 // Una vez añadido los archivos deseados cerramos el zip.
 $zip->close();

 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
 header("Content-type: application/octet-stream");
 header("Content-disposition: attachment; filename=".$ruta.".zip");
 // leemos el archivo creado
 readfile('boletas.zip');
 // Por último eliminamos el archivo temporal creado
 unlink('boletas.zip');//Destruye el archivo temporal

  

 
?>
<?php
ob_end_flush();
?>