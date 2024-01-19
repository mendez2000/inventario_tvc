<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Licencia</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" >
     <link rel="stylesheet" href="../../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css" >

    <!-- Optional theme -->
   <script src="../../assets/plugins/jQuery/jquery-3.1.1.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="../../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../../assets/plugins/datatables/tabla.min.js" ></script>
    <script type="text/javascript" src="../../assets/js/bootbox.js" ></script>
    <script type="text/javascript" src="../../assets/js/bootbox.min.js" ></script>
    <script type="text/javascript" src="../../assets/js/toastr.js" ></script>

</head>
<body>
<nav>

</nav>

<div class="container-fluid">
   <h2>CLASIFICACIONES
        <a href="clasificacion.php" class="btn btn-flat btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
        </a>
        <a href="../indexform.php">
        <button type="button" id="cerrarmar" name="cerrarmar" class="btn btn-danger btn-flat"> <span class="fa fa-database"></span> Mantenimientos</button>
        </a>
    </h2>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 table-responsive"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table" cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="ID">N°</th>
                        <th >Clasificación de Licencia</th>
                        <th >Tipo Identificador</th>
                        <th data-field="Acciones">Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
                include_once '../../config/conexion2.php';
                $mbd=DB::connect();DB::disconnect();
                $proof=$mbd->query("SELECT * from clasificacion_licencia;");
                $acum=0;
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $acum=$acum+1;
                    echo "
                    <tr>
                        <td>".$acum."</td>
                        <td>".$row["clasificacion"]."</td>
                        <td>".$row["tipo_identificador"]."</td>

                        <td>
                            <a href=\"editar.php?id=".$row["id_clasificacion"]."\" class=\"btn btn-flat btn-info btn-sm\"><span class=\"glyphicon glyphicon-pencil\"></span></a>
                            <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_clasificacion"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span>
                            </a>
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

    <script>

        $(document).ready(function () {
            var table = $('#ver').DataTable();

            $("a[name='eliminar']").click(function(){  
                var id=$(this).attr('value');
                bootbox.confirm("Seguro que lo quiere eliminar?", function(result) {
                    //alert("seleccion de pagina2");
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
                    tarea:"eliminar",
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