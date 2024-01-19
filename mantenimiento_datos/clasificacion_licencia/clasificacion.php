<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Licencia</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"> 
       <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
       <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">

</head>
<body class="login-page">
  <div id="cuerpo" class="col-md-8" > 
    <div class="col-md-8 col-md-offset-3" >
   
                  <h3>CLASIFICACION LICENCIA</h3>
              
       
      <div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title">Agregar Nueva</h2>
        </div>
                <form role="form">
                <div class="box-body">

                    <div class="row col-md-12 col-lg-12">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="marca"> Clasificación </label>
                            <input type="text" class="form-control input-md col-md-6 col-sm-7 col-xs-8" id="clasif" name="clasif" placeholder="Dongle... etc">
                        </div>
                    </div>
                     
                    <div class="row col-md-12 col-lg-12">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="tipo"> Tipo de Identificador</label>
                            <select id="tipo" name="tipo" class="form-control  input-sm  help-block">
                                <option disabled selected value></option>
                                <option value="ID">POR ID (se refiere a que la clasificación se estipulará por la llave de la licencia)</option>
                                <option value="NOMENCLATURA">NOMENCLATURA (se definirá una nomenclatura para la clasificación)</option>
                            </select>
                        </div>
                    </div>
                  

                    <div class="box-footer">
                        <a href="../indexform.php">
                            <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat"> Mantenimientos</button>
                        </a>
                       
                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                        <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Clasificación</a>
                    </div>

                    

                </div>
                </form>
            </div>
       </div>
   </div>
  
    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script> 

        $(document).ready(function () {
        
            $("select").select2();
        });

        $("#guardar").click(function(){
        var clasificacion= $("#clasif").val();
        var tipo= $("#tipo").val();
        $.ajax({
            type:"POST",
            url:"consultas.php",
            data:
            {
                tarea:"guardar",
                clasificacion:clasificacion,
                tipo:tipo
            },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {

                    if (item=="guardado"){
                        toastr.success('Éxito','Guardado correctamente');
                        document.getElementById("clasif").value="";

                        let selectmarca=document.getElementById("tipo")
                        let optionmodaldis=document.createElement("option")
                        optionmodaldis.value=""
                        optionmodaldis.setAttribute("disabled","")
                        optionmodaldis.setAttribute("selected","")
                        optionmodaldis.setAttribute("hidden","")
                        selectmarca.add(optionmodaldis) 
                    }
                    else if (item=="existe")
                    {
                        toastr.error('Error','Clasificación existente!');
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
                            
        function limpiarcampos(){  }
        function goBack(){ setTimeout(function(){  window.location.href="ver_clasificaciones.php";  }, 30); }

    </script>
                

</body>
</html>