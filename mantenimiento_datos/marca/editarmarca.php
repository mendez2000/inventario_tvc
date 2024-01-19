
<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query("SELECT * from marca WHERE id_marca='$id'");
        foreach($proof as $row){
		  $row["id_marca"];
		  $row["nombre_marca"];
	  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Marca</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">
    <div id="cuerpo" class="col-md-8" >
        <div class="col-md-8 col-md-offset-3">
            <section class="content-header">
                <h1>
                    MARCA
                
                </h1>
          
            </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Editar Marca</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formmarca" role="form">
                    <div class="box-body">

                        <input type="hidden" id="id_marca" name="id_marca" value="<?php if (isset($row["id_marca"])) echo $row["id_marca"]; ?>">
                        <div class="form-group">
                            <label for="marca">Nombre de la Marca</label>
                            <input type="text" class="form-control input-md" id="nombre_marca" name="nombre_marca" value="<?php if (isset($row["nombre_marca"])) echo $row["nombre_marca"]; ?>" placeholder="DELL, ASUS etc">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Marcas</a>
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


        $("#guardar").click(function(){
                const formmarca=document.getElementById("formmarca")
                var id_marca= $("#id_marca").val();
                var nombre_marca= $("#nombre_marca").val();
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                    {
                        tarea:"editar",
                        id_marca:id_marca,
                        nombre_marca:nombre_marca
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="actualizado"){
                                document.getElementById("nombre_marca").value="";
                                toastr.success("Guardado!")
                            }
                            else if (item=="existe")
                            {
                                toastr.warning("Marca ya existente!")

                            }
                            else if (item=="vacio")
                            {
                                toastr.warning("Campos por rellenar!")
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
            setTimeout(function(){  window.location.href="ver_marcas.php";  }, 30);
        }

    </script>

</body>
</html>
