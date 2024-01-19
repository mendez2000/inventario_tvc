<?php
include('../config/conexion2.php');
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
     <link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../assets/css/toastr.css" >
     

    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>  
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
    <h4>TABLA GENERAL CPU
        
        <a href="cpu.php" class="btn btn-flat btn-success btn-md">
            <span class="glyphicon glyphicon-plus"></span> Nuevo
        </a>
	    <a  class="btn btn-flat btn-primary btn-md" id="unsave">
            <span class="glyphicon glyphicon-refresh"></span>
        </a>

    </h4>

    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12 table-responsive"> 

            <table id="ver" class="display table" cellspacing="0" width="100%" >
                <thead>
                <tr>
                    <th data-field="Inventario">Inventario</th>
                    <th data-field="modelo">Marca</th>
                    <th data-field="Modelo">Modelo</th>
                    <th data-field="ServiceTag">Service Tag</th>
                    <th data-field="Nombre CPU">Nombre CPU</th>
                    <th data-field="Clasificación">Clasificación</th>
                    <th data-field="Procesador">Procesador</th>
                    <th data-field="Departamento">Departamento</th>
                    <th data-field="Estado">Estado</th>
                    <th data-field="Acciones">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../config/conexion2.php';
                    $mbd=DB::connect();DB::disconnect();
                    $proof=$mbd->query("Call consulta_general;");
                    while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                        $inv=$row["num_inventario"];
                        echo "     
                            <tr>                        
                                <td>".$inv."</td>
                                <td>".$row["nombre_marca"]."</td>
                                <td>".$row["modelo"]."</td>
                                <td>".$row["serv_tag"]."</td>
                                <td>".$row["nombre_cpu"]."</td>
                                <td>".$row["nombre_clasif"]."</td>
                                <td>".$row["procesador"]."</td>
                                <td>".$row["departamento"]."</td>
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
    </div>

    <div class="btn-group pull-right"> 
        <a onclick=goBack() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Hardware</a>
        <a onclick=goBack2() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Ubicación fisica</a> 
        <a onclick=goBack3() class="btn btn-warning btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list-alt"></span> Software</a> 
    </div>

   

</div>
</body>
<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.js" ></script>
<script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>
<script type="text/javascript" src="../assets/js/toastr.js" ></script>



<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>



<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/jszip.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/pdfmake.min.js" ></script>
<script type="text/javascript" src="../assets/plugins/datatables/vfs_fonts.js" ></script>
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
                    $(cell).html('<input type="text" size="8" placeholder="' + title + '" />');
 
                 
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

        $.ajax(//funcion ajax le mando la tarea al switch y creo new variables que tienen el valor del form
            {
                type: "POST",
                url: "consultas_cpu.php",
                data: {
                    tarea: 'eliminar',
                    num_inventario: num_inventario
               },
                success: function (data){
                    data=data.split("|");
                        $.each(data, function(i, item) {
                            console.log(item);   
                        if (item=="exito"){
                            toastr.success('Éxito','Actualizado correctamente');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }
                        else if (item=="error")
                        {
                            toastr.warning('Error','test!');
                        }
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
                
            
            });
    }


    function goBack(){ setTimeout(function(){  window.location.href="hardware.php";  }, 30); }
    function goBack2(){ setTimeout(function(){  window.location.href="ubicacion.php";  }, 30); }
    function goBack3(){ setTimeout(function(){  window.location.href="software.php";  }, 30); }
</script>
</html>