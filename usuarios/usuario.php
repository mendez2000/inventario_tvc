<?php  
session_start();


if($_SESSION['tipo']!="admin"){
    echo "<script>  window.location.href='/inventario/admin1.php';  alert('NO tiene permisos para crear nuevos usuarios');</script>";
 

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
        <div class="box box-primary">
            <div class="box-header with-border">
                  <h2 class="box-title">Crear Nuevo Usuario</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form >
                    <div class="box-body">
                    
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                <label for="empleado">Empleado</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                    </div>
                                
                                        <select class="form-control " id="empleado" name="empleado" style="width:100%"><option hidden disabled selected value> --Seleccione una opción-- </option>
                                        <?php cargaComboBox("SELECT * FROM empleados","id_empleado","nombre","apellido") ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre de Usuario</label>
                                    <input type="text" class="form-control " id="nombre" name="nombre" placeholder="Ingrese un nombre de usuario">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="contrasena">Contraseña</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                    </div>
                                        <input type="password" class="form-control " id="contrasena" name="contrasena" placeholder="Ingrese la contrase&ntilde;a">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                <label for="ccontrasena">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-download"></i>
                                    </div>
                                    <input type="password" class="form-control " id="ccontrasena" name="ccontrasena" placeholder="Confirme la contrase&ntilde;a">
                                </div>
                            </div>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="tipo">Tipo de Usuario</label>
                                    <select  id="tipo" class="form-control" style="width: 100%"><option hidden disabled selected value> --Seleccione una opción-- </option>
                                        <option value="admin">Admin</option>
                                        <option value="tecnico">Tecnico</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="estado">Estado del Usuario</label>
                                    <select  id="estado" class="form-control" style="width:100%"><option hidden disabled selected value> --Seleccione una opción-- </option>
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">    
                                    <div class="btn-group pull-right">
                                    <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>
                                        Buscar Usuarios</a>

                                        <a  href="/inventario/index.php" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>
                                        Salir</a>
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
                    
 
        $("#guardar").click(function()
        {
        var empleado = document.getElementById('empleado').value;
        var nombre = document.getElementById('nombre').value;
        var contrasena = document.getElementById('contrasena').value;
        var cc = document.getElementById('ccontrasena').value;
        var tipo = document.getElementById('tipo').value;
        var estado = document.getElementById('estado').value;

        if( nombre.trim()=='' && cc.trim()=='' && contrasena.trim()=='')
            {
                toastr.error('Error','Hay campos obligatorios');
                
                return;
            }

        if(contrasena != cc){
            toastr.error('Error','no coinciden las claves');
            return;
            
        }

            
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"guardar",
                    empleado:empleado,
                    nombre:nombre,
                    contrasena:contrasena,
                    cc:cc,
                    tipo:tipo,
                    estado:estado

                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="bien"){

                            toastr.success('Exito','se ha Guardado correctamnete');
                            limpiarcampos();
                        }
                        if (item=="yae"){
                            toastr.error('Error','Este empleado ya tiene cuenta');

                        }
                        if (item=="yan"){
                            toastr.error('Error','Este nombre de usuario ya existe');

                        }
                        if (item=="mal"){
                            toastr.error('Error','Este nombre de usuario ya existe');

                        }
                        if (item=="noc"){
                            toastr.warning('Error','las contrasenas no coinciden');

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

        document.getElementById("nombre").value="";
        document.getElementById("contrasena").value="";
        document.getElementById("ccontrasena").value="";
                
        }
        function goBack(){
            setTimeout(function(){  window.location.href="ver_usuario.php";  }, 30);
        }


    </script>

</body>
  
<?php 	
function cargaComboBox($consul,$id,$nombre, $apellido)
    {
     include('../config/conexion2.php');
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