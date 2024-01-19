<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ESTADOS</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
     <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../assets/css/toastr.css" >

    <!-- Optional theme -->
   <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>


</head>
<body>
<nav>

</nav>

<div class="container-fluid">
   <h2>ESTADOS
                        <a href="estado.php" class="btn btn-flat btn-success btn-md">
                            <span class="glyphicon glyphicon-plus"></span> Nuevo
                        </a>
                        <a href="../desplegables/indexform.php">
                        <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat">Mantenimientos</button>
                        </a>
    </h2>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 table-responsive"> <!-- Note that "m8 l9" was added -->
            <table id="ver" name="ver" class="display table" cellspacing="0" >
                <thead>
                    
                    <tr>
                        <th data-field="id">N°</th>
                        <th data-field="area">Estado</th>
                        <th data-field="descripcion">Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
                 include_once '../config/conexion2.php';
               
              $mbd=DB::connect();DB::disconnect();
                // VERDADERA
             $proof=$mbd->query("select * from tipo_estado");
                                   
             $contador=0;
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $contador=$contador+1;
                    echo "
                    <tr>
                        <td>".$contador."</td>
                        <td>".$row["nombre_estado"]."</td>
                        
                        <td>
                             <a href=\"editarestado.php?id=".$row["id_estado"]."\" class=\"btn btn-flat btn-info btn-sm\">
                                    <span class=\"glyphicon glyphicon-pencil\"></span>
                              </a>
                            <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_estado"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span>
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