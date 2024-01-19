<script type="text/javascript" src="../js/bootstrap-daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-daterangepicker-master/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../js/bootstrap-daterangepicker-master/daterangepicker.css" />

   $(document).ready(function() {
     $('#usuarios_tabla').DataTable(); 
       $('input[name="rango"]').daterangepicker({
            timePicker: true,
            locale: {
            format: 'DD/MM/YYYY hh:mm A'
            }
       });
   }); 