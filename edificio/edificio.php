<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edificio</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/plugins/select2/select2.css" rel="stylesheet">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body class="login-page">
<div id="cuerpo" class="col-md-12" >
<section class="content-header">
           <h1>

            DIFICIO

        </h1>

           </section>

                 <div class="col-md-12" >
                  <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Agregar Nuevo</h2>
                </div>
                <form role="form">
                    <div class="box-body">


                        <div class="form-group">
                            <label for="edificio">Nombre Edificio</label>
                            <input type="text" class="form-control " id="edificio" name="edificio" placeholder="Edificio">
                        </div>

                    </div><!-- /.box-body -->

               <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                <div class="form-group">
                <div class="btn-group pull-right">

         
                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                        <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg"  style="margin: 3px"><span class="fa fa-search"></span>
                            Buscar Edificio</a>
                    </div>
                </form>

            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/plugins/select2/select2.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/js/toastr.js"></script>
<script>

    $("#guardar").click(function()
    {
        var edificio= $("#edificio").val();

        $.ajax({
            type:"POST",
            url:"consultas.php",
            data:
                {
                    tarea:"guardar",
                    edificio:edificio
                },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {

                    if (item=="bien"){

                        toastr.success('Exito','se ha Guardado correctamnete');
                        limpiarcampos();
                    }
                    else if (item=="vacio"){
                        toastr.error('Error','Campo vacío');

                    }else if (item=="existe"){
                        toastr.error('Error','Ya existe este edificio!');

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
        document.getElementById("edificio").value="";

    }
    function goBack(){


        setTimeout(function(){  window.location.href="ver_edificio.php";  }, 30);

    }

</script>
</html>