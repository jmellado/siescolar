<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-bar-chart'></i>&nbsp;ESTADISTICAS ACADÉMICAS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3 col-xs-6">
          <!-- small box -->
        	<div class="small-box bg-aqua">
            	<div class="inner">
              		<h3>Los 50</h3>

              		<p>Mejores Por Período</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-star-o"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>estadisticas_controller/CincuentaMejores" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>

        <div class="col-lg-3 col-xs-6">
          
        	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>Promedio</h3>

              		<p>Por Cursos</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-th-large"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>estadisticas_controller/PromedioCursos" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>

        <div class="col-lg-3 col-xs-6">
          
        	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3>Promedio</h3>

              		<p>Por Grados</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-graduation-cap"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>estadisticas_controller/PromedioGrados" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>

        <div class="col-lg-3 col-xs-6">
          
        	<div class="small-box bg-red">
            	<div class="inner">
              		<h3>En Riesgo</h3>

              		<p>De Perder El Año</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-stalker"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>estadisticas_controller/EnRiesgo" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>

    </div>	
</div>