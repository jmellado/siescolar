
	<style type="text/css">
	    
	    label.error{color:red;}
	</style>
<!--
</body>
</html>-->
		<div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="panel panel-default">
                <div class="panel-heading">Registro De Estudiantes</div>
                <div class="panel-body">
                    <form role="form" action="<?php echo base_url(); ?>estudiantes_controller/insertar" name="" method="post" id="form_estudiantes">
					  <div class="form-group">
					    <label for="identificacion">IDENTIFICACION</label>
					    <input type="text" class="form-control" id="identificacion" name="identificacion"
					           placeholder="Introduce tu identificación">
					  </div>

					  <div class="form-group">
						  <label for="tipo_id">TIPO DE IDENTIFICACION:</label>
						  <select class="form-control" id="tipo_id" name="tipo_id">
						    <option value="rc">RC</option>
							<option value="ti">TI</option>
							<option value="cc">CC</option>
							<option value="ce">CE</option>
						  </select>
						</div>

						<div class="form-group">
					    <label for="fecha_expedicion">FECHA DE EXPEDICION</label>
					    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion">

					  	</div>

					  <div class="form-group">
					    <label for="nombres">NOMBRES</label>
					    <input type="text" class="form-control" id="nombres" name="nombres"
					           placeholder="Nombres">
					  </div>

					  <div class="form-group">
					    <label for="apellido1">APELLIDO 1</label>
					    <input type="text" class="form-control" id="apellido1" name="apellido1"
					           placeholder="Primer apellido">
					  </div>

					  <div class="form-group">
					    <label for="apellido2">APELLIDO 2</label>
					    <input type="text" class="form-control" id="apellido2" name="apellido2"
					           placeholder="Segundo apellido">
					  </div>

					  <div class="form-group">
						  <label for="sexo">SEXO:</label>
						  <select class="form-control" id="sexo" name="sexo">
						    <option value="m">Masculino</option>
		  					<option value="f">Femenino</option>
						  </select>
						</div>

					  <div class="form-group">
					    <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
					    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">

					  </div>

					  <div class="form-group">
						  <label for="lugar_nacimiento">LUGAR DE NACIMIENTO</label>
						  <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" placeholder="Lugar de Nacimiento">
						  
						</div>

						<div class="form-group">
						  <label for="tipo_sangre">TIPO DE SANGRE:</label>
						  <select class="form-control" id="tipo_sangre" name="tipo_sangre">
						    <option value="o+">O+</option>
		  					<option value="o-">O-</option>
		  					<option value="a+">A+</option>
		  					<option value="a-">A-</option>
		  					<option value="b+">B+</option>
		  					<option value="b-">B-</option>
						  </select>
						</div>

						<div class="form-group">
						  <label for="eps">EPS</label>
						  <input type="text" class="form-control" id="eps" name="eps" placeholder="Eps">
						  
						</div>

					  <div class="form-group">
					    <label for="telefono">TELEFONO</label>
					    <input type="text" class="form-control" id="telefono" name="telefono"
					           placeholder="Telefono">
					  </div>

					  <div class="form-group">
					    <label for="correo">CORREO</label>
					    <input type="text" class="form-control" id="correo" name="correo"
					           placeholder="Correo">
					  </div>

					  <div class="form-group">
					    <label for="direccion">DIRECCION</label>
					    <input type="text" class="form-control" id="direccion" name="direccion"
					           placeholder="Direccion">
					  </div>

					  <div class="form-group">
					    <label for="barrio">BARRIO</label>
					    <input type="text" class="form-control" id="barrio" name="barrio"
					           placeholder="Barrio">
					  </div>

					  <div class="form-group">
					    <label for="institucion_procedencia">INSTITUCION DE PROCEDENCIA</label>
					    <input type="text" class="form-control" id="institucion_procedencia" name="institucion_procedencia"
					           placeholder="Institucion Procedencia">
					  </div>

					  <div class="form-group">
					    <label for="discapacidad">DISCAPACIDAD</label>
					    <input type="text" class="form-control" id="discapacidad" name="discapacidad"
					           placeholder="Discapacidad">
					  </div>

					  <div class="form-group">

					  	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="form-control">
					    
					  </div>

					  <button type="submit" name="btn_registrar" id="btn_registrar" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</form>
                </div>
                </div>
                </div>

                


            </div>



            <!-- ... Your content goes here ... -->

        </div>
