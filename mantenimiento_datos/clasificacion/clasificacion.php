<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clasificacion de Equipo</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
       <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">
    <div id="cuerpo" class="col-md-8" >
        <div class="col-md-8 col-md-offset-3">
         
                <h3>CLASIFICACION</h3>
            
  
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Agregar Nueva</h2>
                
                 

                    <form id="formclasificacion">
                        <div id="demo" class="modal-body">
                        <label for="clas">Nombre de la Clasificación</label>
                        <input type="text" class="form-control input-sm help-block" id="nombre_clasificacion" name="nombre_clasificacion" required placeholder="Nombre de la Clasificación">
                        </div>
                        <div class="modal-footer">
                        <a href="../indexform.php">
                       
                        <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span> Mantenimientos </button></a>
                            <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar </button>
                            <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        $("#guardar").click(function(){    
            const formcla=document.getElementById("formclasificacion")
            var nombre_clasificacion = $("#nombre_clasificacion").val();

            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"guardar",
                    nombre_clasificacion:nombre_clasificacion
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formcla.reset()
                            toastr.success("Guardado")
                        
                        }
                        else if (item=="vacio"){
                            toastr.warning("Campo por rellenar!")

                        } else if (item=="existe"){
                            toastr.warning("Clasificación ya existente!")
                            formcla.reset()
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
        document.getElementById("nombre_clasificacion").value="";
        }

        function goBack(){
        setTimeout(function(){  window.location.href="ver_clasificacion.php";  }, 30);
        }                   
    </script>
</body>
</html>