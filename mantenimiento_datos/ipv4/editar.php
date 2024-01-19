<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
         $proof=$mbd->query("SELECT * from ipv4 WHERE id_ip='$id'");
      foreach($proof as $row){
		  $row["id_ip"];
		  $row["ip"];
	  }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ip</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">

<div class="">
    <div id="cuerpo" class="col-md-8" >
        <div class="col-md-8 col-md-offset-3" >
            <section class="content-header">
                <h1>
                DIRECCION IP
              
                </h1>
             
            </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                <h2 class="box-title">Editar Direccion IP</h2>
                 

                <form role="form">
                    <div class="box-body">

                        <input type="hidden" id="id" value="<?php if (isset($row["id_ip"])) echo $row["id_ip"];?>">
                        <div class="form-group">
                            <label for="ip">Direccion Ip</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $row["ip"];?>" id="ip" name="ip" placeholder="ip">
                        </div>


                    </div><!-- /.box-body -->

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver IP</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>

    <script>
    $(document).ready(function () {

    });

    $("#guardar").click(function()
    {
        var ip = $("#ip").val();
        var id = $("#id").val();
        //validar ip en un formato correcto
        var ipformat = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
        ipformat = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
            if(ip.match(ipformat))
            {
                //toastr.success("Ip correcta!");
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                    {
                       tarea:"editar",
                        ip:ip,
                        id:id
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="bien")
                            {
                                toastr.success('Éxito','Actualizado');
                                document.getElementById("ip").value="";
                            }
                            else if (item=="existe")
                            {
                                toastr.error('Error','Ip ya existente!');
                            }
                            else if (item=="vacio")
                            {
                                toastr.error('Campo vacío!');
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError)
                    {
                        alert(thrownError);
                        alert("No funciona ajax para guardar");
                    }
                })
            }
            else
            {
                toastr.error("Error","Has ingresado una IP inválida!");
                return;
            }
});
            
                       



                    function limpiarcampos(){
                        document.getElementById("ip").value="";


                    }
                    function goBack(){


                        setTimeout(function(){  window.location.href="ver_ip.php";  }, 30);

                    }


                </script>


            </div>
        </div>
    </div>


</body>
</html>