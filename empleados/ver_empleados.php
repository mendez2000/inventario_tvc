<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

    <!-- Optional theme -->


    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/js/bootbox.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
<script type="text/javascript" src="../assets/js/toastr.js" ></script>

    <script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>

</head>
<body>
<nav>

</nav>

<div class="container-fluid">
      <h2>Empleados
                        <a href="empleados.php" class="btn btn-flat btn-success btn-md">
                            <span class="glyphicon glyphicon-plus"></span>Nuevo
                        </a>

                        <!--<a href="../desplegables/indexform.php">
                        <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat">Mantenimientos</button>
                        </a>-->

                       <!--<a href="ver_advance.php" class="btn btn-flat btn-primary btn-md">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>-->
                        
                    </h2>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12"> <!-- Note that "m8 l9" was added -->
         <table id="ver" class="display table" cellspacing="0" >
                <thead>
                 
                                                              
                                                                 
                    <tr>
                        <th data-field="nombre"> N° </th>
                        <th data-field="nombre">Nombre</th>
                        <th data-field="apellido">Apellido</th>
                        <th data-field="telefono">Telefono</th>
                        <th data-field="correo">Correo</th>
                        <th data-field="departamento">Departamento</th>
                        <th data-field="Acciones">Acciones</th>

                    </tr>
                    
                <tbody> 
                <?php
                include_once '../config/conexion2.php';
               // $cn = new conexion();
              $mbd=DB::connect();DB::disconnect();
             $proof=$mbd->query("SELECT e.id_empleado,e.nombre,e.apellido,e.telefono,e.correo,d.departamento FROM empleados e INNER JOIN departamento d ON e.id_departamento=d.id_departamento ORDER BY e.id_empleado;");
                                   
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    
                    <tr>                           
                        <td>".$row["id_empleado"]."</td>
                        <td>".$row["nombre"]."</td>
                        <td>".$row["apellido"]."</td>
                        <td>".$row["telefono"]."</td>
                        <td>".$row["correo"]."</td>  
                        <td>".$row["departamento"]."</td>                                          
                        <td><a href=\"editar.php?id=".$row["id_empleado"]."\" class=\"btn btn-flat btn-info btn-sm\">
                                    <span class=\"glyphicon glyphicon-pencil\"></span></a>
                                    <a id=\"eliminar\" name=\"eliminar\" value=\"".$row["id_empleado"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span></a></td> 
                                      
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
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
</body>
</html>