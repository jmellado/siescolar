<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-dashboard'></i>&nbsp;DASHBOARD</h1>
        </div>
    </div>

	<div class="row">

		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
        	<div class="small-box bg-aqua">
            	<div class="inner">
              		<h3><?php echo $this->db->count_all('estudiantes');?></h3>

              		<p>Estudiantes</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-stalker"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>estudiantes_controller/index2" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
        	<div class="small-box bg-green">
            	<div class="inner">
              		<h3><?php echo $this->db->count_all('profesores');?></h3>

              		<p>Profesores</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-stalker"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>profesores_controller/index" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
        	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3><?php echo $this->db->count_all('acudientes');?></h3>

              		<p>Acudientes</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-stalker"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>acudientes_controller/index" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        
        <?php 
        	$this->db->where('roles.nombre_rol','administrador');
          $this->db->where('usuarios.id_persona != 1');
        	$this->db->join('roles', 'usuarios.id_rol = roles.id_rol');
        	$query = $this->db->get('usuarios');
			    $total_admin = count($query->result());
        ?>
        <div class="col-lg-3 col-xs-6">
          
        	<div class="small-box bg-red">
            	<div class="inner">
              		<h3><?php echo $total_admin?></h3>

              		<p>Administradores</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-stalker"></i>
            	</div>
            	<a href="<?php echo base_url(); ?>administradores_controller/index" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        	</div>
        </div>
        

	</div>


</div>