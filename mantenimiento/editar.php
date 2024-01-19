<?php

include('../config/conexion2.php');
$mbd=DB::connect();DB::disconnect();
$id = $_GET['id'];
$stmt = $mbd->prepare("SELECT * FROM mantenimiento WHERE id_mantenimiento=:id");

$stmt->execute(array(':id'=>$id));

$proof=$mbd->query("SELECT * from mantenimiento WHERE id_mantenimiento='$id'");
      foreach($proof as $row){
		  $row["id_mantenimiento"];
		  $row["num_inventario"];
		  $row["tipo_equipo"];
		  $row["fecha"];
		  $row["precio"];
          $row["id_departamento"];
		  $row["estado"];
		  $row["observaciones"];
		  $row["tipo_mantenimiento"];
	  }

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
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
        <h1>
            MANTENIMIENTO
            <small>Añadir Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a >Mantenimiento</a></li>
            <li class="active">Añadir Mantenimiento</li>
        </ol>
    </section>
        
    <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Añadir Mantenimiento</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                <input type="hidden" id="id" NAME="id" value="<?php if (isset($id)) echo $id;?>">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="tipo_equipo">Tipo Equipo</label>
                            <input type="text" id="tipo_equipo" name="tipo_equipo" disabled class="form-control input-sm help-block" value="<?php if (isset($userRow["tipo_equipo"])) echo $userRow["tipo_equipo"];?>">
                        </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="id_equipo">Inventario</label>
                            <input type="text" disabled id="id_equipo" name="id_equipo" class="form-control input-sm help-block" value="<?php if (isset($userRow["num_inventario"])) echo $userRow["num_inventario"];?>">
                        </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="fecha">Fecha </label>
                            <input type="text" class="form-control input-sm help-block" value="<?php if (isset($userRow["fecha"])) echo $userRow["fecha"];?>" id="fecha" name="fecha" placeholder="Fecha">
                        </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="precio">Costo</label>
                                <input type="text" class="form-control input-sm help-block" value="<?php if (isset($userRow["precio"])) echo $userRow["precio"];?>" id="precio" name="precio" placeholder="Costo del mantenimiento">
                            </div>
                        </div>

                    </div> 
                    
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <select class="help-block" id="ubicacion" name="ubicacion" required style="width: 100%">
                                    <?php
                                            $mbd=DB::connect();DB::disconnect();
                                            $proof1=$mbd->query("SELECT * FROM departamento");

                                            while($row1 = $row1 = $proof1->fetch(PDO::FETCH_ASSOC)){
                                            if($row1["id_departamento"] == $row["id_departamento"])
                                            {
                                            echo "<option selected value=".$row["id_departamento"].">".$row1["departamento"]."</option>";
                                            }
                                            else
                                            {
                                            echo "<option value=".$row1["id_departamento"].">".$row1["departamento"]."</option>";
                                            }
                                            }                                    
                                            ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="estado"> Estado</label>
                                <select  id="estado" style="width: 100%">
                                    <option <?php if (isset($userRow["estado"]) && $userRow["estado"]=='Entregado') echo 'selected';?> value="Entregado">Entregado</option>
                                    <option <?php if (isset($userRow["estado"]) && $userRow["estado"]=='Reparacion') echo 'selected';?> value="Reparacion">En Reparacion</option>
                                </select>
                            </div>
                        </div>

                    </div>
                         
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="obs"> Observación</label>
                            <textarea class="form-control input-group-sm" id="obs" name="obs" placeholder="Descripción del trabajo..."><?php if (isset($userRow["observaciones"])) echo $userRow["observaciones"];?> </textarea>
                        </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group ">
                                <label for="tipo_mantenimiento">Tipo De Mantenimiento</label>
                                <select class="help-block" id="tipo_mantenimiento"   style="width: 100%">
                                    <option <?php if (isset($userRow["tipo_mantenimiento"]) && $userRow["tipo_mantenimiento"]=='Preventivo') echo 'selected';?> value="Preventivo">Preventivo</option>
                                    <option <?php if (isset($userRow["tipo_mantenimiento"]) && $userRow["tipo_mantenimiento"]=='Correctivo') echo 'selected';?> value="Correctivo">Correctivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div clas="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar Cambios</button>
                                    <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list"></span>
                                        Ver Mantenimientos</a>
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
    <script src="../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
                $(document).ready(function () {
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
                    var id= $("#id").val();
                    var id_equipo= $("#id_equipo").val();
                    var tipo_equipo = $("#tipo_equipo").val();
                    var obs= $("#obs").val();
                    var fecha= $("#fecha").val();
                    var precio= $("#precio").val();
                    var ubicacion= $("#ubicacion").val();
                    var estado= $("#estado").val();
                    var tipo_mantenimiento= $("#tipo_mantenimiento").val();

                    if(id.trim()=='')
                    {
                        toastr.error("ERROR","Ha Ocurrido un error");
                        return;
                    }

                    $.ajax({
                        type:"POST",
                        url:"consultas.php",
                        data:
                            {
                                tarea:"editar",
                                id_equipo:id_equipo,
                                tipo_equipo:tipo_equipo,
                                obs:obs,
                                fecha:fecha,
                                precio:precio,
                                ubicacion:ubicacion,
                                estado:estado,
                                tipo_mantenimiento:tipo_mantenimiento,
                                id:id
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


</html>
