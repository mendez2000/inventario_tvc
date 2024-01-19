<?php include('../config/conexion2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monitor</title>
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
           <h1>MONITOR</h1>

       </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Agregar Nuevo</h2>
                </div>
         
                <form role="form">
                    <div class="box-body">

                    <div class="row">
                    
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="inventario">Numero de Inventario*</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" id="generarInv" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                                    </span>
                                    <input type="text" id="inventario" class="form-control input-sm" placeholder="Numero de Inventario">                                
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label for="marca">Marca</label>
                            <select class="form-control" id="marca" name="marca" required style="width: 100%" placeholder="marca">
                                <?php ComboBoxMarca("SELECT * FROM marca","id_marca","nombre_marca"); ?><option disabled selected value></option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="serie"> Serie (OPCIONAL)</label>
                                <input type="text" class="form-control input-sm" id="serie" name="serie" placeholder="Serie del monitor">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="serie"> Modelo</label>
                                <input type="text" class="form-control input-sm" id="servtag" name="servtag" placeholder="Serie del monitor">
                            </div>                   
                        </div>
                     </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="tamano"> Tamaño</label>
                                <input type="text" class="form-control input-sm" id="tamano" name="tamano" placeholder="Tamaño del monitor">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="tipo"> Tipo de monitor</label>
                                <select id="tipo" class="form-control input-sm" style="width: 100%">
                                    <option disabled selected value></option>
                                    <option value="LCD">LCD</option>
                                    <option value="LED">LED</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="fecha_compra">Fecha Compra (OPCIONAL)</label>
                                <input type="text" class="form-control input-sm" id="fecha_compra" name="fecha_compra" placeholder="Fecha de compra">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="obs"> Observación (OPCIONAL)</label>
                                <textarea class="form-control input-group-sm" id="obs" name="obs" placeholder="Ejemplo Buen estado..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <button type="button" id="guardar" name="guardar"  class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                                    <a onclick=goBack() class="btn btn-success btn-flat btn-lg"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Monitor</a> 
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
            $("#inventario").inputmask("99-999-9999");
            $("select").select2();
            $('#fecha_compra').datepicker({
                clearBtn: true,
                format: 'dd-mm-yyyy',
                language: 'ES'
            });

        });

        $("#generarInv").click(function () {
            var timestamp = event.timeStamp;
            var d = new Date();
            var seconds = d.getSeconds();
            var year= d.getFullYear();
            var x=year+""+seconds+""+timestamp;
            var SetInventario= x.substring(0, 9);
            $("#inventario").val(SetInventario);
            console.log(SetInventario);
        });

        $("#guardar").click(function()
        {
        var inventario= $("#inventario").val();
        var marca = $("#marca").val();
        var serie= $("#serie").val();
        var service= $("#servtag").val();
        var tipo= $("#tipo").val();
        var tamano= $("#tamano").val();
        var obs= $("#obs").val();
        var fecha_compra= $("#fecha_compra").val();
                
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                    {
                        tarea:"guardar",
                        inventario:inventario,
                        marca:marca,
                        serie:serie,
                        service:service,
                        tipo:tipo,
                        tamano:tamano,
                        obs:obs,
                        fecha_compra:fecha_compra
                        
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
                                toastr.warning('Error','Inventario existente!');

                            }
                            else if (item=="vacio")
                            {
                                toastr.error('Campos vacíos!');
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
            document.getElementById("inventario").value="";
            document.getElementById("serie").value="";
            document.getElementById("servtag").value="";
            document.getElementById("tamano").value="";
            document.getElementById("fecha_compra").value="";
            document.getElementById("obs").value="";
                //LIMPIAR LOS SELECT
                let selectmarca=document.getElementById("marca")
                let optionmodaldis=document.createElement("option")
                optionmodaldis.value=""
                optionmodaldis.setAttribute("disabled","")
                optionmodaldis.setAttribute("selected","")
                optionmodaldis.setAttribute("hidden","")
                selectmarca.add(optionmodaldis) 

                    //LIMPIAR EL SELECT DE MARCA
                    let selecttipo=document.getElementById("tipo")
                let optionmodaldis2=document.createElement("option")
                optionmodaldis2.value=""
                optionmodaldis2.setAttribute("disabled","")
                optionmodaldis2.setAttribute("selected","")
                optionmodaldis2.setAttribute("hidden","")
                selecttipo.add(optionmodaldis2) 
            
        }
            function goBack(){
            setTimeout(function(){  window.location.href="ver_monitores.php";  }, 30);
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