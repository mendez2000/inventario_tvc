
<?php include_once '../config/conexion2.php'; 

$mbd=DB::connect();DB::disconnect();
             $proof=$mbd->query("SELECT ups.id_ups,ups.num_inventario,marca.nombre_marca,ups.modelo,capacidad,cpu.num_inventario as cpu,ups.fecha_compra,ups.observacion 
             FROM ups 
             LEFT JOIN marca ON ups.id_marca=marca.id_marca
             LEFT JOIN cpu ON cpu.id_ups=ups.id_ups
             ORDER BY ups.fecha_compra;");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UPS</title>
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
   <h2>UPS
        <a href="ups.php" class="btn btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
    </h2>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 table-responsive"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table " cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="inventario">N°</th>
                        <th data-field="inventario">Inventario</th>
                        <th data-field="Marca">Marca</th>
                        <th data-field="tipo">Modelo</th>
                        <th data-field="Ver">Capacidad</th>
                        <th data-field="Ver">CPU Asignado</th>
                        <th data-field="inventario">Fecha de Compra</th>
                        <th data-field="Marca">Observación</th>
                        <th data-field="Marca">Acciones</th>
                    </tr>
                </thead> 
                <tbody>    
                <?php
                $contador=0;
                while( $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $cpu=$row["cpu"];
                    $contador=$contador+1;
                    if ($cpu=="")
                    {
                        $mensaje="UPS no asignada";
                    }
                    else
                    {
                        $mensaje="CPU: ".$cpu;
                    }
                    echo "
                    <tr> 
                        <td>".$contador."</td>
                        <td>".$row["num_inventario"]."</td>
                        <td>".$row["nombre_marca"]."</td>
                        <td>".$row["modelo"]."</td>
                        <td>".$row["capacidad"]."</td>
                        <td>".$mensaje."</td>
                        <td>".$row["fecha_compra"]."</td>
                        <td>".$row["observacion"]."</td>
                        <td><a href=\"editar.php?id=".$row["id_ups"]."\" class=\"btn btn-flat btn-info btn-sm\"> <span class=\"glyphicon glyphicon-pencil\"></span></a>
                        <a name=\"eliminar\" value=".$row["id_ups"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span></a></td> 
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
<!-- Latest compiled and minified JavaScript -->
<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
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
                        data=data.split("|");
                            $.each(data, function(i, item) {

                            if (item=="actualizado"){
                                toastr.success('Éxito','Actualizado correctamente');
                            
                            }
                            else if (item=="Error")
                            {
                                toastr.warning('Error','cpu existente!');
                            }
                        });
   					  
                    },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
            //location.reload();
            setTimeout(() => {
                location.reload();
            }, 3000);
            }
    </script>
</html>