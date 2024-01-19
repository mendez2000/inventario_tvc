<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Estado de Equipo</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
       <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">
   <div id="cuerpo" class="col-md-8" >
       
           <div class="col-md-8 col-md-offset-3" >

        
                <h3>ESTADOS</h3>
             
       
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Agregar Nuevo</h2>
             
              

                    <form id="formest">
                    <div id="demo" class="modal-body">
                    <label for="clas">Nombre del Estado</label>
                    <input type="text" class="form-control input-sm help-block" id="nombre_est" name="nombre_est" required placeholder="Nombre del Estado">
                    </div>

                    <div class="modal-footer">
                    <a href="../indexform.php">
                        <button type="button" id="cerrarest" name="cerrarest"  class="btn btn-danger btn-flat"> <span class="fa fa-database"></span> Mantenimientos</button>
                    </a>
                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                        <a  onclick="goBack()"  class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Estados</a>
                    </div>
                    
                    </form>
                    </div>
       </div>
   </div>
   </div>
    <script>

        $("#guardar").click(function(){    
        const formest=document.getElementById("formest")
        var nombre_est = $("#nombre_est").val();

        $.ajax({
            type:"POST",
            url:"consultas.php",
            data:
            {
                tarea:"guardar",
                nombre_est:nombre_est
            },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {

                    if (item=="guardado"){
                        formest.reset()
                        toastr.success("Guardado")
                    
                    }
                    else if (item=="vacio"){
                        toastr.warning("Campo por rellenar!")

                    } else if (item=="existe"){
                        toastr.warning("Estado ya existente!")
                        formest.reset()
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
        document.getElementById("nombre_est").value="";
        }

        function goBack(){
        setTimeout(function(){  window.location.href="ver_estados.php";  }, 30);
        }
                    
    </script>

</body>
</html>