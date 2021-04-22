


               

                


  <!-- ********** PASO 1 ************ -->
  <div class="pasos datos_personales activo text-center mr-4 " id="paso-1">

           <h4 class="text-white" style="background: #3563A9">Datos Personales</h4>

           <input type="text" class="form-control mb-2 text-center" placeholder="Cédula" required maxlength="8" name="cedula" id="cedula_est" readonly value="<?php echo $resultado_est['ced_est'];?> ">

            <!-- ******  FOTO **************  -->

            <div class="col-md-2 text-center w-100 mb-3" style="height: 120px; width: 120px;">
                             
                             <?php 
                                    
                                        
                                        
    
                                    echo ' <img src="../fotos/estudiantes/'.$resultado_est["ced_est"].'.png" alt=""  class="rounded-circle" style="height: 120px; width: 120px;">;
    
    
                                        ';
    
                            ?>
    
                          
                         
            </div>

            <input type="text" class="form-control mb-2 text-center" placeholder="Apellidos"  name="apellidos" value="<?php echo $resultado_est['apellidos_est'];?> "  <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>> 

            <input type="text" class="form-control mb-2 text-center" placeholder="Nombres" name="nombres"  value="<?php echo $resultado_est['nombres_est'];?> "  <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>> 

            <div class="mb-2 text-center">


                     <div class="form-check form-check-inline text-center">
                         <input class="form-check-input " checked type="radio" name="tipo"      id="inlineRadio1"  value="F" style=" height: 15px; width:15px;"
                         
                         
                            <?php  if($resultado_est['genero_est']=="F"){

                                       echo 'checked';

                              }?>
                         >
                           <label class="form-check-label " for="inlineRadio1">F</label>
                      </div>

                      <div class="form-check form-check-inline text-center">
                             <input class="form-check-input " type="radio" name="tipo"                  id="inlineRadio2" value="M" style=" height: 15px; width:15px;" 
                             
                                 <?php  if($resultado_est['genero_est']=="M"){

                                        echo 'checked';

                                 }?>
                             
                             >
                            <label class="form-check-label " for="inlineRadio2">M</label>
                      </div>



            </div>

                    <label for="" class=" text-center w-100 mb-1 "><span>Fecha de Nacimiento</span></label>

                    <input type="date" class="form-control" name="fecha_nac"  value='<?php echo $resultado_est["fecha_nac_est"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?> >

                    <label for="" class=" text-center w-100 mb-1 "><span>Lugar de Nacimiento</span></label>
                           <?php 
                                    $array = explode("/", $resultado_est["lugar_nac_est"]);
                                    
                                             
                                    
                            ?>
                    
                    <div class="row">

                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2 w-100 text-center" name="pais"  placeholder="Pais" value='<?php echo $array[0];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>
                                
                              </div>
                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2 w-100 text-center" name="estado"  placeholder="Estado" value='<?php echo $array[1];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

                              </div>
                    </div>
                    <div class="row">

                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2  text-center" placeholder="Parroquia"  name="parroquia"  value='<?php echo $array[2];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?> >
                                
                              </div>
                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2  text-center" placeholder="Municipio"  name="municipio"  value='<?php echo $array[3];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

                              </div>
                    </div>

                    <button class="btn btn-primary my-2 siguiente " data-actual="1" data-siguiente="2" >Siguiente</button>




  </div>


  <!-- ********** PASO 2 ************ -->

<div class="pasos datos_ubicacion text-center " id="paso-2">



                    <h4 class="text-white" style="background: #3563A9">Datos de Contacto</h4>

                    <input type="text" class="form-control mb-2 text-center" placeholder="Dirección de Habitación" name="direccion" value="<?php echo $resultado_est['direccion_est'];?> "  <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

                    <input type="text" class="form-control mb-2 text-center" placeholder="Teléfono" name="telefono" value="<?php echo $resultado_est['telefonos_est'];?> "  <?php  if($accion =="CE"){echo "readonly";} ?>> 

                    <input type="email" class="form-control mb-2 text-center" placeholder="E-mail" name="correo"  value='<?php echo $resultado_est["e_mail_est"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>> 

            <div class="row">

                            <?php 
                                    $array = explode(":", $resultado_est["redes_sociales_est"]);

                                    if($array[0]=="FACEBOOK"){
                                        $social[0]=$array[0];
                                        $social[1]="Twitter";
                                        $social[2]="Instagram";
                                    }

                                    if($array[0]=="TWITTER"){
                                        $social[0]=$array[0];
                                        $social[1]="Facebook";
                                        $social[2]="Instagram";
                                    }
                                    if($array[0]=="INSTAGRAM"){
                                        $social[0]=$array[0];
                                        $social[1]="Facebook";
                                        $social[2]="Twitter";
                                    }
                                    
                                             
                                    
                             ?>

                <div class="col-md-4">

                                            
                                                    
                     <select id="" class="form-select mr-1"  name="redes" >
                        <option value="<?php echo $social[0]; ?>"><?php echo $social[0]; ?></option>
                        <option value="<?php echo $social[1]; ?>"><?php echo $social[1]; ?></option>
                         <option value="<?php echo $social[2]; ?>"><?php echo $social[2]; ?></option>
                    
                      </select>
                </div>

                <div class="col-md-8">
                            <input type="text" class="form-control  text-center  mb-2" placeholder="Direccion de Red Social" name="redes2" value="<?php echo $array[1];?> "  >
                </div>


            </div>

            <button class="btn btn-danger my-2 atras boton" data-actual="2" data-siguiente="1">Atrás</button>
            <button class="btn btn-primary my-2 siguiente boton" data-actual="2" data-siguiente="3">Siguiente</button>

