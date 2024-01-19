<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Ubicacion</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
     <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../assets/css/toastr.css" >

    <!-- Optional theme -->
   <script src="../assets/plugins/jQuery/jquery-3.1.1.js" type="text/javascript"></script>

</head>
<body>
<nav>

</nav>

<div class="container-fluid">
   <h2>Ubicaciones
        <a href="ubicacion.php" class="btn btn-flat btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
    </h2>

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table" cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="id">N°</th>
                        <th data-field="Departamento">Edificio</th>
                        <th data-field="Departamento">Departamento</th>
                        <th data-field="Departamento">Ubicación</th>
                        <th data-field="Acciones">Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
                 include_once '../config/conexion2.php';
                    $mbd=DB::connect();DB::disconnect();
                    $proof=$mbd->query("SELECT id_ubicacion,ubicacion,departamento.departamento,edificio.nombre_edificio 
                    from ubicacion 
                    inner JOIN departamento ON departamento.id_departamento=ubicacion.id_departamento
                    inner join edificio ON departamento.id_edificio=edificio.id_edificio order by edificio.nombre_edificio;");
                    $contador=0;
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $contador=$contador+1;
                    echo "
                    
                    <tr>
                        <td>".$contador."</td>
                        <td>".$row["nombre_edificio"]."</td>
                        <td>".$row["departamento"]."</td>
                        <td>".$row["ubicacion"]."</td>
                        <td>
                            <a href=\"editar.php?id=".$row["id_ubicacion"]."\" class=\"btn btn-flat btn-info btn-sm\"><span class=\"glyphicon glyphicon-pencil\"></span></a>
							<a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_ubicacion"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span>
                        </td>
                            
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
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