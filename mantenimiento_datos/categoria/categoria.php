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
   
                  <h3>CATEGORIA</h3>
              
       
      <div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title">Agregar Nueva</h2>
        </div>
        <form role="form">
          <div class="box-body">        
            <div class="form-group">
              <label for="marca">Nombre categoria de Software</label>
              <input type="text" class="form-control input-md col-md-6 col-sm-7 col-xs-8" id="categoria" name="categoria" placeholder="Categoria de Software">
            </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
            <a href="../indexform.php">
                <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span> Mantenimientos</button>
            </a>

            <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span>  Guardar</button>
            <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Categorias</a>
          </div>
        </form>
      </div>
      </div>
   </div>
  <script> 

    $("#guardar").click(function(){
      var categoria= $("#categoria").val();
      $.ajax({
          type:"POST",
          url:"consultas.php",
          data:
          {
            tarea:"guardar",
              categoria:categoria
          },
          success: function(data)
          {
              data=data.split("|");
              $.each(data, function(i, item) {

                  if (item=="guardado"){
                      toastr.success('Éxito','Guardado correctamente');
                      document.getElementById("categoria").value="";
                  }
                  else if (item=="existe")
                  {
                      toastr.error('Error','Categoría existente!');
                      document.getElementById("categoria").value="";

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