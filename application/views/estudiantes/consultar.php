
	<style type="text/css">
	    
	    label.error{color:red;}
	</style>

	

<!--</body>
</html>-->

<div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">BIENVENIDO</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-inline" role="form">
					  <div class="form-group">
					    <label class="sr-only" for="id_buscar">Email</label>
					    <input type="text" class="form-control" id="id_buscar" name="id_buscar"
					           placeholder="Introduce tu nombre">
					  </div>

					  <button type="submit" name="btn_buscar" id="btn_buscar" class="btn btn-primary">Buscar</button>
					</form></br></br>
                </div>
            </div>

      
            <div class="row">
            	
             		<div class="col-md-12">
             			<div class="form-group">
						  <label for="cantidad">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad" name="cantidad" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div id="lista_estudiantes" class="table-responsive">
					 
						</div>

						<div class="text-center paginacion">
						
						</div>
					
                	</div>

                
                


                <!--<div class="col-md-3">
                <div class="panel panel-default">
                <div class="panel-heading">Actualizar Estudiantes</div>
                <div class="panel-body">
                    <form role="form" id="form_estudiantes_actualizar">
					  <div class="form-group">
					    <label for="id">IDENTIFICACION</label>
					    <input type="text" class="form-control" id="idsele" name="id"
					           placeholder="Introduce tu identificación" disabled="disabled">
					  </div>

					  <div class="form-group">
						  <label for="tipo_sangre">TIPO DE IDENTIFICACION:</label>
						  <select class="form-control" id="tipo_idsele" name="tipo_id" disabled="disabled">
						    <option value="rc">RC</option>
							<option value="ti">TI</option>
							<option value="cc">CC</option>
							<option value="ce">CE</option>
						  </select>
						</div>

					  <div class="form-group">
					    <label for="nombres">NOMBRES</label>
					    <input type="text" class="form-control" id="nombressele" name="nombres"
					           placeholder="Nombres" disabled="disabled">
					  </div>

					  <div class="form-group">
					    <label for="apellido1">APELLIDO 1</label>
					    <input type="text" class="form-control" id="apellido1sele" name="apellido1"
					           placeholder="Primer apellido" disabled="disabled">
					  </div>

					  <div class="form-group">
					    <label for="apellido2">APELLIDO 2</label>
					    <input type="text" class="form-control" id="apellido2sele" name="apellido2"
					           placeholder="Segundo apellido" disabled="disabled">
					  </div>

					  <div class="form-group">
						  <label for="sexo">SEXO:</label>
						  <select class="form-control" id="sexosele" name="sexo" disabled="disabled">
						    <option value="m">Masculino</option>
		  					<option value="f">Femenino</option>
						  </select>
						</div>

					  <div class="form-group">
					    <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
					    <input type="date" class="form-control" id="fecha_nacimientosele" name="fecha_nacimiento" disabled="disabled">

					  </div>

						<div class="form-group">
						  <label for="tipo_sangre">TIPO DE SANGRE:</label>
						  <select class="form-control" id="tipo_sangresele" name="tipo_sangre" disabled="disabled">
						    <option value="o+">O+</option>
		  					<option value="o-">O-</option>
		  					<option value="a+">A+</option>
		  					<option value="a-">A-</option>
		  					<option value="b+">B+</option>
		  					<option value="b-">B-</option>
						  </select>
						</div>

					  <div class="form-group">
					    <label for="telefono">TELEFONO</label>
					    <input type="text" class="form-control" id="telefonosele" name="telefono"
					           placeholder="Telefono" disabled="disabled">
					  </div>

					  <div class="form-group">
					    <label for="correo">CORREO</label>
					    <input type="text" class="form-control" id="correosele" name="correo"
					           placeholder="Correo" disabled="disabled">
					  </div>

					  <div class="form-group">
					    <label for="direccion">DIRECCION</label>
					    <input type="text" class="form-control" id="direccionsele" name="direccion"
					           placeholder="Direccion" disabled="disabled">
					  </div>

					  <div class="form-group">
					    <label for="barrio">BARRIO</label>
					    <input type="text" class="form-control" id="barriosele" name="barrio"
					           placeholder="Barrio" disabled="disabled">
					  </div>

					  <div class="form-group">

					  	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="form-control">
					    
					  </div>

					  
					</form>

					<button type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-primary btn-lg btn-block">Actualizar</button>
                </div>
                </div>
                </div>-->

            </div>



    <!-- ... Your content goes here ... -->
    <!--<style>
    #tamano{
      width: 80% !important;
    }
  </style>}-->
        </div>


			        <!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog" id="tamano">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">ACTUALIZAR INFORMACION </h4>
			      </div>
			      <div class="modal-body">

			        			<form role="form" id="form_estudiantes_actualizar">
			        				<div class="form-group">
								    
								    	<input type="hidden" class="form-control" id="id_personasele" name="id_persona">
								  	</div>

								  <div class="form-group">
								    <label for="identificacion">IDENTIFICACION</label>
								    <input type="text" class="form-control" id="idsele" name="identificacion"
								           placeholder="Introduce tu identificación" disabled="disabled">
								  </div>

								  <div class="form-group">
									  <label for="tipo_id">TIPO DE IDENTIFICACION:</label>
									  <select class="form-control" id="tipo_idsele" name="tipo_id" disabled="disabled">
									    <option value="rc">RC</option>
										<option value="ti">TI</option>
										<option value="cc">CC</option>
										<option value="ce">CE</option>
									  </select>
									</div>

									<div class="form-group">
								    <label for="fecha_expedicion">FECHA DE EXPEDICION</label>
								    <input type="date" class="form-control" id="fecha_expedicionsele" name="fecha_expedicion">

								  	</div>

								  <div class="form-group">
								    <label for="nombres">NOMBRES</label>
								    <input type="text" class="form-control" id="nombressele" name="nombres"
								           placeholder="Nombres" disabled="disabled">
								  </div>

								  <div class="form-group">
								    <label for="apellido1">APELLIDO 1</label>
								    <input type="text" class="form-control" id="apellido1sele" name="apellido1"
								           placeholder="Primer apellido" disabled="disabled">
								  </div>

								  <div class="form-group">
								    <label for="apellido2">APELLIDO 2</label>
								    <input type="text" class="form-control" id="apellido2sele" name="apellido2"
								           placeholder="Segundo apellido" disabled="disabled">
								  </div>

								  <div class="form-group">
									  <label for="sexo">SEXO:</label>
									  <select class="form-control" id="sexosele" name="sexo" disabled="disabled">
									    <option value="m">Masculino</option>
					  					<option value="f">Femenino</option>
									  </select>
									</div>

								  <div class="form-group">
								    <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
								    <input type="date" class="form-control" id="fecha_nacimientosele" name="fecha_nacimiento" disabled="disabled">

								  </div>

								  	<div class="form-group">
									  <label for="lugar_nacimiento">LUGAR DE NACIMIENTO</label>
									  <input type="text" class="form-control" id="lugar_nacimientosele" name="lugar_nacimiento" placeholder="Lugar de Nacimiento">
									  
									</div>

									<div class="form-group">
									  <label for="tipo_sangre">TIPO DE SANGRE:</label>
									  <select class="form-control" id="tipo_sangresele" name="tipo_sangre" disabled="disabled">
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
									  <input type="text" class="form-control" id="epssele" name="eps" placeholder="Eps">
									  
									</div>

								  <div class="form-group">
								    <label for="telefono">TELEFONO</label>
								    <input type="text" class="form-control" id="telefonosele" name="telefono"
								           placeholder="Telefono" disabled="disabled">
								  </div>

								  <div class="form-group">
								    <label for="correo">CORREO</label>
								    <input type="text" class="form-control" id="correosele" name="correo"
								           placeholder="Correo" disabled="disabled">
								  </div>

								  <div class="form-group">
								    <label for="direccion">DIRECCION</label>
								    <input type="text" class="form-control" id="direccionsele" name="direccion"
								           placeholder="Direccion" disabled="disabled">
								  </div>

								  <div class="form-group">
								    <label for="barrio">BARRIO</label>
								    <input type="text" class="form-control" id="barriosele" name="barrio"
								           placeholder="Barrio" disabled="disabled">
								  </div>

								  <div class="form-group">
								    <label for="institucion_procedencia">INSTITUCION DE PROCEDENCIA</label>
								    <input type="text" class="form-control" id="institucion_procedenciasele" name="institucion_procedencia"
								           placeholder="Institucion Procedencia">
								  </div>

								  <div class="form-group">
								    <label for="discapacidad">DISCAPACIDAD</label>
								    <input type="text" class="form-control" id="discapacidadsele" name="discapacidad"
								           placeholder="Discapacidad">
								  </div>

								  <div class="form-group">

								  	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="form-control">
								    
								  </div>

								  
								</form>

								<button type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-primary btn-lg btn-block">Actualizar</button>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>