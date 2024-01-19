<?php  
session_start();


if(!isset($_SESSION['tipo'])){
    echo "<script>  window.location.href='/inventario/admin1.php';  alert('NO tiene permisos para cambiar la contraseña');</script>";
 

}
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

    <div class="col-md-11 " >
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Cambiar Clave</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form >
                <div class="box-body">

                        <input type="hidden"  value="<?php if (isset($_SESSION['user_session'])) echo $_SESSION['user_session']; ?>" id="id" name="id" >


                    <div class="form-group">
                        <label for="nombre">Nombre de Usuario</label>
                        <input type="text" disabled class="form-control" value="<?php if (isset($_SESSION['nombre'])) echo $_SESSION['nombre']; ?>" id="nombre" name="nombre" placeholder="Ingrese un nombre de usuario">
                    </div>

                    <div class="form-group">
                        <label for="contrasena">contrase&ntilde;a Vieja</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </div>
                            <input type="password" class="form-control " id="contrasena_vieja"  placeholder="Ingrese la contrase&ntilde;a Vieja">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contrasena">contrase&ntilde;a Nueva</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </div>
                            <input type="password" class="form-control " id="contrasena" name="contrasena" placeholder="Ingrese la contrase&ntilde;a">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ccontrasena">Confirmar contrase&ntilde;a Nueva</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-download"></i>
                            </div>
                            <input type="password" class="form-control " id="ccontrasena" name="ccontrasena" placeholder="Confirme la contrase&ntilde;a">
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" id="guardar" class="btn btn-success btn-flat btn-lg"> Actualizar</button>
                    
                    <a  href="/inventario/index.php" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>
                                        Salir</a>
                </div>
            </form>
            <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
            <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
            <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

            <script type="text/javascript" src="../assets/js/toastr.js"></script>
            <script>
                $(document).ready(function () {
                    $("select").select2();
                });


                $("#guardar").click(function()
                {
                    var id = document.getElementById('id').value;
                    var contrasena_vieja = document.getElementById('contrasena_vieja').value;
                    var nombre = document.getElementById('nombre').value;
                    var contrasena = document.getElementById('contrasena').value;
                    var cc = document.getElementById('ccontrasena').value;


                    if( nombre.trim()=='' && cc.trim()=='' || contrasena.trim()=='') { toastr.error('Error','Hay campos obligatorios'); return;}
                    if( id.trim()==''){toastr.error('Error','Hay campos obligatorios');  return; }
                    if( contrasena.trim()==''){  toastr.error('Error','La Clave no puede estar vacia'); return; }


                    if(contrasena != cc){
                        toastr.error('Error','no coinciden las claves');
                        return;
                    }
                    if(contrasena == contrasena_vieja){
                        toastr.warning('Error','Las claves son  las mismas, intente de nuevo');
                        return;
                    }


                    $.ajax({
                        type:"POST",
                        url:"consultas.php",
                        data:
                            {
                                tarea:"editar",
                                nombre:nombre,
                                contrasena:contrasena,
                                cc:cc,
                                id:id,
                                contrasena_vieja:contrasena_vieja

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
                                if (item=="noc"){
                                    toastr.error('Error','Las Claves No coinciden');
                                }
                                if (item=="clavenovalida"){
                                    toastr.error('Error','La Clave Antigua no existe');
                                }
                            });


                            limpiarcampos();
                        },
                        error: function(xhr, ajaxOptions, thrownError)
                        {
                            alert(thrownError);
                            alert("No funciona ajax para guardar");
                        }
                    })

                });

                function limpiarcampos(){
                    document.getElementById("contrasena").value="";
                    document.getElementById("ccontrasena").value="";
                }

            </script>
        </div>
    </div>
</div>


</body>

<?php
function cargaComboBox($consul,$id,$nombre, $apellido)
{
    include('../config/conexion2.php');
    //$resul=mysqli_query($mysqli,$consul);
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$id"]."'>";
        echo $row["$nombre"]."  ".$row["$apellido"];
        echo "</option>";

    }
}

?>

</html>