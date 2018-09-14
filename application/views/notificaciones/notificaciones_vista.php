	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-bullhorn'></i>&nbsp;DIFUNDIR MENSAJE</h1>
        </div>
    </div>


    <div class="row">
    	<div class="col-md-12">
    		<div class="box">
    			<!--<div class="panel-heading">NOTIFICACIONES REGISTRADAS</div>-->
    				<div class="box-header with-border">
    					<!--<h3 class="box-title text-aling:center"><i class='fa fa-list'></i>Notificaciones</h3>-->
    					<div class="box-title">
    						<button type="submit" name="btn_agregar_notificacion" id="btn_agregar_notificacion" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Nuevo Mensaje</button>
    					</div>
    					<div class="box-tools pull-right">
					      <div class="has-feedback">
					        <input type="text" class="form-control input-sm" id="buscar_notificacion" name="buscar_notificacion" placeholder="Buscar...">
					        <span class="glyphicon glyphicon-search form-control-feedback"></span>
					      </div>
					    </div><!-- /.box-tools -->
    				</div>

    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad_notificacion">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_notificacion" name="cantidad_notificacion" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_notificaciones" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'>&nbsp;</i>Título</th>
									<th><i class='fa fa-file-text-o'>&nbsp;</i>Tipo</th>
									<th><i class='fa fa-mail-forward'>&nbsp;</i>Destinatario</th>
									<th><i class='fa fa-calendar-check-o'>&nbsp;</i>Fecha De Envio</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<td colspan='7'></td>
								</tr>
							</tfoot>
						</table>
						</div>

						<div class="text-right paginacion_notificacion">
						
						</div>

    				</div>
    				<!--<div class="box-footer">
    					<div class="text-right paginacion_notificacion"></div>
			        </div>-->

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nueva notificacion -->
<div id="modal_agregar_notificacion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;MENSAJE NUEVO</h4>
      </div>
      <div class="modal-body">

      	<div class="row">

    		<div class="col-md-12">

    			<div class="panel panel-default">
                <!--<div class="panel-heading"></div>-->
                	<div class="panel-body">

                		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>notificaciones_controller/insertar" name="" method="post" id="form_notificaciones">

                			<input type="hidden" id="remitente_m" name="remitente" value="<?php echo $this->session->userdata('id_persona')?>">

                			<div class="form-group">
								<label class="control-label col-sm-3" for="rol_destinatario">PARA:</label>
								<div class="col-sm-7">
									<select class="form-control" id="rol_destinatario_m" name="rol_destinatario">
											<option></option>
											<option value="1">Estudiantes y Acudientes</option>
											<option value="2">Profesores</option>
											<option value="3">Estudiantes, Profesores y Acudientes</option>
									</select>
								</div>
							</div>

				        	<div class="form-group">
				        		<label class="control-label col-sm-3" for="titulo">TÍTULO:</label>
				        		<div class="col-sm-7">
									<input type="text" class="form-control" id="titulo_m" name="titulo" placeholder="Título">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="tipo">TIPO:</label>
								<div class="col-sm-4">
									<select class="form-control" id="tipo_m" name="tipo">
											<option></option>
											<option value="Mensaje General">Mensaje General</option>
											<option value="Noticia">Noticia</option>
											<option value="Circular">Circular</option>
											<option value="Importante">Importante</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="mensaje">CONTENIDO:</label>
								<div class="col-sm-9">
									<textarea class="form-control" name="contenido" id="contenido_m" cols="50" rows="4" placeholder="Contenido.." style="resize:none"></textarea>
								</div>
							</div>

							<div class="form-group">
				        		<div class="col-sm-offset-4 col-sm-5"> 
									<button type="submit" name="btn_registrar_notificacion" id="btn_registrar_notificacion" class="btn btn-primary btn-lg btn-block">Enviar</button>
								</div>
							</div>
				        </form>


                	</div>

                </div>	
            </div>
            
        </div>        

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar notificacion -->
<div id="modal_actualizar_notificacion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR MENSAJE</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">

    		<div class="col-md-12">

    			<div class="panel panel-default">
                <!--<div class="panel-heading"></div>-->
                	<div class="panel-body">

                		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>notificaciones_controller/modificar" name="" method="post" id="form_notificaciones_actualizar">

                			<input type="hidden" class="form-control" id="codigo_notificacion_msele" name="codigo_notificacion">

                			<div class="form-group">
								<label class="control-label col-sm-3" for="rol_destinatario">PARA:</label>
								<div class="col-sm-7">
									<select class="form-control" id="rol_destinatario_msele" name="rol_destinatario" disabled>
											<option></option>
											<option value="1">Estudiantes y Acudientes</option>
											<option value="2">Profesores</option>
											<option value="3">Estudiantes, Profesores y Acudientes</option>
									</select>
								</div>
							</div>

				        	<div class="form-group">
				        		<label class="control-label col-sm-3" for="titulo">TÍTULO:</label>
				        		<div class="col-sm-7">
									<input type="text" class="form-control" id="titulo_msele" name="titulo" placeholder="Título">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="tipo">TIPO:</label>
								<div class="col-sm-4">
									<select class="form-control" id="tipo_msele" name="tipo">
											<option></option>
											<option value="Mensaje General">Mensaje General</option>
											<option value="Noticia">Noticia</option>
											<option value="Circular">Circular</option>
											<option value="Importante">Importante</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="contenido">CONTENIDO:</label>
								<div class="col-sm-9">
									<textarea class="form-control" id="contenido_msele" name="contenido" cols="50" rows="4" placeholder="Contenido.." style="resize:none"></textarea>
								</div>
							</div>

				        </form>

				        <div class="form-group">
			        		<div class="col-sm-offset-4 col-sm-5"> 
								<button type="submit" name="btn_actualizar_notificacion" id="btn_actualizar_notificacion" class="btn btn-primary btn-lg btn-block">Actualizar</button>
							</div>
						</div>


                	</div>

                </div>	
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>