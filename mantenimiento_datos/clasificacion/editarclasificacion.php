<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();
        $proof=$mbd->query("SELECT * from clasificacion WHERE id_clasificacion_cpu='$id'");
        foreach($proof as $row){
		  $row["id_clasificacion_cpu"];
		  $row["nombre_clasif"];
	  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CLASIFICACION</title>
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
            <section class="content-header">
                <h1>
                  CLASIFICACION
              
                </h1>
             
            </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Editar Clasificación</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formcla" role="form">
                    <div class="box-body">

                        <input type="hidden" id="id_clasificacion" name="id_clasificacion" value="<?php if (isset($row["id_clasificacion_cpu"])) echo $row["id_clasificacion_cpu"]; ?>">
                        <div class="form-group">
                            <label for="marca">Nombre de la Clasificacion</label>
                            <input type="text" class="form-control input-md" id="nombre_clasificacion" name="nombre_clasificacion" value="<?php if (isset($row["nombre_clasif"])) echo $row["nombre_clasif"]; ?>" placeholder="AUDIO etc">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="actualizar" name="actualizar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Clasificaciones</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
        </div>
    </div>

    <script>

        $("#actualizar").click(function(){    
                const formcla=document.getElementById("formcla")
                var id_clasificacion = $("#id_clasificacion").val();
                var nombre_clasificacion = $("#nombre_clasificacion").val();

                $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                    {
                        tarea:"editar",
                        id_clasificacion,id_clasificacion,
                        nombre_clasificacion:nombre_clasificacion
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="actualizado"){
                                toastr.success("Guardado")
                            
                            }
                            else if (item=="vacio"){
                                toastr.warning("Campo por rellenar!")

                            } else if (item=="existe"){
                                toastr.warning("Clasificación ya existente!")
                                formcla.reset()
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
            setTimeout(function(){  window.location.href="ver_clasificacion.php";  }, 30);
        }

    </script>
</body>
</html>
