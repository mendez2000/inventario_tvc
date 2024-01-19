<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
    //$sql = "SELECT * FROM tipo_accesorio WHERE id_taccesorio='$id'";
         $proof=$mbd->query("SELECT * from tipo_accesorio WHERE id_taccesorio='$id'");
            foreach($proof as $row){
                $row["id_taccesorio"];
                $row["tipo_accesorio"];

            }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tipo Accesorio</title>
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
                    ACCESORIO
            
                </h1>
           
            </section>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Editar Tipo Accesorio</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">

                        <input type="hidden" id="id" name="id"  value="<?php if (isset($row["id_taccesorio"])) echo $row["id_taccesorio"];?>" >
                        <div class="form-group">
                            <label for="marca">Tipo de Accesorio</label>
                            <input type="text" class="form-control input-md col-md-6 col-sm-7 col-xs-8" id="tipo_accesorio"  value="<?php if (isset($row["tipo_accesorio"])) echo $row["tipo_accesorio"];?>" placeholder="cable,conector etc">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Tipo de Accesorios</a>
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
            var id_taccesorio= $("#id").val();
            var tipo_accesorio= $("#tipo_accesorio").val();

            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"editar",
                    id_taccesorio:id_taccesorio,
                    tipo_accesorio:tipo_accesorio

                    
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="actualizado"){
                        toastr.success('Éxito','Actualizado correctamente');
                        document.getElementById("tipo_accesorio").value="";
                        }
                        else if (item=="existe")
                        {
                        toastr.error('Error','Tipo existente!');
                        }
                        else if (item=="vacio")
                        {
                        toastr.warning('Campos vacíos!');
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
                    
        function goBack(){ setTimeout(function () { window.location.href = "ver_taccesorio.php";  }, 30);}

    </script>


</body>
</html>