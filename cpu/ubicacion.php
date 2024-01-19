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

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css" >
    <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" type="text/css" href="../assets/css/toastr.css">


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
    <h4>UBICACIÓN DEL EQUIPO
        <a href="cpu.php" class="btn btn-flat btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
	<a  class="btn btn-flat btn-primary btn-md" id="unsave">
            <span class="glyphicon glyphicon-refresh"></span>
        </a>
    </h4>

    <div class="col-xs-12 col-lg-12 col-md-12 table-responsive"> 
        <table id="ver" name="ver" class="display table" cellspacing="0" width="100%" >
            <thead>
            <tr>
                <th  data-field="Inventario">Edificio</th>
                <th data-field="Nombre">Departamento</th>
                <th data-field="modelo">Ubicación</th>
                <th data-field="Ubicacion">CPU Inventario</th>
                <th data-field="Estado">Clasificación</th>
                <th data-field="Ubicacion">Estado</th>
                <th data-field="Acciones">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once '../config/conexion2.php';
            $mbd=DB::connect();DB::disconnect();

            $proof=$mbd->query("SELECT cpu.id_cpu,cpu.num_inventario,tipo_estado.nombre_estado, clasificacion.nombre_clasif,edificio.nombre_edificio,departamento.departamento,ubicacion.ubicacion FROM cpu
            left join clasificacion ON cpu.id_clasificacion=clasificacion.id_clasificacion_cpu
            left join tipo_estado ON cpu.id_estado=tipo_estado.id_estado
            left join edificio ON cpu.id_edificio=edificio.id_edificio
            left join departamento ON cpu.id_depto=departamento.id_departamento
            left join ubicacion ON cpu.id_ubicacion=ubicacion.id_ubicacion order by edificio.nombre_edificio;");

            while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                $inv=$row["num_inventario"];
                echo "     
                    <tr>                        
                        <td>".$row["nombre_edificio"]."</td>
                        <td>".$row["departamento"]."</td>
                        <td>".$row["ubicacion"]."</td>
                        <td>".$row["num_inventario"]."</td>
                        <td>".$row["nombre_clasif"]."</td>
                        <td>".$row["nombre_estado"]."</td>
                        <td><a href=\"editar_n.php?id=".$row["id_cpu"]."\" class=\"btn btn-flat btn-warning btn-sm\"><span class=\"glyphicon glyphicon-pencil\"></span></a>
                        <a href=\"imprimir_cpu.php?id=".$row["id_cpu"]."\" class=\"btn btn-flat btn-info btn-sm\"><span class=\"glyphicon glyphicon-folder-open\"></span></a>
                        <a name=\"eliminar\" value=\"".$row["num_inventario"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>
                    </tr>";
            }
            ?>

            </tbody>

        <tfoot>
        </tfoot>

        </table>
    </div>


    <div class="btn-group pull-right"> 
        <a onclick=goBack() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Hardware</a>
        <a onclick=goBack3() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> General</a> 
        <a onclick=goBack4() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Software</a> 
    </div>

   

</div>
</body>

<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/bootbox.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
<script type="text/javascript" src="../assets/js/toastr.js" ></script>

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


<script>


$(document).ready(function () {
    $("#unsave").click(function(){
			table.state.clear();
			window.location.reload();
	});

 
    $('#ver thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#ver thead');
 
    var table = $('#ver').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
           
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
              
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" size="10" placeholder="' + title + '" />');

                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                     
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; 
 
                            var cursorPosition = this.selectionStart;
                      
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
            "iDisplayLength" : 15,   

            
            
    });


});
 
    $(document).ready(function () {
        var table = $('#ver').DataTable();

        $("a[name='eliminar']").click(function(){  
            var num_inventario=$(this).attr('value');
            bootbox.confirm("Seguro que lo quiere eliminar?", function(result) {
                //alert("seleccion de pagina2");
                    if(result==true){
                        
                        eliminar(num_inventario);
                    }
            });
        });

     table.on( 'draw', function () {
       
        
        $("a[name='eliminar']").off('click').click(function(){
                var num_inventario=$(this).attr('value');
                    bootbox.confirm("Seguro que lo quiere eliminar?", function(result) {
                    
                    if(result==true){
                        eliminar(num_inventario);
                    }
                });
    
            });
        } );

    });

    function eliminar(num_inventario){
        console.log(inventario);

    $.ajax(
    {
        type: "POST",
        url: "consultas_cpu.php",
        data: {
            tarea: 'eliminar',
            num_inventario: num_inventario
        },
        success: function (data)
        {
            data=data.split("|");
            $.each(data, function(i, item) {
                if (item=="exito"){
                    toastr.warning('CPU Eliminado!');
                    window.location.reload();
                }

            });
        },


        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });

    }

    function goBack(){ setTimeout(function(){  window.location.href="hardware.php";  }, 30); }
    function goBack3(){ setTimeout(function(){  window.location.href="ver-ot.php";  }, 30); }
    function goBack4(){ setTimeout(function(){  window.location.href="software.php";  }, 30); }

</script>
</html>