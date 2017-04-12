<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>BIENVENIDO ADMINISTRADOR</title>
	<script>var base_url = '<?php echo base_url() ?>'</script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/estudiantes.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plantillas/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/plantillas/admin/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>assets/plantillas/admin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/plantillas/admin/css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/plantillas/admin/css/admin/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/plantillas/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

</head>
<body onload="nobackbutton();">

	<!--<h1 style="text-align: center">Bienvenido de nuevo <?=$this->session->userdata('rol')?></h1>
				<?=anchor(base_url().'login_controller/logout_ci', 'Cerrar sesión')?>
				<?=anchor(base_url().'estudiantes_controller/index', 'estudiantes')?>
				<?=anchor(base_url().'estudiantes_controller/index2', 'consultar')?>

<div id="page-wrapper">

	

</div>-->

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Administrador</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="<?php echo base_url(); ?>login_controller"><i class="fa fa-home fa-fw"></i> Home</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url(); ?>login_controller/logout_ci"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> GESTION<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">PROFESORES</a>
                            </li>
                            <li>
                                <a href="#">ESTUDIANTES <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>estudiantes_controller/index" id="btn_vista_registrar">REGISTRAR</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>estudiantes_controller/index2" id="btn_vista_consultar">CONSULTAR</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <!--<div class="container-fluid">
        	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">BIENVENIDO</h1>
                </div>
            </div>

        </div>-->
        <?php echo $contents; ?>
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

  
    </div>

</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plantillas/admin/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/plantillas/admin/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/plantillas/admin/js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/plantillas/admin/js/startmin.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js"></script>

</body>
</html>