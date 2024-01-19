<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monitores</title>
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
   <h2>Monitores
        <a href="monitor.php" class="btn btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>

    </h2>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12 table-responsive"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table " cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="inventario">Inventario</th>
                        <th data-field="Marca">Marca</th>
                        <th data-field="Serie">Serie</th>
                        <th data-field="Modelo">Modelo</th>
                        <th data-field="Tamaña">Tamaño</th>
                        <th data-field="Tipo">Tipo</th>
                        <th data-field="Fecha_Compra">Fecha de Compra</th>
                        <th data-field="CUP">CPU Asignado</th>
                        <th data-field="OBS">Observaciones</th>
                        <th data-field="Acciones">Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
                 include_once '../config/conexion2.php';
               
              $mbd=DB::connect();DB::disconnect();

             $proof=$mbd->query("SELECT monitor.id_monitor,monitor.num_inventario,marca.nombre_marca,monitor.serie,monitor.serv_tag,monitor.tamano,monitor.tipo_monitor,monitor.observacion,monitor.fecha_compra,detalle_cpu_monitor.num_inv_cpu AS CPU FROM monitor 
             LEFT JOIN marca ON monitor.id_marca=marca.id_marca 
             left join detalle_cpu_monitor ON detalle_cpu_monitor.id_monitor=monitor.id_monitor
             ORDER BY monitor.id_monitor DESC;");
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $cpu=$row["CPU"];
                    if ($cpu=="")
                    {
                        $mensaje="Monitor no asignado";

                    }
                    else
                    {
                        $mensaje="CPU: ".$cpu;

                    }
                    echo "
                    <tr>
                        <td>".$row["num_inventario"]."</td>
                        <td>".$row["nombre_marca"]."</td>
                        <td>".$row["serie"]."</td>
                        <td>".$row["serv_tag"]."</td>
                        <td>".$row["tamano"]."</td>
                        <td>".$row["tipo_monitor"]."</td>
                        <td>".$row["fecha_compra"]."</td>
                        <td>".$mensaje."</td>

                        <td>".$row["observacion"]."</td>
                        <td><a href=\"editar.php?id=".$row["id_monitor"]."\" class=\"btn btn-flat btn-info btn-sm\"><span class=\"glyphicon glyphicon-pencil\"></span></a>
                        <a name=\"eliminar\" value=\"".$row["id_monitor"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span></a>
                        </td> 
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
        bootbox.confirm("seguro que lo quiere eliminar?", function(result) {
                if(result==true){
                    eliminar(id);
                }
        });
    });

    table.on( 'draw', function () {
        //alert("seleccion de pagina");
        
        $("a[name='eliminar']").off('click').click(function(){
                var id=$(this).attr('value');
                bootbox.confirm("seguro que lo quiere eliminar?", function(result) {
                
                if(result==true){
                            eliminar(id);
                }
        });
        
    });
    
        //alert("seleccion de pagina");
    } );
    
});
			   

    function eliminar (id){


        $.ajax(//funcion ajax le mando la tarea al switch y creo new variables que tienen el valor del form
            {
                type: "POST",
                url: "consultas.php",
                data: {
                    tarea: 'eliminar2',
                    id: id
                },
                success: function (data){
                    data=data.split("|");
                        $.each(data, function(i, item) {

                        if (item=="actualizado"){
                            toastr.success('Éxito','Actualizado correctamente');
                            //limpiarcampos();
                        }
                        else if (item=="Error")
                        {
                            toastr.warning('Error','Cpu existente!');
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