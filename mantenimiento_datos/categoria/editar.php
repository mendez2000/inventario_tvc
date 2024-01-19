<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();

    //$sql = "SELECT * FROM tipo_accesorio WHERE id_taccesorio='$id'";
         $proof=$mbd->query("SELECT * from categoria_software WHERE id_categoria='$id'");
            foreach($proof as $row){
                $row["id_categoria"];
                $row["categoria"];

            }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categoria</title>
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
            <section class="content-header">
                <h1>
                 CATEGORIA
               
                </h1>
            
            </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Editar Categoria</h2>
                </div>
                <form id="formest" role="form">
                <input type="text" class="form-control input-md col-md-6 col-sm-7 col-xs-8 hidden" id="id_categoria" value="<?php echo $row["id_categoria"]; ?>" name="id_categoria" placeholder="Edición de video etc">
                    <div class="box-body">
            <label for="marca">Nombre de la categoria de Software</label>
            <input type="text" class="form-control input-md col-md-6 col-sm-7 col-xs-8" id="categoria" value="<?php echo $row["categoria"]; ?>" name="categoria" placeholder="Edición de video etc">
          </div>
            <hr>
      </div><!-- /.box-body -->

            <div class="row">
                  <div class="col-12 col-lg-12 col-md-12">
                      <div class="form-group">
                          <div class="btn-group pull-right">
                              <div class="box-footer">
                                  <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Actualizar Cambios </button>
                                  <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                      Ver Categorias</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </form>
    </div>
    </div>
  </div>
  <script> 

    $("#guardar").click(function(){
      var categoria= $("#categoria").val();
      var id_categoria= $("#id_categoria").val();
      $.ajax({
        type:"POST",
        url:"consultas.php",
        data:
        {
          tarea:"editar",
          categoria:categoria,
          id_categoria:id_categoria
            
        },
        success: function(data)
        {
            data=data.split("|");
            $.each(data, function(i, item) {

                if (item=="actualizado"){
                    toastr.success('Éxito','Actualizado correctamente');
                    document.getElementById("categoria").value="";
                }
                else if (item=="existe")
                {
                    toastr.error('Error','Categoría existente!');

                }
                else if (item=="vacio")
                {
                    toastr.warning('Campos vacíos!');
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
                    
    function goBack(){ setTimeout(function(){  window.location.href="ver_categoria.php";  }, 30); }

  </script>
</body>
</html>