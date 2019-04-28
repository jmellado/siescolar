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

  <title>BIENVENIDO ACUDIENTE</title>
  <script>var base_url = '<?php echo base_url() ?>'</script>
  <link href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/favicon.png" rel="shortcut icon" type="image/x-icon"/>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery-1.12.4.min.js"></script>
  <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notificaciones_usuarios.js" defer></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/funciones_globales.js" defer></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js" defer></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js" defer></script>

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

  
</head>

<body class="hold-transition skin-yellow fixed sidebar-mini" onload="nobackbutton();">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>CT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Acudiente</b></span>
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
          <!--<li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <!--<ul class="menu">
                  <li><!-- start message -->
                    <!--<a href="#">
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
                <!--</ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="VistaPrevia_Notificaciones()">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success" id="total_notificaciones"><!--10--></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes <span id="mensaje_notificaciones"></span><!--10--> notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="listado_notificaciones">
                  <!--<li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>-->
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todo</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!--<li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <!--<ul class="menu">
                  <li><!-- Task item -->
                    <!--<a href="#">
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
                <!--</ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>uploads/imagenes/fotos/<?php echo $this->session->userdata('id_persona')?>.jpg" class="user-image" alt="Foto">
              <span class="hidden-xs"><?php echo $this->session->userdata('nombres')?> <?php echo $this->session->userdata('apellido1')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>uploads/imagenes/fotos/<?php echo $this->session->userdata('id_persona')?>.jpg" class="img-circle" alt="Foto">

                <p>
                  <?php echo $this->session->userdata('nombres')?> <?php echo $this->session->userdata('apellido1')?> <?php echo $this->session->userdata('apellido2')?>
                  <small>Acudiente</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <!--<a href="#">Followers</a>-->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!--<a href="#">Sales</a>-->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!--<a href="#">Friends</a>-->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>cuenta_controller/cambiarpassword" class="btn btn-default btn-flat">Cuenta</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>login_controller/logout_ci" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
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
          <img src="<?php echo base_url(); ?>uploads/imagenes/fotos/<?php echo $this->session->userdata('id_persona')?>.jpg" class="img-circle" alt="Foto">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nombres')?><br><?php echo $this->session->userdata('apellido1')?></p>
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
          <a href="<?php echo base_url(); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue">1</small>
            </span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url(); ?>notificaciones_controller/index_acudiente">
            <i class="fa fa-envelope"></i>
            <span>Mis Mensajes</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>consultas_controller/consultar_notasA">
            <i class="fa fa-bar-chart"></i>
            <span>Calificaciones</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>consultas_controller/consultar_asistenciasA">
            <i class="fa fa-check-square-o"></i>
            <span>Asistencias</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>consultas_controller/consultar_tareasA">
            <i class="fa fa-pencil"></i>
            <span>Tareas</span>
          </a>
        </li>
      	<li><a href="<?php echo base_url(); ?>documentos_controller/documentosAC"><i class="fa fa-book"></i> <span>Documentación</span></a></li>
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

          <input type="hidden" id="rol" name="rol" value="<?php echo $this->session->userdata('rol')?>">
          <input type="hidden" id="id_persona" name="id_persona" value="<?php echo $this->session->userdata('id_persona')?>">
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js"></script>
</body>
</html>