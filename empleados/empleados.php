<?php
include('../config/conexion2.php');
session_start();
//if($_SESSION['tipo']!="admin"){
  //  echo "<script>  window.location.href='ver_empleados.php';  alert('no tiene permisos para crear nuevos empleados');</script>";
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
     <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/select2.min.css">
     <link rel="stylesheet" href="../assets/css/toastr.css">
     <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body class="login-page">
<div id="cuerpo" class="col-md-12" >
        <section class="content-header">
            <h1>Empleados</h1>
          
        </section>

    <div class="box box-primary">

        <div class="box-header with-border">
            <h2 class="box-title">Agregar Nuevo</h2>
        </div>

        <form role="form" id=formemp>
            <div class="box-body">

                <div class="row ">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control input-md" id="nombre" name="nombre" required placeholder="Nombre">
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
                                <input type="text" class="form-control input-md" id="apellido" name="apellido" required placeholder="Apellido">
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
                                <input type="text" class="form-control input-md" id="telefono" name="telefono"  placeholder="Telefono">
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
                                <input type="text" class="form-control input-md" id="correo"  placeholder="Correo">
                            </div>
                        </div>
                    </div>
                     
                    
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="departamento">Departamento</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <select  name="sldepartamento" id="sldepartamento" class="form-control"><option hidden disabled selected value> --seleccione una opcion-- </option>
                                    <?php cargadepartamento("SELECT * FROM departamento","id_departamento","departamento") ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <div class="btn-group pull-right"> 
                                <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar </button>
                                <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg"  style="margin: 3px"><span class="fa fa-search"></span>
                                    Ver Empleados</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        
        $("#guardar").click(function(){
                var telefono = $("#telefono").val();
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var correo = $("#correo").val();
                var departamento = $("#sldepartamento").val();
            // alert(departamento)

        if(nombre.trim()=='' && apellido.trim()=='' && departamento.trim()=='')
            {
                toastr.error("Faltan campos por llenar");
                return;
            }
            else
            {
                $.ajax({
                        type:"POST",
                        url:"consultas.php",
                        data:
                        {
                            tarea:"guardar",
                            telefono:telefono,
                            nombre:nombre,
                            apellido: apellido,
                            correo: correo,
                            departamento:departamento

                        },
                        success: function(data)
                        {
                            data=data.split("|");
                            $.each(data, function(i, item) {

                                if (item=="guardado"){
                                    toastr.success('Éxito','se ha Guardado correctamente!');
                                    limpiarcampos();
                                }
                                else if (item=="existe"){
                                    toastr.error('Warning','Dato ya existente');
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
        });//final boton guardar


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
<?php

function cargadepartamento($consul,$id,$nombre)
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