<?php
session_start();
if(!isset($_SESSION['tipo'])){
   echo "<script> location.href='index.php'; </script>";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sis. Inventarios</title>




    <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="assets/font-awesome-4.5.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" type="text/css" href="assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
      <link href="assets/img/bg7.png" rel="icon" type="image/png" />
    <!-- Date Picker -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">







  </head>
  <body>
  <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="inventario.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>TVC</b></span>
          <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SOPORTE TVC</b></span>

        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Barra de Navegación</span>
          </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Cambiar Color</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                        <li><!-- Task item -->

                                                <a  data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a>
                                        </li>
                                        <!-- end task item -->
                                        <li><!-- Task item -->
                                            <a  data-skin="skin-green" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                        </li>
                                        <!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                        </li>
                                        <!-- end task item -->
                                        <li><!-- Task item -->
                                            <a  data-skin="skin-red-light" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <a data-skin="skin-black" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a>
                                        </li>
                                    </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                            <li class="footer">
                                <a>Ver todas las tareas</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="assets/img/bg5.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php if(isset($_SESSION['nombre'])) echo $_SESSION['nombre']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="assets/img/bg5.png" class="img-circle" alt="User Image">

                                <p>
                                    Soporte Técnico Televicentro
                                    <small>2023.</small>
                                </p>
                            </li>


                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="login/logout.php" class="btn btn-danger btn-flat fa fa-power-off">Salir</a>
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
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="assets/dist/img/userjpg.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php if(isset($_SESSION['nombre'])) echo $_SESSION['nombre']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
            </div>
          </div>


          <ul class="sidebar-menu">
            <li class="header">IT Televicentro</li>


              <!-- /.MODULO DE ACTIVOS -->
              <li class="treeview">
            <a href="#">
                  <i class="fa fa-location-arrow"></i>
                  <span>Hardware</span><i class="fa fa-angle-left pull-right"></i>
            </a>

              <ul class="treeview-menu" style="display: none;">

                <li class="active">
                  <a href="#"><i class="fa fa-building" ></i> Computador
                    <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('cpu/cpu.php')"><i  class="fa fa-laptop"></i>Crear CPU</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('cpu/ver-ot.php')"><i  class="fa fa-eye"></i>Ver CPU</a></li>
                    </ul>
                </li>


                <li class="active">
                    <a href="#"><i class="fa fa-laptop"></i> Monitor
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('monitor/monitor.php')"><i  class="fa fa-desktop"></i>Crear Monitor</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('monitor/ver_monitores.php')"><i  class="fa fa-eye"></i>Ver Monitor</a></li>
                    </ul>
                </li>

                <li class="active">
                    <a href="#"><i class="fa fa-plug"></i> UPS
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('ups/ups.php')"><i  class="fa fa-plug"></i>Crear UPS</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('ups/ver_ups.php')"><i  class="fa fa-eye"></i>Ver UPS</a></li>
                    </ul>
                </li>




                <li class="active">
                    <a href="#"><i class="fa fa-cubes"></i> Accesorios
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('accesorios/accesorios.php')"><i  class="fa fa-cubes"></i>Crear Accesorio</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('accesorios/ver_accesorios.php')"><i  class="fa fa-eye"></i>Ver Accesorio</a></li>
                    </ul>
                </li>

                <!--Switch/router -->
                <li class="active">
                    <a href="#"><i class="fa fa-cubes"></i> Switch/Router
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('swt_rt/swt_rt.php')"><i  class="fa fa-cubes"></i>Crear Switch/Router</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('swt_rt/ver_swt_rt.php')"><i  class="fa fa-eye"></i>Ver Switch/Router</a></li>
                    </ul>
                </li>
              </ul>
            </li>


              <!-- /.MODULO DE Software -->
              <li class="treeview">
            <a href="#">
                  <i class="fa fa-location-arrow"></i>
                  <span>Software</span><i class="fa fa-angle-left pull-right"></i>
            </a>

              <ul class="treeview-menu" style="display: none;">

                <li class="active">
                    <a href="#"><i class="fa fa-key"></i> Licencias
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('licencia/licencia.php')"><i  class="fa fa-key"></i>Crear licencia</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('licencia/ver_licencias.php')"><i  class="fa fa-eye"></i>Ver Licencia</a></li>
                    </ul>
                </li>


                <li class="active">
                    <a href="#"><i class="fa fa-gears"></i> Software
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('software/software.php')"><i  class="fa fa-gears"></i>Crear Software</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('software/ver_software.php')"><i  class="fa fa-eye"></i>Ver Software</a></li>
                    </ul>
                </li>



              </ul>


              <!-- /.MODULO EMPLEADO -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Empleados</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li style="cursor:pointer" ><a onclick="inicio('empleados/empleados.php')"><i  class="fa fa-user-plus"></i>Crear Empleado</a></li>
                 <li style="cursor:pointer"><a onclick="inicio('empleados/ver_empleados.php')"><i  class="fa fa-eye"></i>Ver Empleados</a></li>
              </ul>
            </li>


            <!-- /.MODULO MANTENIMIENTO -->
              <li class="treeview">
                  <a href="#">
                      <i class="fa fa-wrench"></i>
                      <span>Mantenimiento</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                      <li style="cursor:pointer"><a onclick="inicio('mantenimiento/mantenimiento.php')"><i  class="fa fa-plus-circle"></i>Crear Mantenimiento</a></li>
                      <li style="cursor:pointer"><a onclick="inicio('mantenimiento/ver_mantenimiento.php')"><i  class="fa fa-eye"></i>Ver Mantenimiento</a></li>
                  </ul>
              </li>


            <!-- /.MODULO DESPLEGABLES -->
              <li class="treeview">
              <a href="#">
                <i class="fa fa-database" aria-hidden="true"></i>
                <span>Mantenimiento de Datos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li style="cursor:pointer" ><a onclick="inicio('mantenimiento_datos/indexform.php')"> <i  class="fa fa-list-ul" aria-hidden="true"></i>Mantenimiento de Datos</a></li>
              </ul>
            </li>





          <!-- /.MODULO UBICACION -->
          <li class="treeview">
            <a href="#">
                  <i class="fa fa-location-arrow"></i>
                  <span>Ubicación fisica</span><i class="fa fa-angle-left pull-right"></i>
            </a>

              <ul class="treeview-menu" style="display: none;">

                <li class="active">
                  <a href="#"><i class="fa fa-building" ></i> Edificio
                    <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('edificio/edificio.php')"><i  class="fa fa-plus-circle"></i>Crear Edificio</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('edificio/ver_edificio.php')"><i  class="fa fa-eye"></i>Ver Edificio</a></li>
                    </ul>
                </li>


                <li class="active">
                    <a href="#"><i class="fa fa-sitemap"></i> Departamento
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('departamento/departamento.php')"><i  class="fa fa-plus-circle"></i>Crear Departamento</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('departamento/ver_departamento.php')"><i  class="fa fa-eye"></i>Ver Departamento</a></li>
                    </ul>
                </li>

                <li class="active">
                    <a href="#"><i class="fa fa-map-marker"></i> Ubicación
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>

                    <ul class="treeview-menu menu-open" style="display: none;">
                        <li style="cursor:pointer"><a onclick="inicio('ubicacion/ubicacion.php')"><i  class="fa fa-plus-circle"></i>Crear Ubicación</a></li>
                        <li style="cursor:pointer"><a onclick="inicio('ubicacion/ver_ubicacion.php')"><i  class="fa fa-eye"></i>Ver Ubicación</a></li>
                    </ul>
                </li>
              </ul>
            </li>


        </section>
        <!-- /.sidebar -->
      </aside>

      <div class="content-wrapper" style="background-color:white;">
        <div id="inicio">
        </div>
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Televicentro- &copy;</strong> 2023.
      </footer>



   </div>

    <script type="text/javascript" src="assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->


    <!-- Bootstrap WYSIHTML5 -->
    <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
   <script>


      function inicio($url){

      $('#inicio').html(''+
      '<iframe width="100%" height="1000px" id="MarcoArchivo" frameborder="1" src=""></iframe>');
      document.getElementById('MarcoArchivo').src = url1($url);
      }

      function url1($ref){
            <?php $server= $_SERVER['PHP_SELF'] ?>
              var ruta = "<?php echo $server; ?>";
                console.log(ruta+" "+$ref);
              return '/'+ruta.split('/')[1] +'/' + $ref;

      }
      </script>

  </body>