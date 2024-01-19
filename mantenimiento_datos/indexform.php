<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soportech</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/custombox.min.css">
    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../assets/js/custombox.min.js"></script>

</head>
<body class="login-page">
   <div id="cuerpo" class="col-md-12" >
       <section class="content-header">
           <h1>Mantenimiento de Datos</h1>
       
       </section>

           <div class="col-md-12" >
              <div class="box box-primary">

                <div class="box-header with-border">
                  <h2 class="box-title">TABLAS ESCALABLES</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                 <div class="box-body">

                    <div class="row col-md-12 col-lg-12">
                     
                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="inventario">MARCA</label>
                            <div class="input-group">
                            <a class="" href="marca/marcas.php" >
                            <i class="fa fa-trademark" id="marca" style="font-size:80px"></i></a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">CLASIFICACION DE CPU</label>
                             <div class="input-group  ">
                             <a class="" href="clasificacion/clasificacion.php" >
                             
                             <style>
                                i{
                                    color: orange;
                                    
                                    font-size: 80px;
                                }
                            </style>
                            <i class="fa fa-check-square-o" aria-hidden="true" id="clas" style="font-size:80px"></i></a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">TIPOS DE ESTADO</label>
                             <div class="input-group  ">
                             <a class="" href="estado/estado.php" >
                            <i class="fa fa-refresh" aria-hidden="true" id="procesador" style="font-size:80px"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row col-md-12 col-lg-12">
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="inventario">PROCESADORES</label>
                             <div class="input-group  ">
                             <a class="" href="procesador/procesador.php" >
                             <i class="fa fa-joomla" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">RAM</label>
                             <div class="input-group  ">
                             <a class="" href="ram/ram.php" >
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="glyphicon glyphicon-tasks" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="inventario">TARJETA DE VIDEO</label>
                             <div class="input-group  ">
                             <a class="" href="tvideo/tvideo.php">
                             <i class="fa fa-gamepad" aria-hidden="true" id="procesador" style="font-size:80px"></i></a>
                            </div>
                        </div>
                    </div>
                        

                    <div class="row col-md-12 col-lg-12">
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="clasificacion">UNIDAD DE ALMACENAMIENTO</label>
                            <div class="input-group  ">
                            <a class="" href="disco/disco.php">
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="glyphicon glyphicon-hdd" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">TIPO ACCESORIO</label>
                             <div class="input-group  ">
                             <a class="" href="tipo_accesorio/tipo_accesorio.php">
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="glyphicon glyphicon-headphones"  aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">IP</label>
                             <div class="input-group  ">
                             <a class="" href="ipv4/ipv4.php">
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="fa fa-sitemap" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                    </div>

                    

                    <div class="row col-md-12 col-lg-12">
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">CATEGORÍA DE SOFTWARE</label>
                             <div class="input-group  ">
                             <a class="" href="categoria/categoria.php">
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="fa fa-tasks" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">TIPO DE RAM</label>
                             <div class="input-group">
                             <a class="" href="tipo_ram/tipo_ram.php">
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="fa fa-list-ol" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <label for="clasificacion">CLASIFICACION DE LICENCIAS</label>
                             <div class="input-group">
                             <a class="" href="clasificacion_licencia/clasificacion.php">
                            <!-- <i class="" aria-hidden="true" id="procesador" style="font-size:64px"></i></a> -->
                            <i class="fa fa-check-circle" aria-hidden="true" id="procesador" style="font-size:80px"></i>
                            </a>
                            </div>
                        </div>

                    </div>

                    <div class="row col-md-12 col-lg-12">
                        
                    </div>

                    

                  </div>
                </form>

            </div>
            </div>
    </div>
        
</body>
   
<script type="text/javascript">
    $("#marca").click(function () {
        var modal = new Custombox.modal({
            content: {

                target: '#demo-marca',
                effect: 'fall',
                fullscreen: true

            }
        });

        modal.open();
    });
    $("#ubicacion").click(function () {
        var modal = new Custombox.modal({
            content: {

                target: '#demo-ubicacion',
                effect: 'fall',
                fullscreen: true

            }
        });

        modal.open();
    });

    $("#sim").click(function () {
        var modal = new Custombox.modal({
            content: {

                target: '#demo-sim',
                effect: 'fall',
                fullscreen: true

            }
        });

        modal.open();
    });
    $("#ip").click(function () {
        var modal = new Custombox.modal({
            content: {

                target: '#demo-ip',
                effect: 'fall',
                fullscreen: true

            }
        });

        modal.open();
    });

    $("#tipo_accesorio").click(function () {
        var modal = new Custombox.modal({
            content: {

                target: '#demo-accesorio',
                effect: 'fall',
                fullscreen: true

            }
        });

        modal.open();
    });
</script>
</body>
</html>