</div>


 <!-- ********** PASO 3 ************ -->

<div class="pasos datos_laborales text-center " id="paso-3">

            <h4 class="text-white" style="background: #3563A9">Otros Datos</h4>

            <div class="mb-2">
                 <label for="" class=" text-center my-1 w-100"><span class="">Fecha de Ingreso</span></label>

                <input type="date" name="fecha_ing" class="form-control mb-2 "  value='<?php echo $resultado_est["fecha_ing_est"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>
            </div>

            <input type="text" class="form-control mb-2 text-center" placeholder="Efermedad o Discapacidad" name="enfermedad" value='<?php echo $resultado_est["enfer_dis"];?>' <?php  if($accion =="CE"){echo "readonly";} ?>> 

            <h4 class="text-white" style="background: #3563A9">Información del Representante</h4>

            <input type="text" class="form-control mb-2 text-center" placeholder="Cédula" name="cedula_rep"  id="cedula_rep"  maxlength="8" value='<?php echo $resultado_est["ced_rep"];?>' readonly>


            <!-- *****FOTO REPRESENTANTE ******-->

            <div class="col-md-2 text-center w-100 mb-3" style="height: 120px; width: 120px;">
                             
                             <?php 
                                    
                                        
                                        
    
                                    echo ' <img src="../fotos/madres_padres/'.$resultado_est["ced_rep"].'.png" alt=""  class="rounded-circle" style="height: 120px; width: 120px;">;
    
    
                                        ';
    
                               ?>
    
                          
                         
            </div>

            <input type="text" class="form-control mb-2 text-center" placeholder="Apellidos" name="apellidos_rep"  value='<?php echo $resultado_est["apellidos_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>> 

            <input type="text" class="form-control mb-2 text-center" placeholder="Nombres" name="nombres_rep" value='<?php echo $resultado_est["nombres_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

            <label for="" class=" text-center w-100 mb-1 "><span>Fecha de Nacimiento</span></label>

            <input type="date" class="form-control" name="fecha_nac_rep" value='<?php echo $resultado_est["fecha_nac_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

            <button class="btn btn-danger my-2 atras boton" data-actual="3" data-siguiente="2">Atrás</button>

            <button class="btn btn-primary my-2 siguiente boton" data-actual="3" data-siguiente="4">Siguiente</button>


</div>

 <!-- ********** PASO 4 ************ -->

 <div class="pasos datos_laborales text-center " id="paso-4">
            
        <h4 class="text-white" style="background: #3563A9">Información del Representante</h4>

        <input type="text" class="form-control mb-2 text-center" placeholder="Dirección" name="direccion_rep" value='<?php echo $resultado_est["direccion_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

        <input type="text" class="form-control mb-2 text-center" placeholder="Teléfonos" name="telefono_rep"  value='<?php echo $resultado_est["telefonos_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>>

        <input type="text" class="form-control mb-2 text-center" placeholder="E-mail" name="correo_rep" value='<?php echo $resultado_est["e_mail_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?>> 

        <input type="text" class="form-control mb-2 text-center" placeholder="Ocupación" name="ocupacion_rep" value='<?php echo $resultado_est["ocupacion_rep"];?>' <?php  if($accion =="AE"){echo "required";}else{echo "readonly";} ?> >

        <input type="text" class="form-control mb-2 text-center" placeholder="Dirección del Trabajo" name="direccion_trab_rep" value='<?php echo $resultado_est["direccion_trabajo_rep"];?>' <?php  if($accion =="CE"){echo "readonly";} ?>>

        <div class="mb-2">
                           
             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Obsevaciones...." name="observacion" value='<?php echo $resultado_est["observacion"];?>' <?php  if($accion =="CE"){echo "readonly";} ?>></textarea>
        </div>

        <button class="btn boton btn-danger my-2 atras" data-actual="4" data-siguiente="3">Atrás</button>

        <button type="submit" name="registrar" id="registrar" class="btn btn-success my-2 <?php if($accion=="CE"){echo 'd-none';} ?>" >Registrar</button>



 </div>
  
                      
                
                            
                                      

          

                    

                                   

     

          


                     








       








