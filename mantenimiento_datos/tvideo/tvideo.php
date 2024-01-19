<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T Video</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
     <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
       <script type="text/javascript" src="../../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">
   <div id="cuerpo" class="col-md-8" >
        <div class="col-md-8 col-md-offset-3" >
       
                <h3>TARJETA DE VIDEO</h3>
           
     
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Agregar Nueva</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formvideo">
                 <div class="box-body">
                  
                  <div class="form-group">
                      <label for="marca">Marca</label>
                       <select class="js-example-basic-multiple input-sm form-control  help-block" id="slmarcavideo" name="slmarcavideo" required style="width: 100%" ><option hidden disabled selected value> --seleccione una opcion-- </option>
                       <?php cargaComboBox("SELECT * FROM marca","id_marca","nombre_marca") ?>
                       </select>

                      <label for="modelo"> Modelo</label>
                      <input type="text" class="form-control input-sm" id="modelo" name="modelo" placeholder="Modelo">

                      <label for="memoria"> Capacidad</label>
                      <input type="text" class="form-control input-sm" id="capacidad" name="capacidad" placeholder="Capacidad">
                  </div>
                    
                  </div>

                  <div class="modal-footer">

                  <a href="../indexform.php"><button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span>  Mantenimientos</button></a>
                  <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                  <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar</a>

                  </div>
                </form>            
            </div>
       </div>
   </div>

    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
    <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script> 
 
        $(document).ready(function () {
            $("select").select2();
        });

        $("#guardar").click(function(){    
          const formvideo=document.getElementById("formvideo")
          var slmarcavideo = $("#slmarcavideo").val();
          var modelo = $("#modelo").val();
          var capacidad = $("#capacidad").val();
          $.ajax({
              type:"POST",
              url:"consultas.php",
              data:
              {
                  tarea:"guardar",
                  slmarcavideo:slmarcavideo,
                  modelo:modelo,
                  capacidad:capacidad
              },
              success: function(data)
              {
                  data=data.split("|");
                  $.each(data, function(i, item) {

                    if (item=="guardado"){
                    formvideo.reset()
                    toastr.success("Guardado")
                    
                    }
                    else if (item=="vacio"){
                    toastr.warning("Faltan campos por rellenar")

                    } else if (item=="existe"){
                    toastr.warning("Tarjeta video ya existente!")
                    formvideo.reset()
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
                            
        function limpiarcampos(){
            document.getElementById("memoria").value="";
            document.getElementById("modelo").value="";
            
        }
                    
        function goBack(){
            setTimeout(function(){  window.location.href="ver_tvideo.php";  }, 30);
        }           
    </script>
</body>
<?php
function cargaComboBox($consul,$id,$nombre)
{
    include('../../config/conexion2.php');

    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$id"]."'>";
        echo $row["$nombre"];
        echo "</option>";
    }

}
?>
</html>