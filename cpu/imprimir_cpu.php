<?php
include_once '../config/conexion2.php';

session_start();

if(!isset($_SESSION['tipo'])){
    echo "<script>  window.location.href='../index.php';  </script>";
}

$mbd=DB::connect();DB::disconnect();
$id = $_GET['id'];//trae el id del cpu
$stmt = $mbd->prepare("SELECT id_cpu,cpu.num_inventario,nombre_cpu,marca.nombre_marca,cpu.modelo,clasificacion.nombre_clasif,serv_tag,garantia,tipo_estado.nombre_estado,CONCAT_WS(' ',empleados.nombre,empleados.apellido) as operador,usuario_windows,fecha_ingreso,usuario_sistema.nombre_usu as ingresado_por,edificio.nombre_edificio,departamento.departamento,ubicacion.ubicacion,cpu.observacion FROM cpu 
INNER JOIN marca ON cpu.id_marca=marca.id_marca
INNER JOIN clasificacion ON cpu.id_clasificacion=clasificacion.id_clasificacion_cpu
INNER JOIN tipo_estado ON cpu.id_estado=tipo_estado.id_estado
INNER JOIN edificio ON cpu.id_edificio=edificio.id_edificio
INNER JOIN departamento ON cpu.id_depto=departamento.id_departamento
INNER JOIN ubicacion ON cpu.id_ubicacion=ubicacion.id_ubicacion
INNER JOIN empleados ON cpu.id_empleado=empleados.id_empleado
INNER JOIN procesador ON cpu.id_procesador=procesador.id_procesador
INNER JOIN ram ON cpu.id_ram=ram.id_ram
INNER JOIN t_video ON cpu.id_tarjeta_v=t_video.id_tarjeta_v
INNER JOIN usuario_sistema ON cpu.modificado_por=usuario_sistema.id_usuario where cpu.id_cpu=:id GROUP BY num_inventario");

$stmt->execute(array(':id'=>$id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$num_inventario_cpu=$userRow['num_inventario'];

date_default_timezone_set('America/Tegucigalpa');    
$DateAndTime = date('d-m-Y h:i a', time());



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/css/toastr.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.5.0/css/font-awesome.min.css">


    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
</head>
<body class="login-page">

<div  class="col-12 col-lg-12 col-md-12">
    <section class="invoice">
        
        
        <div class="row">
            <div class="col-12 col-lg-12 col-xs-12">
               <img src=" ../assets/img/bg011.jpg"align="right">            
            </div>
        </div>



        <div class="row">
            <div class="col-12 col-xs-12 table-responsive">
                <input type="hidden" id="id_user" value="<?php if (isset($_SESSION['user_session'])) echo $_SESSION['user_session']; ?>">

                <center><h3>REPORTE DE CPU</h3>
                <strong><h4>DATOS GENERALES</h4></strong>
                </center>
                <table class="table table-striped" width="100%">
                    <thead>
                    <tr>
                    
                    <th width="10%">N. Inventario</th> 
                    <th width="20%">Nom. del Equipo</th>
                    <th width="10%">Marca</th>
                    <th width="10%">Modelo</th>
                    <th width="10%">Clasificación</th>
                    <th width="10%">Service Tag.</th>
                    <th width="10%">Garantía</th>
                    <th width="10%">Estado</th>
                    <th width="10%">Operador</th>
                    <th width="5%">Usuario S.O</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo "
                            <tr>
                        
                                <td>" .$userRow['num_inventario']. "</td>
                                <td>" . $userRow['nombre_cpu'] . "</td>
                                <td>" . $userRow['nombre_marca'] . "</td>
                                <td>" . $userRow['modelo']. "</td>
                                <td>" . $userRow['nombre_clasif'] . "</td>
                                <td>" . $userRow['serv_tag'] . "</td>
                                <td>" . $userRow['garantia'] . "</td>
                                <td>" . $userRow['nombre_estado'] . "</td>
                                <td>" . $userRow['operador'] . "</td>
                                <td>" . $userRow['usuario_windows'] . "</td>
                            </tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

       
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <center>
                <strong><h4>HARDWARE DEL EQUIPO</h4></strong>
                </center>
                <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>IPV4</th>
                    <th>Procesador</th> 
                    <th>M. Ram</th>
                    <th>Tarjeta de Video</th>
                    <th>Ups Asig.</th>
                    <th>Almacenamiento(S)</th>
                    <th>Accesorio(S)</th>
                    <th>Monitore(S)</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mbd=DB::connect();DB::disconnect();

                        $proof1=$mbd->query("SELECT cpu.num_inventario, CONCAT_WS(' ','Fabricante:',procesador.fabricante,procesador.modelo,procesador.generacion,procesador.velocidad) as procesador,
                        (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',tipo_ram.tipo_ram,ram.capacidad,ram.frecuencia,ram.observaciones), ' ') as ram from ram LEFT JOIN tipo_ram ON tipo_ram.id_tipo_ram=ram.id_tipo_ram where cpu.id_ram=ram.id_ram) as ram,
                        CONCAT_WS(' ','Modelo: ',t_video.modelo,',Capacidad: ',t_video.capacidad,',Marca: ',M.nombre_marca) as tvideo,
                        CONCAT_WS(' ','Inv:',ups.num_inventario,',Modelo: ',ups.modelo,',Capacidad: ',ups.capacidad) as ups,
                        (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*Tipo:',disco.tipo_disco,',Puerto: ',disco.tipo_puerto,',Capacidad: ',disco.capacidad),' ') as discos from disco LEFT join detalle_cpu_disco ON detalle_cpu_disco.num_inv_cpu=cpu.num_inventario where detalle_cpu_disco.id_disco=disco.id_disco) as discos,
                        (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*Inv: ',accesorio.num_inv_acc,',Tipo:',tipo_accesorio.tipo_accesorio), ' ') from accesorio LEFT join detalle_cpu_accesorio ON cpu.num_inventario=detalle_cpu_accesorio.num_inv_cpu LEFT JOIN tipo_accesorio ON accesorio.id_taccesorio=tipo_accesorio.id_taccesorio where detalle_cpu_accesorio.num_inv_accesorio=accesorio.num_inv_acc) as accesorios,
                        (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',ipv4.ip), ' ') from ipv4 LEFT join detalle_cpu_ip ON detalle_cpu_ip.num_inv_cpu=cpu.num_inventario where detalle_cpu_ip.id_ip=ipv4.id_ip) as ipv4,
                        (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*Inv: ',monitor.num_inventario,',Tipo:',monitor.tipo_monitor,',Marca:',marca.nombre_marca), ' ') from monitor LEFT join detalle_cpu_monitor ON cpu.num_inventario=detalle_cpu_monitor.num_inv_cpu LEFT JOIN marca ON monitor.id_marca=marca.id_marca where detalle_cpu_monitor.id_monitor=monitor.id_monitor) as monitores
                                                from cpu 
                                                            LEFT JOIN marca ON cpu.id_marca=marca.id_marca
                                                            LEFT JOIN procesador ON cpu.id_procesador=procesador.id_procesador
                                                            LEFT JOIN ram ON cpu.id_ram=ram.id_ram
                                                            LEFT JOIN t_video ON cpu.id_tarjeta_v=t_video.id_tarjeta_v
                                                            LEFT JOIN marca M ON M.id_marca=t_video.id_marca
                                                            LEFT JOIN ups ON cpu.id_ups=ups.id_ups where cpu.id_cpu='$id' order by fecha_ingreso desc;");

                        while($row = $row = $proof1->fetch(PDO::FETCH_ASSOC)) {

                            echo "
                        <tr>
                    
                            <td>" . $row["ipv4"] . "</td>
                            <td>" . $row["procesador"]. "</td>
                            <td>" . $row["ram"]. "</td>
                            <td>" . $row["tvideo"]. "</td>
                            <td>" . $row["ups"]. "</td>
                            <td>" . $row["discos"]. "</td>
                            <td>" . $row["accesorios"]. "</td>
                            <td>" .  $row["monitores"]. "</td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 table-responsive">
                <center>
                <strong><h4>SOFTWARE DEL EQUIPO</h4></strong>
                </center>

                <table id="software" class="table table-striped" width="100%">
                    <thead>
                    <tr>
                    <th width="1%">N°</th>
                    <th width="39%">Software</th>
                    <th width="20%">Licencia correspondiente</th> 
                    <th width="10%">Clasificación</th> 
                    <th width="10%">Duración</th>
                    <th width="10%">Renovable</th>
                    <th width="10%">F. Compra</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mbd=DB::connect();DB::disconnect();

                        $proof2=$mbd->query("SELECT licencia.id_licencia,clasificacion_licencia.clasificacion,concat(licencia.duracion,' meses') as duracion,licencia.recurrente,licencia.dia,licencia.mes,licencia.anio,
                        (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','Producto:',software.producto,',marca: ',marca.nombre_marca,',edición: ',software.edicion,',versión: ',software.version_,',categoría: ',categoria_software.categoria,',nota: ',software.nota), ' ') 
                         from software 
                         LEFT JOIN marca ON marca.id_marca=software.id_marca
                         LEFT join categoria_software ON categoria_software.id_categoria=software.id_categoria
                         WHERE licencia.id_software=software.id_software) as software
                         from licencia 
                         left join clasificacion_licencia ON clasificacion_licencia.id_clasificacion=licencia.id_clasificacion
                         INNER JOIN detalle_cpu_licencia ON detalle_cpu_licencia.id_licencia=licencia.id_licencia WHERE detalle_cpu_licencia.num_inv_cpu='$num_inventario_cpu';");

                        $contador=0;
                        while($row = $row = $proof2->fetch(PDO::FETCH_ASSOC)) {
                            $contador=$contador+1;

                            echo "
                        <tr>
                            <td>" . $contador . "</td>
                            <td>" . $row["software"] . "</td>
                            <td>" . $row["id_licencia"]. "</td>
                            <td>" . $row["clasificacion"]. "</td>
                            <td>" . $row["duracion"]. "</td>
                            <td>" . $row["recurrente"]. "</td>
                            <td>" . $row["dia"]."/".$row["mes"]."/".$row["anio"]."</td>
                           
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-xs-12 table-responsive">
                <center>
                <strong><h4>UBICACIÓN FISICA DEL EQUIPO</h4></strong>
                </center>
                <table class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                    <th style="padding-right: 150px;">Edificio</th>
                    <th style="padding-right: 80px;">Departamento</th> 
                        <th>Ubicación</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mbd=DB::connect();DB::disconnect();

                        $proof2=$mbd->query("SELECT edificio.nombre_edificio,departamento.departamento,ubicacion.ubicacion FROM cpu
                        JOIN edificio ON cpu.id_edificio=edificio.id_edificio
                        join departamento ON departamento.id_departamento=cpu.id_depto
                        join ubicacion ON ubicacion.id_ubicacion=cpu.id_ubicacion WHERE id_cpu='$id'; ");

                        while($row = $row = $proof2->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                        <tr>  
                            <td>" . $row["nombre_edificio"] . "</td>
                            <td>" . $row["departamento"]. "</td>
                            <td>" . $row["ubicacion"]. "</td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-xs-12 table-responsive">
                <center>
                <strong><h4>OTROS DATOS</h4></strong>
                </center>
                <table class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th style="padding-right: 200px;">Observaciones</th>
                        <th style="padding-right: 80px;">Equipo ingresado por:</th> 
                        <th>Presentado por:</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $usuario_actual=$_SESSION['user_session'];
                        $mbd=DB::connect();DB::disconnect();
                        $proof5=$mbd->query("SELECT nombre_usu,tipo_usuario FROM usuario_sistema WHERE id_usuario='$usuario_actual';");
                        while($row = $row = $proof5->fetch(PDO::FETCH_ASSOC)){
                            $usu=$row["nombre_usu"];
                            $tipo=$row["tipo_usuario"];
                        }
                        
                        
                        echo "
                        <tr>       
                            <td>" . $userRow['observacion'] . "</td>
                            <td>" . $userRow['ingresado_por']. "</td>
                            <td>" . " Usuario: ".$usu." ,Cargo: ".$tipo. "</td>
                        </tr>";
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer>
        <th>Generado por: <p>&copy; SOPORTECH E.U. 2023</p> </th>  
            
            </h6>Fecha de creacion:</h6><?php  if (isset($DateAndTime)) echo " ".$DateAndTime;?>

        </footer>
            
        <div class="row no-print">
            <div class="col-12 col-lg-12 col-md-12 col-xs-12">
                <a onclick="window.print()" class="btn pull-right btn-flat btn-lg btn-info"><i class="fa fa-print"></i> Imprimir</a>
                <button class="btn btn-warning btn-flat btn-lg glyphicon glyphicon-hand-left"  onclick="window.history.back()"> Volver</button>
            </div>
        </div>

    </section>
</div>
</body>
</html>