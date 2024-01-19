<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IP</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css" >
    <link rel="stylesheet" href="../../assets/plugins/datatables/jquery.dataTables.min.css" >
    <script src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>


</head>
<style type="text/css">
    td.details-control {
        background: url('../../images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.details td.details-control {
        background: url('../../images/details_close.png') no-repeat center center;
    }
</style>
<body>
<h3>Todas estas IP están ocupadas <a onclick="goBack()" class="btn bg-gray-active">Regresar</a></h3>
<table  id="example" class="display table" cellspacing="0" width="90%">
    <thead>
    <tr>
        <th></th>
        <th>IP</th>
        <th>Inventario</th>
        <th>CPU</th>
    </tr>
    </thead>

</table>

</body>
<script src="../../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="../../assets/plugins/datatables/tabla.min.js" ></script>
<script type="application/javascript">
    function format ( d ) {
        return 'Nombre cpu: '+d.nombre_cpu+' <br>'+
            'Inventario: '+d.id_numinventario+'<br>'+
            'Estado: '+d.estado+'<br>'+
            'Para ver + informacion vaya a CPU.';
    }

    $(document).ready(function() {
       var dt = $('#example').DataTable( {

            "ajax": "reporte.php?ver=ocupadas",
            "columns": [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { "data": "ip" },
                { "data": "id_numinventario" },
                { "data": "nombre_cpu" }


            ],
            "order": [[1, 'asc']]
        } );

        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#example tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                row.child( format( row.data() ) ).show();

                // Add to the 'open' array
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on( 'draw', function () {
            $.each( detailRows, function ( i, id ) {
                $('#'+id+' td.details-control').trigger( 'click' );
            } );
        } );
    } );
function goBack() {
    window.history.back();
}
</script>
</html>