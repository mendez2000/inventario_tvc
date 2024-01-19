<?php 
      include_once '../config/conexion2.php';
 $mbd=DB::connect();DB::disconnect();
    $id = $_GET['id'];
    $proof=$mbd->query("SELECT * from empleados WHERE id_empleado='$id';");
      foreach($proof as $row){
          $row["id_empleado"];
          $row["nombre"];
		  $row["apellido"];
		  $row["telefono"];
		  $row["correo"];
		  $row["id_departamento"];
	  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>empleados</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body class="login-page">
<div id="cuerpo" class="col-md-12" >
    <section class="content-header">
        <h1>
            Empleados
            <small>Editar Empleado</small>
        </h1>
        <ol class="breadcrumb">
            <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a >Empleados</a></li>
            <li class="active">Editar Empleado</li>
        </ol>
    </section>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">Editar Empleado</h2>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" id=formemp>
            <div class="box-body">
                
                <div class="row ">
                
                    <input type="hidden" id="id" value="<?php if(isset($row["id_empleado"])) echo $row["id_empleado"]; ?>">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control input-md" id="nombre" value="<?php if(isset($row["nombre"])) echo $row["nombre"]; ?>" name="nombre" required placeholder="Nombre">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control input-md" value="<?php if(isset($row["apellido"])) echo $row["apellido"]; ?>" id="apellido" name="apellido" required placeholder="Apellido">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <input type="text" class="form-control input-md" value="<?php if(isset($row["telefono"])) echo $row["telefono"]; ?>" id="telefono" name="telefono"  placeholder="Telefono">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="text" class="form-control input-md" value="<?php if(isset($row["correo"])) echo $row["correo"]; ?>" id="correo"  placeholder="Correo">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="departamento">Departamento</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <select  id="departamento" class="form-control">
                                    <?php
                                    $mbd=DB::connect();DB::disconnect();
                                    $proof1=$mbd->query("SELECT id_departamento,departamento FROM departamento");
                                    while($row1 = $row1 = $proof1->fetch(PDO::FETCH_ASSOC)){

                                        if($row1["id_departamento"] == $row["id_departamento"])
                                        { echo "<option selected value=".$row["id_departamento"].">".$row1["departamento"]."</option>"; }
                                        else
                                        { echo "<option value=".$row1["id_departamento"].">".$row1["departamento"]."</option>"; }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <div class="btn-group pull-right"> 
                                <button type="button" id="guardar"  name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar Cambios</button>
                                <a onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"> <span class="glyphicon glyphicon-list"></span> Ver Empleados </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </form>
    </div>
</div>

    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" href="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script>
        $(document).ready(function () {
            $("select").select2();
        });

            $("#guardar").click(function()
            {
                var telefono = $("#telefono").val();
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var correo = $("#correo").val();
                var id = $("#id").val();
                var departamento = $("#departamento").val();

                if( nombre.trim()=='' && apellido.trim()=='' && departamento.trim()=='')
                {
                    toastr.warning("Faltan campos por rellenar!");
                    return;
                }
                else
                {
                    $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                        {
                            tarea:"editar",
                            telefono:telefono,
                            nombre:nombre,
                            apellido: apellido,
                            correo: correo,
                            id:id,
                            departamento:departamento

                        },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {
                            if (item=="actualizado"){

                                toastr.success('Exito','Actualizado correctamente');
                                limpiarcampos();
                            }
                            else if (item=="existe")
                            {
                                toastr.error('Warning','Empleado existente');
                            }
                            else if (item=="vacio"){
                                toastr.error('Error','Campos faltantes');
                            }

                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError)
                    {
                        alert(thrownError);
                        toast.error("No funciona ajax para guardar");
                    }
                })


                }
                
            });



            function limpiarcampos(){
                document.getElementById("telefono").value="";
                document.getElementById("nombre").value="";
                document.getElementById("apellido").value="";
                document.getElementById("correo").value="";

            }
            function goBack(){
                setTimeout(function(){  window.location.href="ver_empleados.php";  }, 30);

            }

    </script>
</body>
</html>