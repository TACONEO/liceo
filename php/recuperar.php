<?php ob_start();?>
<script > 



if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}

</script>
<?php ob_end_flush();?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>

        <?php  include_once "arriba.php"; ?>

        
</head>
<body class="bg-white" >
    
   
   
   
   


              
                <div class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content"  style=" background: rgba(255,255,255,1);">
                    <div class="modal-header  text-white" style=" background:rgba(13,110,253,0.8);">
                      <h5 class="modal-title w-100  text-center text-white  fs-4 fw-bold">Recuperar Contraseña</h5>
                    
                      
                    </div>
                    <div class="modal-body">
                      <form action="recuperar2.php" method="POST" id="recuperar">
                              <input type="text" required maxlength="8" class="form-control text-center mb-3 fs-5 fw-bold" name="usuario" placeholder="Ingrese Usuario" autocomplete="off">

                              
                                <div class="mb-3 text-center">

                                      <div class="form-check form-check-inline text-center">
                                            <input class="form-check-input " checked type="radio" name="tipo"      id="inlineRadio1"  value="usuarios" style=" height: 15px; width:15px;">
                                              <label class="form-check-label " for="inlineRadio1">Personal</label>
                                      </div>
                                      <div class="form-check form-check-inline text-center">
                                            <input class="form-check-input " type="radio" name="tipo"                  id="inlineRadio2" value="usuarios2" style=" height: 15px; width:15px;">
                                              <label class="form-check-label " for="inlineRadio2">Estudiante</label>
                                            </div>
           
                                  </div>


              
                             <div class="w-100  text-center"> 
                               <button class="btn btn-primary w-75 fs-5 fw-bold" name="enviar">Enviar</button>
                              </div>
                              <hr>
                      
                      </form>
                      <div class=" w-100 text-center " >
                          <a href="../index.php" class="btn btn-danger w-50 form-control fs-5 fw-bold">Regresar</a>
                     
                    </div>
                    </div>
                    
                   
                  </div>
                </div>
              </div>
                
                
                


          



                  


                  
               
                                    

                    
               


        <?php  include_once 'abajo.php'; ?>
        

        <script>
       
                $(document).ready(function()
                    {
                         
                                 
                           $(".modal").modal("show");

                                   
                             
                                               

                   
                    });

            
            var form = document.getElementById("recuperar");


            form.cedula.addEventListener('keypress', function (e){
                    if (!soloNumeros(event)){
                            e.preventDefault();

                        }
                })


            





            // Solo permite introducir numeros.
            function soloNumeros(e){
                            var key = e.charCode;
                           
                            return key >= 48 && key <= 57;
                        }


                    

     
       </script>

       

</body>
</html>