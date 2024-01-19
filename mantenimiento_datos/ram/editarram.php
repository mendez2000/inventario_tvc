<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query("SELECT id_ram,tipo_ram.id_tipo_ram, tipo_ram.tipo_ram, capacidad, frecuencia,observaciones from ram
    LEFT join tipo_ram on tipo_ram.id_tipo_ram=ram.id_tipo_ram where id_ram='$id'");
    foreach($proof as $row){
        $id=$row["id_ram"];
        $tipo_ram=$row["tipo_ram"];
        $id_tipo=$row["id_tipo_ram"];
        $capacidad=$row["capacidad"];
        $frecuencia=$row["frecuencia"];
        $observacion=$row["observaciones"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RAM</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">
    <div id="cuerpo" class="col-md-8" >

    
        <div class="col-md-8 col-md-offset-3" >
            <section class="content-header">
                <h1>
                   RAM
            
                </h1>
           
            </section>
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title">Editar Ram</h2>
                </div>
                <form id="formram" role="form">

                    <div class="box-body">
                    <input type="hidden" id="id_ram" name="id_ram" value="<?php echo $id; ?>">

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="tipoRam">Tipo de RAM</label>
                            <select class="help-block" id="sltiporam" name="sltiporam" required style="width: 100%" >
                                <?php
                                $mbd=DB::connect();DB::disconnect();
                                    $proof=$mbd->query("SELECT * FROM tipo_ram where id_tipo_ram<>'$id_tipo';");
                                    while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                                        echo '<option value="'.$row['id_tipo_ram'].'"  > '.$row['tipo_ram'].'</option>' ;
                                    }
                                    echo '<option value="'.$id_tipo.'" selected="" >  '.$tipo_ram.'</option>' ;
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="capacidadRam">Capacidad</label>
                            <input type="text" id="capacidad" name="capacidad" autocomplete="on"  value="<?php echo $capacidad ?>"  class="input-sm form-control" placeholder="Total de Almacenamiento"><br>
                        </div>

                    
                        <div class="form-group col-md-6 col-sm-6 col-xs-10">
                        <label for="numModulos">Frecuencia</label>
                        <input type="text" id="frecuencia" name="frecuencia" value="<?php echo $frecuencia ?>" autocomplete="on"  class="input-sm form-control" placeholder="Ejem 400MHz"><br>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="Observaciones">Observaciones: </label>
                            <textarea class="form-control  input-sm" id="observaciones" name="observaciones" placeholder="Descripción..."><?php echo $observacion; ?></textarea>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="actualizar" name="actualizar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Ram</a>
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
                <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
                <script src="../../assets/dist/js/app.min.js" type="text/javascript"></script>
                <script src="../../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

    <script>

        $(document).ready(function () {
            $("select").select2();
        });


        $("#actualizar").click(function(){    
            const formram=document.getElementById("formram")
            var id_ram = $("#id_ram").val();
            var sltiporam = $("#sltiporam").val();
            var capacidad = $("#capacidad").val();
            var frecuencia = $("#frecuencia").val();
            var observaciones = $("#observaciones").val();
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"editar",
                    id_ram:id_ram,
                    sltiporam:sltiporam,
                    capacidad:capacidad,
                    frecuencia:frecuencia,
                    observaciones:observaciones
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="actualizado"){
                            formram.reset()
                            toastr.success("Ram actualizado")
                        
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
</html>
