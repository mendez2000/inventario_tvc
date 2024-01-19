<?php
include_once '../config/conexion2.php';

session_start();

if(!isset($_SESSION['tipo'])){
    echo "<script>  window.location.href='../index.php';  </script>";
}

$mbd=DB::connect();DB::disconnect();
$id = $_GET['id'];//trae el id del cpu
$stmt = $mbd->prepare("SELECT man.id_mantenimiento,man.num_inventario, man.tipo_equipo,man.fecha,man.precio ,man.tipo_mantenimiento ,man.observaciones,man.estado,man.id_departamento,departamento.departamento FROM mantenimiento man
INNER JOIN departamento ON man.id_departamento=departamento.id_departamento
where man.id_mantenimiento=:id GROUP BY num_inventario");

$stmt->execute(array(':id'=>$id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$num_inventario_cpu=$userRow['num_inventario'];

date_default_timezone_set('America/Tegucigalpa');    
$DateAndTime = date('d-m-Y h:i a', time());
//$hora = $fecha->format("H:i:s");


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/css/toastr.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.5.0/css/font-awesome.min.css">

    <!-- Optional theme -->
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
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

                <center><h3>REPORTE DE MANTENIMIENTO</h3>
                <strong><h4>DATOS GENERALES</h4></strong>
                </center>
                <table class="table table-striped" width="100%">
                    <thead>
                    <tr>
                    
                    <th width="10%">N. Inventario</th> 
                    <th width="10%">Tipo de Equipo</th>
                    <th width="10%">Fecha</th>
                    <th width="10%">Estado Actual</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo "
                            <tr>
                        
                                <td>" .$userRow['num_inventario']. "</td>
                                <td>" . $userRow['tipo_equipo'] . "</td>
                                <td>" . $userRow['fecha'] . "</td>
                                <td>" . $userRow['estado'] . "</td>
                            </tr>";
                        ?>
                    </tbody>
                </table>

                <table class="table table-striped" width="100%">
                    <thead>
                    <tr>
                        <th width="10%">Precio</th> 
                        <th width="10%">Mantenimiento</th>
                        <th width="10%">Observaciones</th>
                        <th width="10%">Departamento</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo "
                            <tr>
                        
                                <td>" .$userRow['precio']. "</td>
                                <td>" . $userRow['tipo_mantenimiento'] . "</td>
                                <td>" . $userRow['observaciones'] . "</td>
                                <td>" . $userRow['departamento'] . "</td>
                            </tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
                </center>
                <table class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                      
           
                        <th>Generado por: <p>&copy; SOPORTECH E.U. 2023</p> </th>  
                    </tr>

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
                            <td>" . " Tecnico Responsable: ".$usu." , Cargo: ".$tipo. "</td>
                        </tr>";
                        
                        ?>
                          </h6>Fecha de creacion:</h6><?php  if (isset($DateAndTime)) echo " ".$DateAndTime;?>
                       
               

                    </tbody>
                </table>
            </div>
        </div>

            
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