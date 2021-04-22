


 <!-- ********** PASO 1 ************ -->
 <div class="pasos datos_personales activo text-center mr-4 " id="paso-1">
                     <h4 class="text-white" style="background: #3563A9">Datos Personales</h4>

                    
                     

                        <input type="text" class="form-control mb-2 text-center" placeholder="Cédula" readonly maxlength="8" name="cedula" value="<?php echo $resultado_per["ced_per"];?>"> 
                    




                         <!-- ******  FOTO **************  -->

                         <div class="col-md-2 text-center w-100 mb-3" style="height: 120px; width: 120px;">
                             
                                  <?php 
                                    
                                        
                                        
    
                                    echo ' <img src="../fotos/personal/'.$resultado_per["ced_per"].'.png" alt=""  class="rounded-circle" style="height: 120px; width: 120px;">;
    
    
                                        ';
    
                                 ?>
    
                          
                         
                        </div>

                    
                      

                     <input type="text" class="form-control mb-2 text-center" placeholder="Apellidos"  name="apellidos" value="<?php echo $resultado_per['apellidos'];?> "  <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>> 

                     <input type="text" class="form-control mb-2 text-center" placeholder="Nombres"  name="nombres" value="<?php echo $resultado_per['nombres'];?> "  <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>  > 
                     
                     <div class="mb-2 text-center">

                     <div class="form-check form-check-inline text-center">
                         <input class="form-check-input " checked type="radio" name="tipo"      id="inlineRadio1"  value="F" style=" height: 15px; width:15px;" 
                         
                         <?php  if($resultado_per['genero']=="F"){

                                             echo 'checked';
                            }?>   >

                           <label class="form-check-label " for="inlineRadio1">F</label>
                      </div>
                     <div class="form-check form-check-inline text-center">
                             <input class="form-check-input " type="radio" name="tipo"                  id="inlineRadio2" value="M" style=" height: 15px; width:15px;"  
                             <?php  if($resultado_per['genero']=="M"){

                                        echo 'checked';
                             }?>     >
                            <label class="form-check-label " for="inlineRadio2">M</label>
                      </div>
                     
                     </div>
                     <label for="" class=" text-center w-100 mb-1 "><span>Fecha de Nacimiento</span></label>

                     <input type="date" class="form-control" name="fecha_nac" value='<?php echo $resultado_per["fecha_nac"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>   >
                        
                          <label for="" class=" text-center w-100 mb-1 "><span>Lugar de Nacimiento</span></label>


                          <?php 
                                    $array = explode("/", $resultado_per["lugar_nac"]);
                                    
                                             
                                    
                            ?>

                          <div class="row">

                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2 w-100 text-center" name="pais"  placeholder="Pais" value="<?php echo $array[0]; ?>" <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?> >
                                
                              </div>
                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2 w-100 text-center" name="estado"  placeholder="Estado" value="<?php echo $array[1]; ?>" <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>>

                              </div>
                          </div>

                          <div class="row">

                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2  text-center" placeholder="Parroquia"  name="parroquia" value="<?php echo $array[2]; ?>" <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?> >
                                
                              </div>
                              <div class="col-md-6">

                                  <input type="text" class="form-control mb-2  text-center" placeholder="Municipio"  name="municipio" value="<?php echo $array[3]; ?>" <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>>

                              </div>
                          </div>

                        
                         
                            <button class="btn btn-primary my-2 siguiente " data-actual="1" data-siguiente="2" >Siguiente</button>
                         

                   </div>




                    <!-- ********** PASO 2 ************ -->

                   <div class="pasos datos_ubicacion text-center " id="paso-2">
                   <h4 class="text-white" style="background: #3563A9">Datos de Contacto</h4>

                    <input type="text" class="form-control mb-2 text-center" placeholder="Dirección de Habitación" name="direccion"  value='<?php echo $resultado_per["direccion"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>> 

                    <input type="text" class="form-control mb-2 text-center" placeholder="Teléfono" name="telefono" value='<?php echo $resultado_per["telefonos"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>> 

                    <input type="email" class="form-control mb-2 text-center" placeholder="E-mail" name="correo"  value='<?php echo $resultado_per["e_mail"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>> 

                    <div class="row">

                    <?php 
                                    $array = explode(":", $resultado_per["redes_sociales"]);

                                    if($array[0]=="FACEBOOK" ){
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

                           
                                
                                <select id="" class="form-select mr-1"  name="redes">
                                  <option value="<?php echo $social[0]; ?>"  ><?php echo $social[0]; ?></option>
                                  <option value="<?php echo $social[1]; ?>"><?php echo $social[1]; ?></option>
                                  <option value="<?php echo $social[2]; ?>"><?php echo $social[2]; ?></option>
                                  
                                </select>
                        </div>

                          <div class="col-md-8">
                                  <input type="text" class="form-control  text-center  mb-2" placeholder="Direccion de Red Social" name="redes2" value='<?php echo $array[1];?>' <?php  if($accion =="CP"){echo "readonly";}?>>
                          </div>
                      </div>

                      
                          <button class="btn btn-danger my-2 atras boton" data-actual="2" data-siguiente="1">Atrás</button>
                          <button class="btn btn-primary my-2 siguiente boton" data-actual="2" data-siguiente="3">Siguiente</button>
                      
                       
                    </div>
                   

                  


                     <!-- ********** PASO 3 ************ -->

                <div class="pasos datos_laborales text-center " id="paso-3">
                <h4 class="text-white" style="background: #3563A9">Datos Laborales</h4>
                      <div class="mb-2">
                          <label for="" class=" text-center my-1 w-100"><span class="">Fecha de Ingreso</span></label>

                          <input type="date" name="fecha_ing" class="form-control mb-3 " value='<?php echo $resultado_per["fecha_ing"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>>

                      </div>

                      <label for="" class=" text-center my-1 w-100"><span class="">Cargo</span></label>

                        <?php 
                            if($accion=="CP"){
                                $cargo = $resultado_per["cargo"];

                                echo '   <input type="text" class="form-control mb-3 text-center"  name="cargo" value='.$cargo.' readonly> 
                                
                                ';

                        }else{



                                    echo '
                                    
                                    <select id="" class="form-select mb-2"  name="cargo" required>

                                    <option value="Docente">Docente</option>
                                    <option value="Docente-DE">Docente-DE</option>
                                    <option value="Docente-D">Docente-D</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Obrero">Obrero</option>
                                    
                                     </select>
                                    
                                    
                                    
                                    
                                    ';




                        } ?>         

                      

                        

                    <label for="" class=" text-center my-1 w-100"><span class="">Código de cargo</span></label>
                    <input type="text" class="form-control mb-3 text-center" placeholder="Código del Cargo" name="codigo_cargo" value='<?php echo $resultado_per["cod_cargo"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>> 

                    <label for="" class=" text-center my-1 w-100"><span class="">Condición</span></label>

                    <?php
                            if($accion=="CP"){
                                $condicion = $resultado_per["condicion"];
                                echo '   <input type="text" class="form-control mb-3 text-center"  name="cargo" value='.$condicion.' readonly> 
                                
                                ';
                            }else{

                                    echo '
                                    
                                    <select id="" class="form-select mb-2"  name="condicion_cargo" required>
                                    <option value="FIJO">Fijo</option>
                                    <option value="CONTRATADO">Contratado</option>
                                    <option value="GOBERNACION">Gobernación</option>
                                    <option value="ALCALDIA">Alcaldía</option>
                                    
                                    
                                  </select>
                                    
                                    
                                    
                                    ';
                            }

                    
                    
                    
                    ?>
                      

                      <label for="" class=" text-center my-1 w-100"><span class="">Titulo</span></label>
                         <input type="text" class="form-control mb-3 text-center" placeholder="Último Título" name="titulo" value='<?php echo $resultado_per["titulo"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>>  

                         <label for="" class=" text-center my-1 w-100"><span class="">Estado</span></label>
                         <input type="text" class="form-control mb-3 text-center" name="estado" value='<?php echo $resultado_per["estatus"];?>' <?php  if($accion =="AP"){echo "required";}else{echo "readonly";} ?>>                       



                        
                   
                    
                      <button class="btn boton btn-danger my-2 atras" data-actual="3" data-siguiente="2">Atrás</button>
                      
                      <button type="submit" name="actualizar"  class="btn btn-success my-2 <?php if($accion=="CP"){echo "d-none";} ?>"   >Actualizar</button>
                    

                </div>