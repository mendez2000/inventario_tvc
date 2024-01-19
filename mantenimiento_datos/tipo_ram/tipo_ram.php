<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tipos de RAM</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"> 
       <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>


<body class="login-page">
  <div id="cuerpo" class="col-md-8" > 
    <div class="col-md-8 col-md-offset-3" >
   
                  <h3>TIPO RAM</h3>
              
       
      <div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title">Agregar Nueva</h2>
        </div>
                <form id="form_tipo_ram" role="form">
                  <div class="box-body">
                  
                  
                   <div class="form-group">
                      <label for="ip">Tipo de Ram</label>
                      <input type="text" class="form-control input-lg" id="tipo" name="tipo" placeholder="DDR1">
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a href="../indexform.php">
                        <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span> Mantenimientos</button>
                    </a>
                    <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                    <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Tipo Ram</a>
                  </div>
                </form>  
          </div>
       </div>
   </div>
  

  <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
  <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="../../assets/js/toastr.js"></script>
  <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
  <script src="../../assets/js/bootstrap-daterangepicker-master/moment.min.js"></script>
  <script src="../../assets/js/custombox.min.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap-daterangepicker-master/daterangepicker.js"></script>
  <script type="text/javascript" src="../../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
  <script type="text/javascript" src="../../assets/plugins/datatables/tabla.min.js" ></script>
  <script type="text/javascript" src="../../assets/js/bootbox.js" ></script>
  <script type="text/javascript" src="../../assets/js/bootbox.min.js" ></script>
  <script>


    $("#guardar").click(function(){    
          const form_tipo_ram=document.getElementById("form_tipo_ram")
          var tipo = $("#tipo").val();
          $.ajax({
              type:"POST",
              url:"consultas.php",
              data:
              {
                  tarea:"guardar",
                  tipo:tipo
              },
              success: function(data)
              {
                  data=data.split("|");
                  $.each(data, function(i, item) {

                      if (item=="guardado"){
                        form_tipo_ram.reset()
                          toastr.success("Guardado")
                      
                      }
                      else if (item=="vacio"){
                          toastr.warning("Faltan campos por rellenar")

                      } else if (item=="existe"){
                          toastr.warning("Tipo de Ram ya existente!")
                          form_tipo_ram.reset()
                      }

                  });

              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
                  alert("No funciona ajax para guardar");
              }

          })
    });             

    function goBack(){ setTimeout(function(){  window.location.href="ver_tipo_ram.php";  }, 30); }

  </script>
                


</body>
</html>