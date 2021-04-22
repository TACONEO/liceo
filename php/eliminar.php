<label class="form-check-label w_100   mb-2 fs-5 fw-bold" for="inlineRadio2">Confirme la Eliminación</label>

<input type="text" class="form-control text-center mb-2 " name="cedula" placeholder="Ingrese su Cédula" maxlength="8" readonly value="<?php echo $general ?>">



<input type="text" class="form-control text-center mb-2 d-none" name="opcion" placeholder="Ingrese su Cédula" maxlength="8" readonly value="<?php echo $accion ?>">



<button class="btn btn-primary mt-2 form-control" id="confirmar" type="submit" name="confirmar">Confirmar</button>

<a href="consultar.php" class="btn btn-danger form-control mt-2">Atrás</a>