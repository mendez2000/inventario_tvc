<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MARCAS</title>
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
   <h2>TODO EL EQUIPO DE IT BROADCAST
        
    </h2>

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12"> <!-- Note that "m8 l9" was added -->
            <table id="ver" class="display table" cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="id">N°</th>
                        <th data-field="Departamento">Num. Inventario</th>
                        <th data-field="Departamento">Descripción</th>
                        
                    </tr>
                </thead> 
                <tbody>
                <?php
                 include_once '../config/conexion2.php';
                    $mbd=DB::connect();DB::disconnect();
                    $proof=$mbd->query("SELECT * FROM equipo;");
                    $contador=0;
                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    $contador=$contador+1;
                    echo "
                    
                    <tr>
                    
                        <td>".$contador."</td>
                        <td>".$row["num_inventario"]."</td>
                        <td>".$row["descripcion"]."</td>
                        
                        
                            
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

    $(document).ready(function(){
        $('#ver').DataTable();
		$(".btn-danger").click(function(){
		    var id=$(this).attr('value');
                bootbox.confirm("seguro que lo quiere eliminar?", function(result) {
                if(result==true){
                    eliminar(id);
                }
            });   
        });
    });
			   

  

    
    
 </script>
</html>