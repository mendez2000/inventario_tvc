<?php  
session_start();


if($_SESSION['tipo']!="admin"){
    echo "<script>  window.location.href='/inventario/admin1.php';  alert('NO tiene permisos para editar usuarios');</script>";
 

}
include ("../config/conexion2.php");
$id=$_GET["id"];
$mbd=DB::connect();DB::disconnect();
$stmt = $mbd->prepare("SELECT id_usuario, nombre_usu, pass, id_empleado, tipo_usuario, estado FROM usuario_sistema WHERE id_usuario=:id");
$stmt->execute(array(':id'=>$id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body class="login-page">
    <div id="cuerpo" class="col-md-12" >
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Editar Usuario</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form >
                <div class="box-body">

                    <input type="hidden" class="form-control " id="id" name="id" value="<?php if (isset( $userRow['id_usuario'])) echo  $userRow['id_usuario']; ?>" placeholder="Ingrese un nombre de usuario">

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre de Usuario</label>
                                <input type="text" disabled class="form-control " id="nombre" name="nombre" value="<?php if (isset( $userRow['nombre_usu'])) echo  $userRow['nombre_usu']; ?>" placeholder="Ingrese un nombre de usuario">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="tipo">Tipo de Usuario</label>
                                <select  id="tipo" class="form-control" style="width: 100%">
                                    <option <?php if (isset( $userRow['tipo_usuario']) && $userRow['tipo_usuario']=="admin") echo "selected"; ?>  value="admin">Admin</option>
                                    <option <?php if (isset( $userRow['tipo_usuario']) && $userRow['tipo_usuario']=="tecnico") echo "selected"; ?> value="tecnico">Tecnico</option>
                                </select>
                            </div>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="estado">Estado del Usuario</label>
                                <select  id="estado" class="form-control" style="width: 100%">
                                    <option <?php if (isset( $userRow['estado']) && $userRow['estado']==1) echo "selected"; ?> value="1" >Activo</option>
                                    <option <?php if (isset( $userRow['estado']) && $userRow['estado']==0) echo "selected"; ?> value="0" >Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">


            
            <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span>Guardar Cambios </button>
            <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px">   <span class="fa fa-list"></span>Ver Usuarios</a>
            <a  href="/inventario/index.php" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>Salir</a>
                   
                
                </div>
                            </div>            
                        </div>        
                    </div>    
                </div><!-- /.box-body -->
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script>
        $(document).ready(function () {
            $("select").select2();
        });

        $("#guardar").click(function () {

            var id = $("#id").val();
            var tipo = $("#tipo").val();
            var estado = $("#estado").val();
            if( id.trim()=='')  {  toastr.error('Error','Hay campos obligatorios'); return;  }

            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                    {
                        tarea:"modificar",
                        tipo:tipo,
                        estado:estado,
                        id:id
                    },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="bien"){

                            toastr.success('Exito','se ha Guardado correctamnete');
                            goBack();
                        }
                        if (item=="mal"){
                            toastr.error('Error','Ha Ocuurido un Error');

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
            setTimeout(function(){  window.location.href="ver_usuario.php";  }, 30);
        }
    </script>
</body>
</html>