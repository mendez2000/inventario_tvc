<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accesorios</title>
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
    <h2>Matenimiento
        <a href="mantenimiento.php" class="btn btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
    </h2>
    <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12 table-responsive">
            <table id="ver" class="display table " cellspacing="0" >
                <thead>
                <tr>
                    <th data-field="inventario">Tipo Equipo</th>
                    <th data-field="Marca">Inventario</th>
                    <th data-field="tipo">Fecha</th>
                    <th data-field="Ver">Estado</th>
                    <th data-field="Ver">Tipo Mantenimiento</th>
                    <th data-field="Editar">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once '../config/conexion2.php';
                $mbd=DB::connect();DB::disconnect();

                $proof=$mbd->query("SELECT * FROM mantenimiento");
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    <tr>
                        <td>".$row["tipo_equipo"]."</td>
                        <td>".$row["num_inventario"]."</td>
                        <td>".$row["fecha"]."</td>
                        <td>".$row["estado"]."</td>   
                        <td>".$row["tipo_mantenimiento"]."</td>                   
                        <td>
                             <a href=\"editar.php?id=".$row["id_mantenimiento"]."\" class=\"btn btn-flat btn-info btn-sm\">
                                    <span class=\"glyphicon glyphicon-pencil\"></span>
                              </a>
                              <a href=\"imprimir_man.php?id=".$row["id_mantenimiento"]."\" class=\"btn btn-flat btn-info btn-sm\"><span class=\"glyphicon glyphicon-folder-open\"></span></a>
                              <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_mantenimiento"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\">
                              <span class=\"glyphicon glyphicon-trash\"></span></a></td></td>
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
                    tarea: 'eliminar',
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