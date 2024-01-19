<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query("SELECT * from procesador WHERE id_procesador='$id'");
        foreach($proof as $row){
		  $row["id_procesador"];
		  $row["fabricante"];
          $row["modelo"];
          $row["generacion"];
          $row["velocidad"];
          $fabricante=$row["fabricante"];
	  }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PROCESADORES</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
    
<body class="login-page">
    <div id="cuerpo" class="col-md-8" >
        <div class="col-md-8 col-md-offset-3" >

            <section class="content-header">
                <h1>
                    PROCESADOR
               
                </h1>
            
            </section>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title">Editar Procesador</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formpro" role="form">

                    <div class="box-body">
                    <input type="hidden" id="id_pro" name="id_pro" value="<?php if (isset($row["id_procesador"])) echo $row["id_procesador"]; ?>">

                    <label for="fabricante">Fabricante</label>
                    <select class="help-block" id="fabricante" name="fabricante" required style="width: 100%" >
                                    <?php
                                    $mbd=DB::connect();DB::disconnect();
                                    $proof1=$mbd->query("SELECT * FROM marca");

                                    while($row1 = $row1 = $proof1->fetch(PDO::FETCH_ASSOC)){
                                        if($row1["nombre_marca"] == $row["fabricante"])
                                        {
                                            echo "<option selected value=".$row["fabricante"].">".$row["fabricante"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row1["nombre_marca"].">".$row1["nombre_marca"]."</option>";
                                        }
                                    }
                                    ?>

                                    
                    </select>

                    <label for="modelo">Modelo</label>
                    <input type="text"  name="modelo" id="modelo" autocomplete="on"  class="input-sm form-control" value="<?php if (isset($row["modelo"])) echo $row["modelo"]; ?>" required placeholder="Core i3,Ryzen etc"><br>

                    <label for="generacion">Generación</label>
                    <input type="text" name="generacion" id="generacion" autocomplete="on"  class="input-sm form-control" value="<?php if (isset($row["generacion"])) echo $row["generacion"]; ?>" required placeholder="5600, 6800 etc"><br>

                    <label for="Velocidad">Velocidad</label>
                    <input type="text" name="velocidad" id="velocidad" autocomplete="on"  class="input-sm form-control" value="<?php if (isset($row["velocidad"])) echo $row["velocidad"]; ?>" required placeholder="3.10 Gz etc"><br>

                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="actualizar" name="actualizar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat"> <span class="fa fa-list"></span>
                                            Ver Procesadores</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
        </div>
    </div>


    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
    <script type="text/javascript" src="../../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("select").select2();
        });

        $("#actualizar").click(function(){    
            const formpro=document.getElementById("formpro")
            var id_pro = $("#id_pro").val();
            var fabricante = $("#fabricante").val();
            var modelo = $("#modelo").val();
            var generacion = $("#generacion").val();
            var velocidad = $("#velocidad").val();
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"editar",
                    id_pro:id_pro,
                    fabricante:fabricante,
                    modelo:modelo,
                    generacion:generacion,
                    velocidad:velocidad
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="actualizado"){
                            formpro.reset()
                            toastr.success("Actualizado")
                        
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
</html>
