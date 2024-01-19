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
    <h4>HARDWARE DEL EQUIPO
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
                <th data-field="Inventario">Inventario</th>
                <th data-field="Nombre">Nombre CPU</th>
                <th data-field="Ubicacion">Clasificación</th>
                <th data-field="Estado">Procesador:</th>
                <th data-field="Estado">Ram: </th>
                <th data-field="Estado">Tarjeta de Video</th>
                <th data-field="Estado">Ups Asignada: </th>
                <th data-field="Estado">Disco (S)</th>
                <th data-field="Estado">Accesorio (S)</th>
                <th data-field="Estado">IP(S)</th>
                <th data-field="Estado">Monitor(S)</th>
                <th data-field="Acciones">Acciones</th>
                
            </tr>
            </thead>
            <tbody>
            <?php
            include_once '../config/conexion2.php';
            $mbd=DB::connect();DB::disconnect();

            $proof=$mbd->query("SELECT id_cpu,cpu.num_inventario,nombre_cpu,clasificacion.nombre_clasif,
            CONCAT_WS(' ','Fabricante:',procesador.fabricante,',modelo:',procesador.modelo,',generación ',procesador.generacion,',velocidad: ',procesador.velocidad) as procesador,
            (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','Tipo: ',tipo_ram.tipo_ram,',Capacidad:',ram.capacidad,',Frecuencia',ram.frecuencia,',nota:',ram.observaciones), ' ') as ram from ram LEFT join tipo_ram ON tipo_ram.id_tipo_ram=ram.id_tipo_ram where cpu.id_ram=ram.id_ram) as ram,
            (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','Marca: ',marca.nombre_marca,',Modelo:',t_video.modelo,',Capacidad',t_video.capacidad), ' ') from t_video LEFT join marca ON marca.id_marca=t_video.id_marca where cpu.id_tarjeta_v=t_video.id_tarjeta_v) as tarjeta_video,
            CONCAT_WS(' ','Inv:',ups.num_inventario,',modelo: ',ups.modelo,',capacidad:',ups.capacidad) as ups,
            (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*Tipo: ',disco.tipo_disco,',Puerto:',disco.tipo_puerto,',Capacidad ',disco.capacidad), ' ') as discos from disco LEFT join detalle_cpu_disco ON detalle_cpu_disco.num_inv_cpu=cpu.num_inventario where detalle_cpu_disco.id_disco=disco.id_disco) as discos,
            (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*INV: ',accesorio.num_inv_acc,' ,Tipo:',tipo_accesorio.tipo_accesorio), ' ') from accesorio LEFT join detalle_cpu_accesorio ON cpu.num_inventario=detalle_cpu_accesorio.num_inv_cpu LEFT JOIN tipo_accesorio ON accesorio.id_taccesorio=tipo_accesorio.id_taccesorio where detalle_cpu_accesorio.num_inv_accesorio=accesorio.num_inv_acc) as accesorios,
            (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*IPV4',ipv4.ip), ' ') from ipv4 LEFT join detalle_cpu_ip ON detalle_cpu_ip.num_inv_cpu=cpu.num_inventario where detalle_cpu_ip.id_ip=ipv4.id_ip) as ipv4,
            (SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ','*INV: ',monitor.num_inventario,',tipo: ',monitor.tipo_monitor,',marca: ',marca.nombre_marca), ' ') from monitor LEFT join detalle_cpu_monitor ON cpu.num_inventario=detalle_cpu_monitor.num_inv_cpu LEFT JOIN marca ON monitor.id_marca=marca.id_marca where detalle_cpu_monitor.id_monitor=monitor.id_monitor) as monitores 
            FROM cpu 
            LEFT JOIN clasificacion ON cpu.id_clasificacion=clasificacion.id_clasificacion_cpu
            LEFT JOIN procesador ON cpu.id_procesador=procesador.id_procesador
            LEFT JOIN ram ON cpu.id_ram=ram.id_ram
            LEFT JOIN t_video ON cpu.id_tarjeta_v=t_video.id_tarjeta_v
            LEFT JOIN ups ON cpu.id_ups=ups.id_ups;");

            while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                $inv=$row["num_inventario"];
                echo "     
                    <tr>                        
                        <td>".$inv."</td>
                        <td>".$row["nombre_cpu"]."</td>
                        <td>".$row["nombre_clasif"]."</td>     
                        <td>".$row["procesador"]."</td>
                        <td>".$row["ram"]."</td>
                        <td>".$row["tarjeta_video"]."</td>
                        <td>".$row["ups"]."</td>
                        <td>".$row["discos"]."</td>
                        <td>".$row["accesorios"]."</td>
                        <td>".$row["ipv4"]."</td>
                        <td>".$row["monitores"]."</td>
                        <td><a href=\"editar_n.php?id=".$row["id_cpu"]."\" class=\"btn btn-flat btn-warning btn-sm\"><span class=\"glyphicon glyphicon-pencil\"></span></a>
                        <a href=\"imprimir_cpu.php?id=".$row["id_cpu"]."\" class=\"btn btn-flat btn-info btn-sm\"><span class=\"glyphicon glyphicon-folder-open\"></span></a>
                        <a name=\"eliminar\" value=\"".$row["num_inventario"]."\" class=\"btn btn-flat btn_5 btn-sm btn-danger\"><span class=\"glyphicon glyphicon-trash\"></span></a>
                        </td>
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
            "iDisplayLength" : 10,   

            
            
    });


});
 
$(document).ready(function () {
        var table = $('#ver').DataTable();

        $("a[name='eliminar']").click(function(){  
            var num_inventario=$(this).attr('value');
            bootbox.confirm("Seguro que lo quiere eliminar?", function(result) {
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


    function goBack2(){ setTimeout(function(){  window.location.href="ubicacion.php";  }, 30); }
    function goBack3(){ setTimeout(function(){  window.location.href="ver-ot.php";  }, 30); }
    function goBack4(){ setTimeout(function(){  window.location.href="software.php";  }, 30); }

</script>
</html>