<!DOCTYPE html>
<html>
<head>

	  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	  <title>BIENVENIDO ADMINISTRADOR</title>
	  <script>var base_url = '<?php echo base_url() ?>'</script>
    <link href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/favicon.png" rel="shortcut icon" type="image/x-icon"/>
	
	  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery-1.12.4.min.js"></script>
	  <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->

	  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/estudiantes.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/profesores.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/acudientes.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/grados.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/grupos.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/salones.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cursos.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/areas.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/asignaturas.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pensum.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cargas_academicas.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/matriculas.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/consolidar_matriculas.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/logros.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/asignar_logros.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notas.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/imprimir.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notificaciones.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/configuraciones.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/periodos_evaluacion.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ano_lectivo.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/funciones_globales.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/fileinput.js" defer></script>
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/css/skins/_all-skins.min.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fileinput.css">

</head>
<body class="hold-transition skin-red fixed sidebar-mini" onload="nobackbutton();">

<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>DM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Administrador</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>login_controller/logout_ci" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="<?php echo base_url(); ?>rol_administrador/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue">1</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>grados_controller/index">
            <i class="fa fa-graduation-cap"></i>
            <span>Gestionar Grados</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>grupos_controller/index">
            <i class="fa fa-object-group"></i>
            <span>Gestionar Grupos</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>salones_controller/index">
            <i class="fa fa-institution"></i>
            <span>Gestionar Salones</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>cursos_controller/index">
            <i class="fa fa-th-large"></i>
            <span>Gestionar Cursos</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>areas_controller/index">
            <i class="fa fa-crop"></i>
            <span>Gestionar Areas</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>asignaturas_controller/index">
            <i class="fa fa-clone"></i>
            <span>Gestionar Asignaturas</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>pensum_controller/index">
            <i class="fa fa-sitemap"></i>
            <span>Gestionar Pensum</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-print"></i>
            <span>Imprimir</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>imprimir_controller/imprimir_boletin"><i class="fa fa-clipboard"></i>Boletines</a></li>
            <li><a href="<?php echo base_url(); ?>imprimir_controller/imprimir_planilla_asistencia"><i class="fa fa-clipboard"></i>Planillas De Asistencia</a></li>
            <li><a href="<?php echo base_url(); ?>imprimir_controller/imprimir_constancia"><i class="fa fa-clipboard"></i>Constancias De Estudio</a></li>
          </ul>
        </li>

        <li>
          <a href="<?php echo base_url(); ?>notificaciones_controller/index">
            <i class="fa fa-envelope"></i>
            <span>Difundir Mensaje</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-check-square"></i>
            <span>Elecciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>elecciones_controller/index"><i class="fa fa-clipboard"></i>Gestionar Elecciones</a></li>
            <li><a href="<?php echo base_url(); ?>elecciones_controller/candidatos"><i class="fa fa-users"></i>Gestionar Candidatos</a></li>
            <li><a href="<?php echo base_url(); ?>elecciones_controller/votantes"><i class="fa fa-list"></i>Votantes</a></li>
            <li><a href="<?php echo base_url(); ?>elecciones_controller/resultados"><i class="fa fa-bar-chart"></i>Resultados</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>configuraciones_controller/datos_institucion"><i class="fa fa-clipboard"></i>Datos Institución</a></li>
            <li><a href="<?php echo base_url(); ?>configuraciones_controller/anio_lectivo"><i class="fa fa-calendar-times-o"></i>Año Lectivo</a></li>
            <li><a href="<?php echo base_url(); ?>configuraciones_controller/periodos_evaluacion"><i class="fa fa-calendar"></i>Períodos Evaluación</a></li>
          </ul>
        </li>

        <li class="header">MAIN ESTUDIANTES</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Gestionar Estudiantes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>estudiantes_controller/index"><i class="fa fa-user-plus"></i> Registrar</a></li>
            <li><a href="<?php echo base_url(); ?>estudiantes_controller/index2"><i class="fa fa-list-alt"></i> Consultar</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>acudientes_controller/index">
            <i class="fa fa-group"></i>
            <span>Gestionar Acudientes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Gestionar Matriculas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>matriculas_controller/index"><i class="fa fa-clipboard"></i> Matricular</a></li>
            <li><a href="<?php echo base_url(); ?>matriculas_controller/consolidar_matriculas"><i class="fa fa-tasks"></i> Consolidar Matriculas</a></li>
          </ul>
        </li>
        <li class="header">MAIN PROFESORES</li>
        <li>
          <a href="<?php echo base_url(); ?>profesores_controller/index">
            <i class="fa fa-user"></i><span>Gestionar Profesores</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>cargas_academicas_controller/index">
            <i class="fa fa-th"></i>
            <span>Gestionar Cargas Academicas</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Gestionar Logros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>logros_controller/index"><i class="fa fa-clipboard"></i>Registrar</a></li>
            <li><a href="<?php echo base_url(); ?>asignar_logros_controller/index"><i class="fa fa-indent"></i>Asignar</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>notas_controller/index">
            <i class="fa fa-sticky-note"></i> <span>Gestionar Notas</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">4</small>
            </span>
          </a>
        </li>
        <li><a href="<?php echo base_url(); ?>asignar_logros_controller/index"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">

          <?php echo $contents; ?>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.12
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="http://siescolar.com">Proyecto Siescolar</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->




<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plantillas/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js" defer></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js" defer></script>

</body>
</html>