<?php ob_start();?>
<?php
        session_start();

        if(isset($_SESSION["estudiante"])){

            echo '<script language="javascript">alert("USUARIO '.$_SESSION['estudiante'].' Éxito ");</script>';

           echo '  <a href="cerrar.php" class="btn btn-outline-light  ">Cerrar</a>';
        }else{

            header( "refresh:0.1; url=../index.php" );

        }

?>
<?php ob_end_flush();?>