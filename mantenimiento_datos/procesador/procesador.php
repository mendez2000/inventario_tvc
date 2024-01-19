<?php include('../../config/conexion2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Procesador</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
    

</head>
<body class="login-page">
   <div id="cuerpo" class="col-md-8" >
           <div class="col-md-8 col-md-offset-3" >
          
                <h3>PROCESADOR</h3>
           
     

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Agregar Nuevo</h2>
             
                

                    <form id="formpro">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="fabricante">Fabricante</label>
                                    <!-- <input type="text" name="fabricante"   id="fabricante" autocomplete="on"  class="input-sm form-control" required placeholder="Intel,Amd etc"><br> -->
                                    <select class="help-block" id="fabricante" name="fabricante" required style="width: 100%">
                                            <?php ComboBoxMarca("SELECT * FROM marca","id_marca","nombre_marca"); ?><option disabled selected value></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label for="modelo">Modelo</label>
                        <input type="text"  name="modelo" id="modelo" autocomplete="on"  class="input-sm form-control" required placeholder="Core i3,Ryzen etc"><br>

                        <label for="generacion">Generación</label>
                        <input type="text" name="generacion" id="generacion" autocomplete="on"  class="input-sm form-control"  placeholder="5600, 6800 etc"><br>

                        <label for="Velocidad">Velocidad</label>
                        <input type="text" name="velocidad" id="velocidad" autocomplete="on"  class="input-sm form-control"  placeholder="3.10 Gz etc"><br>
                        </div>

                        <div class="modal-footer">

                        <a href="../indexform.php">
                        <button type="button" id="cerrarest" name="cerrarest"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span> Mantenimientos</button>
                        </a>
                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                        <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar</a>
                        </div>
        
                    </form>
                </div>
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

 
// //ENVIAR A GUARDAR PROCESADOR
$(document).ready(function () {
            $("select").select2();
        });
            $("#guardar").click(function(){    
                const formpro=document.getElementById("formpro")
                var fabricante = $("#fabricante").val();
                var modelo = $("#modelo").val();
                var generacion = $("#generacion").val();
                var velocidad = $("#velocidad").val();
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                    {
                        tarea:"guardar",
                        fabricante:fabricante,
                        modelo:modelo,
                        generacion:generacion,
                        velocidad:velocidad
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="guardado"){
                                formpro.reset()
                                toastr.success("Guardado")
                            
                            }
                            else if (item=="vacio"){
                                toastr.warning("Campo por rellenar!")

                            } else if (item=="existe"){
                                toastr.warning("Procesador ya existente!")
                                formpro.reset()
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
    

	function goBack(){
      setTimeout(function(){  window.location.href="ver_procesadores.php";  }, 30);
    }
                    
    </script>
  

</body>
<?php
function ComboBoxMarca($consul,$id,$nombre)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$nombre"]."'>";
        echo $row["$nombre"];
        echo "</option>";
    }
}
?>
</html>