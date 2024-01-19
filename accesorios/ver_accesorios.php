<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Accesorios </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
     <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../assets/css/toastr.css" >
    <!-- Optional theme -->
   <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

</head>
<body>
<div class="container-fluid">
   <h2>Accesorios
                        <a href="accesorios.php" class="btn btn-success btn-md">
                            <span class="glyphicon glyphicon-plus"></span> Nuevo
                        </a>
       
                    </h2>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 table-responsive"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table " cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="numero">N°</th>
                        <th data-field="inventario">Inventario</th>
                        <th data-field="tipo">Tipo</th>
                        <th data-field="modelo">Modelo</th>
                        <th data-field="marca">Marca</th>
                        <th data-field="serie">Serie</th>
                        <th data-field="fechacompra">Fecha de Compra</th>
                        <th data-field="cpucorrespo">CPU correspondiente</th>
                        <th data-field="acciones">Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
                 include_once '../config/conexion2.php';
               
              $mbd=DB::connect();DB::disconnect();

             $proof=$mbd->query("SELECT accesorio.id_accesorio,accesorio.num_inv_acc,accesorio.modelo,accesorio.serie,accesorio.id_taccesorio,accesorio.id_marca,accesorio.fecha_compra,marca.nombre_marca,tipo_accesorio.tipo_accesorio,detalle_cpu_accesorio.num_inv_cpu 
             FROM accesorio 
             LEFT JOIN marca ON marca.id_marca=accesorio.id_marca
             LEFT join detalle_cpu_accesorio ON detalle_cpu_accesorio.num_inv_accesorio=accesorio.num_inv_acc
             INNER JOIN tipo_accesorio ON tipo_accesorio.id_taccesorio=accesorio.id_taccesorio ORDER BY accesorio.id_accesorio DESC;");
             $contador=0;
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $contador=$contador+1;

                    $cpu=$row["num_inv_cpu"];
                    if ($cpu==""){

                        $mensaje="Accesorio no asignado";
                    }
                    else
                    {
                        $mensaje="CPU: ".$cpu;
                    }
                    echo "
                    <tr>
                        <td>".$contador."</td>
                        <td>".$row["num_inv_acc"]."</td>
                        <td>".$row["tipo_accesorio"]."</td>
                        <td>".$row["modelo"]."</td>
                        <td>".$row["nombre_marca"]."</td>
                        <td>".$row["serie"]."</td>
                        <td>".$row["fecha_compra"]."</td>
                        <td>".$mensaje."</td>
                        <td><a href=\"editar.php?id=".$row["id_accesorio"]."\" class=\"btn btn-flat btn-info btn-sm\">
                                    <span class=\"glyphicon glyphicon-pencil\"></span></a>
                        <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_accesorio"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\">
                                    <span class=\"glyphicon glyphicon-trash\"></span></a></td> 
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
<!-- Latest compiled and minified JavaScript -->
<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
<script type="text/javascript" src="../assets/js/toastr.js" ></script>




<script>

$(document).ready(function () {
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
                    tarea:"eliminar2",
                    id: id
                },
                success: function (data){
					  location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
    }

    
    
 </script>
</html>