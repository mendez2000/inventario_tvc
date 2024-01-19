<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MARCAS</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../../assets/css/toastr.css" >

    <!-- Optional theme -->
    <script src="../../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="../../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../../assets/plugins/datatables/tabla.min.js" ></script>
    <script type="text/javascript" src="../../assets/js/bootbox.min.js" ></script>
    <script type="text/javascript" src="../../assets/js/toastr.js" ></script>

</head>
<body>
<nav>

</nav>

<div class="container-fluid">
    <h2>MARCAS </h2>
    <div class="row">
        <div class="col-lg-11"> <!-- Note that "m8 l9" was added -->
            <input type="text" id="valor">
            <table id="ver" class="display table  table-sm" >
                <thead class="thead-inverse">

                <tr>
                    <th data-field="id">id</th>
                    <th data-field="area">MARCA</th>
                    <th data-field="Agregar">Agregar</th>

                </tr>
                </thead>
                <tbody>
                <?php
                include_once '../../config/conexion2.php';

                $mbd=DB::connect();DB::disconnect();
                // VERDADERA
                $proof=$mbd->query("select * from marca");


                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    
                    <tr>
                    
                        <td>".$row["id_marca"]."</td>
                        <td>".$row["nombre_marca"]."</td>
                        
                        <td>
                             <a  value=\"".$row["id_marca"]."\" class=\"btn btn-info btn-sm\">
                                    <span class=\"glyphicon glyphicon-check\"></span>Agregar
                              </a></td>
                            
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
    $(document).ready(function(){

    $('#ver').DataTable();




    $("#ver tbody .btn-info").click(function(){
        var table=  $('#ver').DataTable();
        var id=$(this).attr('value');
        $("#valor").val(id);
        toastr.success('Seleccionado', "sd");
                 if ( $(this).hasClass('selected') ) {
                         $(this).removeClass('selected');
                         toastr.success('Seleccionado', id);
                      }
        else {
                  table.$('tr.selected').removeClass('selected');
                   $(this).addClass('selected');
                     toastr.success('Seleccionado', id);
             }


    });
        $('#ver tbody').on( 'click', 'tr', function () {
            var table=  $('#ver').DataTable();
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');


            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

            }
        } );

    });

</script>
</html>