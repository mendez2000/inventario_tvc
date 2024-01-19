<?php

session_start();

if(!isset($_SESSION['tipo'])){
    echo "<script>  window.location.href='../index.php';  </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPU</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css" >
    <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" type="text/css" href="../assets/css/toastr.css">

    <!-- Optional theme -->
    <script src="../assets/plugins/jQuery/jquery-3.1.1.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../assets/plugins/datatables/extensions/juanExt/colvis/buttons.dataTables.min.css">
</head>
<style type="text/css">

    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<body>

<!-- cierra el modal -->
<div class="container-fluid">
    <h4>SOFTWARE DEL EQUIPO
        <a href="cpu.php" class="btn btn-flat btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
	    <a  class="btn btn-flat btn-primary btn-md" id="unsave">
            <span class="glyphicon glyphicon-refresh"></span>
        </a>
    </h4>

    <div class="col-12 col-lg-12 col-md-12 table-responsive"> <!-- Note that "m8 l9" was added -->
        <table id="ver" class="display table" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th data-field="Inventario">Inv. CPU</th>
                    <th data-field="Nombre">Software asignado</th>   
                    <th data-field="Ubicacion">Información de la licencia</th>         
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config/conexion2.php';
                $mbd=DB::connect();DB::disconnect();

                $proof=$mbd->query("SELECT detalle_cpu_licencia.num_inv_cpu, software.producto,marca.nombre_marca,software.edicion,software.version_,categoria_software.categoria,software.nota,clasificacion_licencia.clasificacion,licencia.recurrente,licencia.cantidad,licencia.dia,licencia.mes,licencia.anio
                from detalle_cpu_licencia
                LEFT join licencia ON licencia.id_licencia=detalle_cpu_licencia.id_licencia
                LEFT join clasificacion_licencia ON clasificacion_licencia.id_clasificacion=licencia.id_clasificacion
                
                LEFT join software on software.id_software=licencia.id_software
                LEFT join marca on  marca.id_marca=software.id_marca
                left join categoria_software on categoria_software.id_categoria=software.id_categoria order by detalle_cpu_licencia.num_inv_cpu;");

                while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                
                    echo "     
                    <tr>                        
                        <td>".$row["num_inv_cpu"]."</td>
                        <td>"."Producto: ".$row["producto"].", marca: ".$row["nombre_marca"].", edición: ".$row["edicion"].", versión:".$row["version_"].", categoría: ".$row["categoria"].", nota: ".$row["nota"]."</td>
                        <td>"."Clasificación: ".$row["clasificacion"].", Renovable: ".$row["recurrente"].", Cantidad de asientos: ".$row["cantidad"].", fecha adquirida: ".$row["dia"]."/".$row["mes"]."/".$row["anio"]."</td>
                        
                    </tr>";
                }
                ?>
            </tbody>

            <tfoot>
            </tfoot>

        </table>
    </div>


    <div class="btn-group pull-right"> 
        <a onclick=goBack2() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Ubicación fisica</a> 
        <a onclick=goBack() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Hardware</a>

        <a onclick=goBack3() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> General</a> 

    </div>
   

</div>
</body>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/jquery-3.5.1.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/dataTables.fixedHeader.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/jszip.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/pdfmake.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/vfs_fonts.js" ></script>

    <script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/extensions/juanExt/colvis/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/extensions/juanExt/colvis/buttons.print.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/extensions/juanExt/colvis/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/datatables/extensions/juanExt/colvis/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script type="text/javascript" src="../assets/js/bootbox.js" ></script>


    <script>
        $(document).ready(function () {
            $("#unsave").click(function(){
                    table.state.clear();
                    window.location.reload();
            });

            // Setup - add a text input to each footer cell
            $('#ver thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#ver thead');
        
            var table = $('#ver').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function () {
                    var api = this.api();
        
                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
             
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" size="10" placeholder="' + title + '" />');
        
                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; 
        
                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();
        
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },


                stateSave: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        'colvis',
                    ],
                    "aLengthMenu": [ [10, 15, 20, -1], [10, 15, 20, "All"] ],
                    "iDisplayLength" : 10,   

                    
                    
            });


        });
        
        function goBack2(){ setTimeout(function(){  window.location.href="ubicacion.php";  }, 30); }
        function goBack3(){ setTimeout(function(){  window.location.href="ver-ot.php";  }, 30); }
        function goBack(){ setTimeout(function(){  window.location.href="hardware.php";  }, 30); }

</script>
</html>