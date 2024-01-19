<?php
 include('../config/conexion2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monitor</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
</head>

<body class="login-page">
<div id="cuerpo" class="col-md-12" >
    <section class="content-header">
        <h1>MANTENIMIENTO</h1>
   
    </section>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Agregar Nuevo</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group ">
                                <label for="tipo_equipo">Tipo Equipo</label>
                                <select class="help-block" id="tipo_equipo" name="tipo_equipo"  style="width: 100%">
                                <option hidden disabled selected value> --seleccione una opcion-- </option>
                                    <option value="CPU">CPU</option>
                                    <option value="Monitor">Monitor</option>
                                    <option value="Ups">Ups</option>
                                    <option value="Accesorios">Accesorios</option>
                                </select>
                            </div>
                        </div>

                   

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="id_equipo">Inventario</label>
                            <select  id="id_equipo" name="id_equipo" style="width: 100%"></select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="fecha">Fecha </label>
                            <input type="text" class="form-control input-sm help-block" id="fecha" name="fecha" placeholder="Fecha">
                        </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="precio">Costo</label>
                                <input type="text" class="form-control input-sm help-block" id="precio" name="precio" placeholder="Costo LPS.">
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="ubicacion">Departamento</label>
                            <select  id="ubicacion" name="ubicacion" style="width: 100%" placeholder="Departamento">
                            <?php ComboBoxedificio("SELECT * FROM departamento","id_departamento","departamento")?>
                            </select>
                        </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="estado">Estado</label>
                            <select  id="estado" style="width: 100%"><option hidden disabled selected value> --seleccione una opción-- </option>
                                <option value="Entregado">Cambio/Repuesto</option>
                                <option value="Reparacion">Reparacion</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="obs">Observación</label>
                                <textarea class="form-control input-group-sm" id="obs" name="obs" placeholder="Descripción del trabajo..."></textarea>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="tipo_mantenimiento">Tipo De Mantenimiento</label>
                                <select class="help-block" id="tipo_mantenimiento"   style="width: 100%"><option hidden disabled selected value> --seleccione una opción-- </option>
                                    <option value="Preventivo">Preventivo</option>
                                    <option value="Correctivo">Correctivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar </button>
                                <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg"  style="margin: 3px"><span class="fa fa-search"></span>
                                Buscar Mantenimientos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script src="../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
                $(document).ready(function () {
                    $("#inventario").inputmask("99-999-9999");
                    $("select").select2();
                    $('#fecha').datepicker({
                        clearBtn: true,
                        language: "es"
                    });

                });
                $("#tipo_equipo").on("change", function () {
                    var valor=this.value;
                    var getData="consultas.php?combo="+valor;
                    $("#id_equipo").load(getData);
                });

                $("#guardar").click(function()
                {
                    var id_equipo= $("#id_equipo").val();
                    var tipo_equipo = $("#tipo_equipo").val();
                    var obs= $("#obs").val();
                    var fecha= $("#fecha").val();
                    var precio= $("#precio").val();
                    var ubicacion= $("#ubicacion").val();
                    var estado= $("#estado").val();
                    var tipo_mantenimiento= $("#tipo_mantenimiento").val();

                    if(tipo_equipo.trim()=='0')
                    {
                        toastr.error("ERROR","Tipo de Equipo no es valido");
                        return;
                    }

                    $.ajax({
                        type:"POST",
                        url:"consultas.php",
                        data:
                            {
                                tarea:"guardar",
                                id_equipo:id_equipo,
                                tipo_equipo:tipo_equipo,
                                obs:obs,
                                fecha:fecha,
                                precio:precio,
                                ubicacion:ubicacion,
                                estado:estado,
                                tipo_mantenimiento:tipo_mantenimiento

                            },
                        success: function(data)
                        {
                            data=data.split("|");
                            $.each(data, function(i, item) {

                                if (item=="bien"){

                                    toastr.success('Exito','se ha Guardado correctamnete');
                                    limpiarcampos();
                                }
                                if (item=="mal"){
                                    toastr.error('Error','Ha ocurrido un error');

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
                    document.getElementById("fecha").value="";
                    document.getElementById("precio").value="";
                    document.getElementById("ubicacion").value="";
                    document.getElementById("obs").value="";
                }
                function goBack(){
                    setTimeout(function(){  window.location.href="ver_mantenimiento.php";  }, 30);
                }

            </script>

</body>
 <?php
 function ComboBoxedificio($consul,$id,$nombre)
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