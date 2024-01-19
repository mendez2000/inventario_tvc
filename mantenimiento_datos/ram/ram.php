<?php

 include('../../config/conexion2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RAM</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">

</head>

<body class="login-page">

<div id="cuerpo" class="col-md-8" >
    <div class="col-md-8 col-md-offset-3" >
  
        <h3>RAM</h3>
   
  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Agregar Nueva</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form id="formram" role="form">
                <div class="box-body">

                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="sltiporam">Tipo de Ram</label>
                            
                            <select class=" help-block" id="sltiporam" name="sltiporam" required style="width: 100%" ><option hidden disabled selected value></option>
                                <?php cargaComboBox("SELECT * FROM tipo_ram","id_tipo_ram","tipo_ram") ?>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="capacidad">Capacidad</label>
                                <input type="text" id="capacidad" name="capacidad" autocomplete="on"  class="input-sm form-control" placeholder="Total de almacenamiento"><br>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="frecuencia">Frecuencia</label>
                                <input type="text" id="frecuencia" name="frecuencia" autocomplete="on"  class="input-sm form-control" placeholder="Ejem 400MHz"><br>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="Observaciones">Observaciones: </label>
                                <textarea class="form-control  input-sm" id="observaciones" name="observaciones" placeholder="Descripción..."></textarea>
                            </div>
                        </div>
                    
                </div><!-- /.box-body -->

                <div class="modal-footer">
                    <a href="../indexform.php">
                        <button type="button" id="cerrarest" name="cerrarest"  class="btn btn-danger btn-flat"> <span class="fa fa-database"></span> Mantenimientos</button>
                        </a>
                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                        <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Ram</a>
                </div>
            </form>

            </div>
    </div>
</div>

    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script> 
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>

        $(document).ready(function () {
        
            $("select").select2();
        

        });
        //ENVIAR A GUARDAR RAM
                $("#guardar").click(function(){    
                        const formram=document.getElementById("formram")
                        var sltiporam = $("#sltiporam").val();
                        var capacidad = $("#capacidad").val();
                        var frecuencia = $("#frecuencia").val();
                        var observaciones = $("#observaciones").val();
                        $.ajax({
                            type:"POST",
                            url:"consultas.php",
                            data:
                            {
                                tarea:"guardar",
                                sltiporam:sltiporam,
                                capacidad:capacidad,
                                frecuencia:frecuencia,
                                observaciones:observaciones
                            },
                            success: function(data)
                            {
                                data=data.split("|");
                                $.each(data, function(i, item) {

                                    if (item=="guardado"){
                                        formram.reset()
                                        toastr.success("Guardado")
                                    
                                    }
                                    else if (item=="vacio"){
                                        toastr.warning("Campo por rellenar!")

                                    } else if (item=="existe"){
                                        toastr.warning("Ram ya existente!")
                                        formram.reset()
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
                setTimeout(function(){  window.location.href="ver_ram.php";  }, 30);
                }
                                
    </script>
</body>

<?php
function cargaComboBox($consul,$id,$nombre)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo $row[$nombre];
        echo "</option>";

    }
}
?>

</html>