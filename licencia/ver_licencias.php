<?php

session_start();

if(!isset($_SESSION['tipo'])){
    echo "<script>  window.location.href='../index.php';  </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Licencias</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
     <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
     <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css" >
     <link rel="stylesheet" href="../assets/css/toastr.css" >

    <!-- Optional theme -->
   <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
    <script type="text/javascript" src="../assets/js/bootbox.js" ></script>
    <script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
    <script type="text/javascript" src="../assets/js/toastr.js" ></script>

</head>
<body>
<div class="container-fluid">
   <h2>Licencias
        <a href="licencia.php" class="btn btn-flat btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
        <a href="ver_advance.php" class="btn btn-flat btn-primary btn-md">
            <span class="glyphicon glyphicon-eye-open"></span>
        </a>
    </h2>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 table-responsive"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table" cellspacing="0">
                <thead>
                    
                    <tr>
                        <th >N°</th>
                        <th >Id Licencia</th>
                        <th >Clasificación</th>
                        <th >Software correspondiente</th>
                        <th >Fecha de Compra</th>
                        <th >¿Renovable?</th>
                        <th >Duración (meses)</th>
                        <th >Vigencia</th>
                        <th >N° Asientos</th>
                        <th >Asientos libres</th>
                        <th data-field="Acciones" style="center">Acciones</th>
                        
                    </tr>
                </thead> 
                <tbody>
                <?php
                include_once '../config/conexion2.php';
               
                $mbd=DB::connect();DB::disconnect();
                // VERDADERA
                $proof=$mbd->query("SELECT id_licencia,clasificacion_licencia.clasificacion,
                (SELECT GROUP_CONCAT(concat_WS(' ',	software.producto,software.edicion,software.version_,categoria_software.categoria), ' ') from software left join categoria_software ON categoria_software.id_categoria=software.id_categoria where software.id_software=licencia.id_software ) as software,CONCAT_WS('-',	licencia.dia,licencia.mes,licencia.anio) as fecha_compra,duracion,recurrente,cantidad,disponibilidad FROM `licencia`
                          LEFT join clasificacion_licencia ON clasificacion_licencia.id_clasificacion=licencia.id_clasificacion;");        
           		$acum=0;
                $contador_periodo=0;
                $fechaActual = date('d-m-Y');

                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){

                    $acum=$acum+1;
                    $recurrente=$row["recurrente"];
                    $fecha_compra=$row["fecha_compra"];

                    if ($recurrente=="SI")
                    {
                        $duracion=$row["duracion"];
                        $datetime1=new DateTime($fechaActual);
                        $datetime2=new DateTime($fecha_compra);
                        
                        # obtenemos la diferencia entre las dos fechas en meses 
                        $interval=$datetime2->diff($datetime1);
                        $intervalMeses=$interval->format("%m");
                        $intervalAnos = $interval->format("%y")*12;
                        $anios = $interval->format("%y");
                        $totalmeses=($intervalMeses+$intervalAnos);
                    
                        if ($totalmeses > $duracion){
                            $meses=$totalmeses;
                            while ( $meses > $duracion ){
                                $diferencia=($meses-$duracion);
                                
                                if ($diferencia > $duracion){
                                    $meses=$diferencia;
                                }

                                else if ($diferencia < $duracion)
                                
                                {
                                    $faltante=($duracion-$diferencia);
                                    $meses=$faltante;
                                    //meses faltantes
                                    if ($faltante>1){
                                        $mensaje= $meses." meses faltantes";
                                    }
                                    else
                                    {
                                        $mensaje= $meses." mes faltante";
                                    }

                                    if ($anios>1){
                                        $mensaje1= "Desde hace ".$anios." años";
                                    }
                                    else
                                    {
                                        $mensaje1= "Desde hace ".$anios." año";
                                    }

                                    
                                }
                                
                                else if ($diferencia == $duracion)
                                
                                {
                                    $meses=$diferencia;
                                    $mensaje= "Renovación reciente";

                                    if ($anios>1){
                                        $mensaje1= "Desde hace ".$anios." años";
                                    }
                                    else
                                    {
                                        $mensaje1= "Desde hace ".$anios." año";
                                    }
                                }

                                
            
                            }
                            
                        }
                        else if ( $totalmeses < $duracion)
                            
                        {
                            $meses=$totalmeses;
                            $diferencia=($duracion-$meses);
                            $meses=$diferencia;
                            //echo $meses." meses faltantes";;
                            
                            if ($meses>1){
                                $mensaje= $meses." meses faltantes";
                            }
                            else
                            {
                                $mensaje= $meses." mes faltante";
                            }
        
                            if ($anios>1){
                                $mensaje1= "Desde hace ".$anios." años";
                            }
                            else
                            {
                                $mensaje1= "Desde hace ".$anios." año";
                            }

                        }

                        else if ($totalmeses == $duracion)
                        
                        {
                            
                            //echo "Renovación reciente";
                            $mensaje="A punto de renovarse";
                            if ($anios>1){
                                $mensaje1= "Desde hace ".$anios." años";
                            }
                            else
                            {
                                $mensaje1= "Desde hace ".$anios." año";
                            }
                            
                        }

                    }
                    else if ($recurrente=="NO")
                    {
                        $duracion=$row["duracion"];
                        $datetime1=new DateTime($fechaActual);
                        $datetime2=new DateTime($fecha_compra);
                        
                        # obtenemos la diferencia entre las dos fechas en meses 
                        $interval=$datetime2->diff($datetime1);
                        $intervalAnos = $interval->format("%y");

                        $mensaje="ILIMITADO";

                        if ($intervalAnos>1){
                            $mensaje1= "Desde hace: ".$intervalAnos." años ";
                        }
                        else
                        {
                            $mensaje1= "Desde hace: ".$intervalAnos." año";
                        }

                        
                    }

                    
                   
                    echo "
                    <tr>
                        <td>".$acum."</td>
                        <td>".$row["id_licencia"]."</td>
                        <td>".$row["clasificacion"]."</td>
                        <td>".$row["software"]."</td>
                        <td>".$row["fecha_compra"]."</td>
                        <td>".$recurrente."</td>
                        <td>".$duracion."</td>
                        <td>".$mensaje."</td>
                        <td>".$row["cantidad"]."</td>
                        <td>".$row["disponibilidad"]."</td>

                        <td><a href=\"editar.php?id=".$row["id_licencia"]."\" class=\"btn btn-flat btn-info btn-sm\"> <span class=\"glyphicon glyphicon-pencil\"></span></a>
                        <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_licencia"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span></a></td> 
                            
                    </tr>";
                }
                ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
</body>
<script src="../assets/bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
<script type="text/javascript" src="../assets/js/toastr.js" ></script>


    <script>
			 
    $(document).ready(function(){
            var table = $('#ver').DataTable();
            
            $("a[name='eliminar']").click(function(){
                var id=$(this).attr('value');
                bootbox.confirm("Seguro que lo quiere eliminar?", function(result) {
                        if(result==true){
                            eliminar(id);
                        }
                });
            });

            table.on( 'draw', function () {
                
                $("a[name='eliminar']").off('click').click(function(){
                        var id=$(this).attr('value');
                        bootbox.confirm("Seguro que lo quiere eliminar?", function(result) {
                        
                        if(result==true){
                                    eliminar(id);
                        }
                });
                
            });

            } );
            
    });
    

    function eliminar (id){
        $.ajax(//funcion ajax le mando la tarea al switch y creo new variables que tienen el valor del form
            {
                type: "POST",
                url: "consultas.php",
                data: {
                    tarea: 'eliminar',
                    id: id
                   
                },
                success: function (data){

                    //alert(data);
					  location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
    }

    
    
 </script>
</html>