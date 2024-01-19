<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Switcher</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css" >
    <link rel="stylesheet" href="../assets/css/toastr.css" >

    <!-- Optional theme -->
   <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

</head>
<body>
    <div class="container-fluid">
        <h2>Router/Switch
            <a href="swt_rt.php" class="btn btn-flat btn-success btn-md">
                <span class="glyphicon glyphicon-plus"></span> Nuevo
            </a>
        </h2>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div style="overflow-x:auto;"> <!-- Note that "m8 l9" was added -->
                    <table id="ver" class="display table" cellspacing="0">
                        <thead>
                            <tr>
                                <th data-field="ID">N°</th>
                                <th data-field="Inventario">Inventario</th>
                                <th data-field="Tipo">Tipo</th>
                                <th data-field="Marca">Marca</th>
                                <th data-field="Modelo">Modelo</th>
                                <th data-field="Serie">Serie</th>
                                <th data-field="Departamento">Departamento</th>
                                <th data-field="Dir.IP">Dir.IP</th>
                                <th data-field="Estado">Estado</th>
                                <th data-field="Estado">Acciones</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php
                            include_once '../config/conexion2.php';
                            $mbd=DB::connect();DB::disconnect();
                            $proof=$mbd->query("SELECT * FROM swt_rt
                            LEFT JOIN marca ON swt_rt.id_marca=marca.id_marca
                            LEFT JOIN departamento ON swt_rt.id_depto=departamento.id_departamento 
                            LEFT JOIN ipv4 ON swt_rt.id_ip=ipv4.id_ip
                            LEFT JOIN tipo_estado ON swt_rt.id_estado=tipo_estado.id_estado");
                            

                            $contador=0;
                            while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                                $contador=$contador+1;
                                echo "
                                <tr>
                                    <td>".$contador."</td>
                                    <td>".$row["num_inventario"]."</td>
                                    <td>".$row["tipo_equipo"]."</td>
                                    <td>".$row["nombre_marca"]."</td>
                                    <td>".$row["modelo"]."</td>
                                    <td>".$row["serial"]."</td>
                                    <td>".$row["departamento"]."</td>
                                    <td>".$row["ip"]."</td>
                                    <td>".$row["nombre_estado"]."</td>
                                                        
                                        <td> <div class=\" row \"> <a href=\"editar.php?id=".$row["id_swt_rt"]."\" class=\"btn btn-flat btn-info btn-sm\">
                                                <span class=\"glyphicon glyphicon-pencil\"></span></a>
                                        <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_swt_rt"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\">
                                            <span class=\"glyphicon glyphicon-trash\"></span></a> </div></td> 
                                        
                                        
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Latest compiled and minified JavaScript -->
<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>

<script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
<script type="text/javascript" src="../assets/js/toastr.js" ></script>
    <script>
        $(document).ready(function(){
                    $('#ver').DataTable();
        });

        
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
                        tarea: 'eliminar2',
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