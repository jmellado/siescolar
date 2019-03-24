	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-clipboard'></i>&nbsp;INFORMES DE PROMOCIÓN</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3 col-xs-6">
          <!-- small box -->
        	<div class="small-box bg-aqua">
            	<div class="inner">
              		<h3>Por</h3>

              		<p>Jornada</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-calendar-o"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>informes_promocion_controller/PorJornada" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
        	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3>Por</h3>

              		<p>Grado</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-graduation-cap"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>informes_promocion_controller/PorGrado" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
        	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>Por</h3>

              		<p>Curso</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-th-large"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>informes_promocion_controller/PorCurso" class="small-box-footer">Ver información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>

    </div>	

</div>