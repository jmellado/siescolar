	<style type="text/css">
	    
	    label.error{color:red;}

	    img.izquierda {
		  float: left;
		}

		img.derecha {
		  float: right;
		}

		.table tbody tr:hover td, .table tbody tr:hover th {
		    background-color: #ccffcc;
		}

		h4 {
			font-family: Georgia;
			font-style: italic;
		}

	</style>


<div class="container-fluid">

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
	    		<div class="panel-body">

	    			<div class="col-md-12">
	    				
	    				<div>
			    			<img src="<?php echo base_url();?>uploads/imagenes/colegio/escudo.png" alt="Escudo Institución" class="img-circle img-responsive izquierda" style="width: 150px; height: 150px; text-align: center;">
			    		</div>

			    		<div>
			    			<img src="<?php echo base_url();?>uploads/imagenes/elecciones/escudo_colombia.png" alt="Escudo Colombia" class="img-circle img-responsive derecha" style="width: 150px; height: 150px; text-align: center;">
			    		</div>

			    		<div style="text-align: center;">
			    			<?php foreach ($institucion as $item): ?>
				    			<h1 style="margin-top: 0px;"><?php echo $item->nombre_institucion ?></h1>
				    		<?php endforeach; ?>

				    		<?php foreach ($candidatos as $item): ?>
				    			<h2 style="margin-top: 0px;">Tarjetón Electoral <?php echo $item->nombre_ano_lectivo ?></h1>
				    			<h3 style="margin-top: 0px;">Elección De <?php echo $item->nombre_eleccion ?></h1>
				    			<?php break 1 ?>;
				    		<?php endforeach; ?>
			    		</div>
			    		
			    	</div>

			    	<div class="col-md-12">

			    		<h4>Por Favor, Para Votar Haga Click Sobre La Foto Del Candidato De Su Preferencia.</h4>
			    		<div class="table-responsive">
							<table border='1' id="lista_candidatos_eleccion" class="table table-bordered table-condensed table-hover">
								<thead>
									<tr>
										<th><i class='fa fa-sort-amount-asc'></i></th>
										<th><i class='fa fa-image'></i>&nbsp;Foto Del Candidato</th>
										<th><i class='fa fa-sort-numeric-asc'></i>&nbsp;Número</th>
										<th><i class='fa fa-user'></i>&nbsp;Nombre Del Candidato</th>
										<th style="display: none"></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<td colspan='5'></td>
									</tr>
								</tfoot>
								<tbody>
									<?php $i=0;?>
									<?php foreach ($candidatos as $item): ?>
										<tr>
											<td><?php $i=$i+1; echo $i;?></td>
											<td>

												<button  value="<?php echo $item->id_candidato_eleccion ?>">
													<img src="<?php echo base_url();?>uploads/imagenes/elecciones/candidatos/<?php echo $item->id_candidato_eleccion ?>.jpg" alt="Foto Candidato" class="img-responsive" style="width: 120px; height: 160px; text-align: center;">
												</button>
													
											</td>
											<td><h1><?php echo $item->numero ?></h1></td>
											<td><h2><?php echo $item->nombres." ".$item->apellido1." ".$item->apellido2 ?></h2></td>
											<td style="display: none"><?php echo $codigo_eleccion ?></td>
										</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
			    	</div>
			    	<a href="<?php echo base_url(); ?>rol_votante/elecciones" class="btn btn-success"><i class='fa fa-sign-out'></i>&nbsp;SALIR</a>
	    		</div>
	    	</div>
	    </div>
	</div>

</div>