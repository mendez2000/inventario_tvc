<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query("SELECT * from tipo_estado WHERE id_estado='$id'");
        foreach($proof as $row){
		  $row["id_estado"];
		  $row["nombre_estado"];
	  }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ESTADOS</title>
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
                   ESTADOS
               
                </h1>
            
            </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Editar Estado</h2>
                </div>
                <form id="formest" role="form">
                    <div class="box-body">
                        <input type="hidden" id="id_estado" name="id_estado" value="<?php if (isset($row["id_estado"])) echo $row["id_estado"]; ?>">
                        <div class="form-group">
                            <label for="marca">Nombre del Estado</label>
                            <input type="text" class="form-control input-md" id="nombre_estado" name="nombre_estado" value="<?php if (isset($row["nombre_estado"])) echo $row["nombre_estado"]; ?>" placeholder="OPERANDO etc">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="actualizar" name="actualizar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Estados</a>
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
            const formest=document.getElementById("formest")
            var id_estado = $("#id_estado").val();
            var nombre_est = $("#nombre_estado").val();

            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"editar",
                    id_estado:id_estado,
                    nombre_est:nombre_est
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="actualizado"){
                            toastr.success("Estado actualizado!")
                            document.getElementById("nombre_estado").value = "";
                        }
                        else if (item=="vacio"){
                            toastr.warning("Campo por rellenar!")

                        } else if (item=="existe"){
                            toastr.warning("Estado ya existente!")
                            //formest.reset()
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
                setTimeout(function(){  window.location.href="ver_estados.php";  }, 30);
            }

    </script>
</body>
</html>
