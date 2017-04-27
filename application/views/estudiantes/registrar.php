
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
                <!--<div class="col-md-12">-->
                <div class="panel panel-default">
                <div class="panel-heading">Registro De Estudiantes</div>
                <div class="panel-body">
                    <form role="form" action="<?php echo base_url(); ?>estudiantes_controller/insertar" name="" method="post" id="form_estudiantes">

                    <!--COLUMNA IZQUIERDA-->
                      <div class="col-md-6"><!--primergrupo-->
	                      <div class="panel panel-default"><!--primergrupo-->
		                      <div class="panel-body"><!--primergrupo-->
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
									  <label for="departamento_expedicion">DEPARTAMENTO DE EXPEDICION</label>
									  <div id="departamento_expedicion1">
									  <select class="form-control" id="departamento_expedicion" name="departamento_expedicion">
									    
									  </select>
									  </div>
									</div>

								  	<div class="form-group">
									  <label for="municipio_expedicion">MUNICIPIO DE EXPEDICION</label>
									  <div id="municipio_expedicion1">
									  <select class="form-control" id="municipio_expedicion" name="municipio_expedicion" disabled="disabled">
									    
									  </select>
									  </div>
									</div>
							  	</div><!--primergrupo-->
					  	   </div><!--primergrupo-->
					  
					  		<div class="panel panel-default"><!--2grupo-->
		              			<div class="panel-body"><!--2grupo-->
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
								   <!--UTILIZO ESTE CAMPO PARA DEJAR LOS PANELES DEL MISMO TAMAÑO-->
								   <div class="form-group">
								    <label style="visibility:hidden" for="espacio">APELLIDO 1</label>
								    <input type="text" class="form-control" id="espacio" name="espacio"
								           placeholder="espacio" style="visibility:hidden">
								  </div>
								</div><!--2grupo-->
							</div><!--p2grupo-->

							<!--UTILIZO ESTE CAMPO PARA DEJAR LOS PANELES DEL MISMO TAMAÑO-->
							<div class="panel panel-default" style="visibility:hidden">
			              		<div class="panel-body">
								  
								  <div class="form-group">
								    <label style="visibility:hidden" for="espacio">APELLIDO 1</label>
								    <input type="text" class="form-control" id="espacio" name="espacio"
								           placeholder="espacio" style="visibility:hidden">
								  </div>
								  <div class="form-group">
								    <label style="visibility:hidden" for="espacio">APELLIDO 1</label>
								    <input type="text" class="form-control" id="espacio" name="espacio"
								           placeholder="espacio" style="visibility:hidden">
								  </div>
								  
						  		</div>
							</div>

							<div class="panel panel-default">
			              		<div class="panel-body">
								  <div class="form-group">
								    <label for="identificacion_padre">IDENTIFICACION DEL PADRE</label>
								    <input type="text" class="form-control" id="identificacion_padre" name="identificacion_padre"
								           placeholder="Identificacion del padre">
								  </div>

								  <div class="form-group">
								    <label for="nombres_padre">NOMBRES DEL PADRE</label>
								    <input type="text" class="form-control" id="nombres_padre" name="nombres_padre"
								           placeholder="Nombres">
								  </div>

								  <div class="form-group">
								    <label for="apellidos_padre">APELLIDOS DEL PADRE</label>
								    <input type="text" class="form-control" id="apellidos_padre" name="apellidos_padre"
								           placeholder="Apellidos">
								  </div>

								  <div class="form-group">
								    <label for="ocupacion_padre">OCUPACION DEL PADRE</label>
								    <input type="text" class="form-control" id="ocupacion_padre" name="ocupacion_padre"
								           placeholder="Ocupacion">
								  </div>

								  <div class="form-group">
								    <label for="telefono_padre">TELEFONO</label>
								    <input type="text" class="form-control" id="telefono_padre" name="telefono_padre"
								           placeholder="Telefono">
								  </div>

								  <div class="form-group">
								    <label for="telefono_trabajo_padre">TELEFONO TRABAJO</label>
								    <input type="text" class="form-control" id="telefono_trabajo_padre" name="telefono_trabajo_padre"
								           placeholder="Telefono Trabajo">
								  </div>

								  <div class="form-group">
								    <label for="direccion_trabajo_padre">DIRECCION TRABAJO</label>
								    <input type="text" class="form-control" id="direccion_trabajo_padre" name="direccion_trabajo_padre"
								           placeholder="Direccion Trabajo">
								  </div>

						  		</div>
							</div>

						</div>

						<!--COLUMNA DERECHA-->
						<div class="col-md-6"><!--3grupo-->
							<div class="panel panel-default"><!--3grupo-->
		              			<div class="panel-body"><!--3grupo-->
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
									  <label for="poblacion">POBLACION</label>
									  <input type="text" class="form-control" id="poblacion" name="poblacion" placeholder="Poblacion">
									  
									</div>
								</div><!--3grupo-->
							</div><!--3grupo-->
						
							<div class="panel panel-default"><!--4grupo-->
		              			<div class="panel-body"><!--4grupo-->
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
								    <label style="visibility:hidden" for="espacio">APELLIDO 1</label>
								    <input type="text" class="form-control" id="espacio" name="espacio"
								           placeholder="espacio" style="visibility:hidden">
								  </div>
					  			</div><!--4grupo-->
							</div><!--4grupo-->
					  
						  	<div class="panel panel-default"><!--5grupo-->
			              		<div class="panel-body"><!--5grupo-->
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

								  <!--<div class="form-group">
								  	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="form-control">
								  </div>-->
								  
						  		</div><!--5grupo-->
							</div><!--5grupo-->

							<div class="panel panel-default">
			              		<div class="panel-body">
								  <div class="form-group">
								    <label for="identificacion_madre">IDENTIFICACION DE LA MADRE</label>
								    <input type="text" class="form-control" id="identificacion_madre" name="identificacion_madre"
								           placeholder="Identificacion de la madre">
								  </div>

								  <div class="form-group">
								    <label for="nombres_madre">NOMBRES DE LA MADRE</label>
								    <input type="text" class="form-control" id="nombres_madre" name="nombres_madre"
								           placeholder="Nombres">
								  </div>

								  <div class="form-group">
								    <label for="apellidos_madre">APELLIDOS DE LA MADRE</label>
								    <input type="text" class="form-control" id="apellidos_madre" name="apellidos_madre"
								           placeholder="Apellidos">
								  </div>

								  <div class="form-group">
								    <label for="ocupacion_madre">OCUPACION DE LA MADRE</label>
								    <input type="text" class="form-control" id="ocupacion_madre" name="ocupacion_madre"
								           placeholder="Ocupacion">
								  </div>

								  <div class="form-group">
								    <label for="telefono_madre">TELEFONO</label>
								    <input type="text" class="form-control" id="telefono_madre" name="telefono_madre"
								           placeholder="Telefono">
								  </div>

								  <div class="form-group">
								    <label for="telefono_trabajo_madre">TELEFONO TRABAJO</label>
								    <input type="text" class="form-control" id="telefono_trabajo_madre" name="telefono_trabajo_madre"
								           placeholder="Telefono Trabajo">
								  </div>

								  <div class="form-group">
								    <label for="direccion_trabajo_madre">DIRECCION TRABAJO</label>
								    <input type="text" class="form-control" id="direccion_trabajo_madre" name="direccion_trabajo_madre"
								           placeholder="Direccion Trabajo">
								  </div>
								  
						  		</div>
							</div>

							<button type="submit" name="btn_registrar" id="btn_registrar" class="btn btn-primary btn-lg btn-block">Registrar</button>

					  </div><!--5grupo-->

					  <!--<div class="col-md-6">
					  <button type="submit" name="btn_registrar" id="btn_registrar" class="btn btn-primary btn-lg btn-block">Registrar</button>
					  </div>-->
					</form>
                </div>
                </div>
                </div>

            </div>
            
            <!-- ... Your content goes here ... -->

        </div>
