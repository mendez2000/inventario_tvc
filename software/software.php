<?php include('../config/conexion2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Software</title>
     <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
</head>
<body class="login-page">
   <div id="cuerpo" class="col-md-12" >
       <section class="content-header">
           <h1>SOFTWARE</h1>
       
       </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Agregar Nuevo</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                 <div class="box-body">

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="serie"> Producto </label>
                                <input type="text" class="form-control  input-sm  help-block" id="producto" name="producto" placeholder="Ejm office...">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="marca">Fabricante</label>
                            <select class="help-block" id="marca" name="marca" required style="width: 100%">
                                <?php ComboBoxMarca("SELECT * FROM marca","id_marca","nombre_marca"); ?><option disabled selected value></option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                    <label for="serie"> Edición </label>
                                    <input type="text" class="form-control  input-sm  help-block" id="edicion" name="edicion" placeholder="Ejm Vegas Pro...">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="serie"> Versión </label>
                                <input type="text" class="form-control  input-sm  help-block" id="version" name="version" placeholder="Ejm 2.0...">
                            </div>
                        </div>
                    </div>
                     
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="serie"> Categoría </label>
                            <select class="help-block" id="categoria" name="categoria" required style="width: 100%">
                            <?php ComboBoxMarca("SELECT * FROM categoria_software;","id_categoria","categoria"); ?><option disabled selected value></option>
                            </select>                            
                        </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="obs"> Nota:</label>
                            <textarea class="form-control input-group-sm" id="nota" name="nota" placeholder="Ejemplo: Software especifico para SO de 32..."></textarea>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                                <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>
                                    Buscar Software</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div><!-- /.box-body -->
                </form>
            </div>
    </div>
    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script src="../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>

        $(document).ready(function () {
            $("select").select2();
        });

                            
        $("#guardar").click(function()
        {
        var producto= $("#producto").val();
        var marca = $("#marca").val();
        var edicion= $("#edicion").val();
        var version= $("#version").val();
        var categoria= $("#categoria").val();
        var nota= $("#nota").val();
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"guardar",
                    producto:producto,
                    marca:marca,
                    edicion:edicion,
                    version:version,
                    categoria:categoria,
                    nota:nota
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){

                            toastr.success('Éxito','Guardado correctamente');
                            limpiarcampos();
                        }
                        else if (item=="existe")
                        {
                            toastr.error('Error','Software existente!');

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
                            
            function limpiarcampos(){
                document.getElementById("producto").value="";
                document.getElementById("edicion").value="";
                document.getElementById("version").value="";
                document.getElementById("nota").value="";
                    //LIMPIAR LOS SELCT
                    let selectmarca=document.getElementById("marca")
                    let optionmodaldis=document.createElement("option")
                    optionmodaldis.value=""
                    optionmodaldis.setAttribute("disabled","")
                    optionmodaldis.setAttribute("selected","")
                    optionmodaldis.setAttribute("hidden","")
                    selectmarca.add(optionmodaldis)  

                    let selectcategoria=document.getElementById("categoria")
                    let optionmodaldis2=document.createElement("option")
                    optionmodaldis2.value=""
                    optionmodaldis2.setAttribute("disabled","")
                    optionmodaldis2.setAttribute("selected","")
                    optionmodaldis2.setAttribute("hidden","")
                    selectcategoria.add(optionmodaldis2) 
            
            }

            function goBack(){
                    setTimeout(function(){  window.location.href="ver_software.php";  }, 30);
            }
                    
    </script>               
</body>
<?php
 

function ComboBoxMarca($consul,$id,$nombre)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$id"]."'>";
        echo $row["$nombre"];
        echo "</option>";
    }
}
?>

</html>