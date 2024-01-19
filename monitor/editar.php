<?php
include('../config/conexion2.php');
$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
       $proof=$mbd->query("SELECT monitor.id_monitor,monitor.num_inventario,marca.id_marca,marca.nombre_marca,monitor.serie,monitor.serv_tag,monitor.tamano,monitor.tipo_monitor,monitor.observacion,monitor.fecha_compra FROM monitor 
       LEFT JOIN marca ON marca.id_marca=monitor.id_marca WHERE monitor.id_monitor='$id';");

      foreach($proof as $row){
		  $row["num_inventario"];
		  $row["id_marca"];
		  $serie=$row["serie"];
		  $serv=$row["serv_tag"];
		  $tam=$row["tamano"];
		  $tipo=$row["tipo_monitor"];
		  $obs=$row["observacion"];
		  $fecha=$row["fecha_compra"];
          $id_marca=$row["id_marca"];
          $marca=$row["nombre_marca"];

          if ($tipo == 'LCD') {
            $tipo1 = 'LCD';
            $tipo2 = 'LED';
          } else if ($tipo=='LED') {
            $tipo1 = 'LED';
            $tipo2 = 'LCD';
          } 
	  }
?>
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
        <h1>
            MONITOR
            <small>Editar Monitor</small>
        </h1>
        <ol class="breadcrumb">
            <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a >Monitor</a></li>
            <li class="active">Editar Monitor</li>
        </ol>
    </section>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Editar Monitor</h2>
            </div>
            <!-- form start -->    
            <form role="form">
                    <div class="box-body">
                        <input type="hidden" id="id" value="<?php if (isset($id)) echo $id;?>">

                        <div class="row">
                        
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                <label for="inventario">Numero de Inventario*</label>
                                <div class="input-group">
                                    <input type="text" id="inventario" value="<?php if (isset($row["num_inventario"])) echo $row["num_inventario"];?>" class="form-control input-sm" placeholder="Numero de Inventario">
                                    <span class="input-group-btn">
                                    <button type="button" id="generarInv" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                                    </span>
                                </div>
                            </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                <label for="marca">Marca</label>
                                    <select class="help-block" id="marca" name="marca" required style="width: 100%" >
                                        <?php
                                        
                                        $mbd=DB::connect();DB::disconnect();
                                            $proof=$mbd->query("SELECT * FROM marca where id_marca<>'$id_marca';");
                                            while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option value="'.$row['id_marca'].'"  > '.$row['nombre_marca'].'</option>' ;
                                            }
                                            echo '<option value="'.$id_marca.'" selected="" >  '.$marca.'</option>' ;
                                        ?>
                                    </select>
                            </div>
                            </div>                    
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                <label for="serie"> Serie  (OPCIONAL)</label>
                                <input type="text" class="form-control input-sm " id="serie" value="<?php echo $serie; ?>" name="serie" placeholder="Serie del monitor">
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                <label for="serv"> Modelo</label>
                                <input type="text" class="form-control input-sm" id="serv" value="<?php echo $serv; ?>" name="serv" placeholder="Modelo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                <label for="tamano"> Tamaño</label>
                                <input type="text" class="form-control input-sm" id="tamano" name="tamano" value="<?php echo $tam; ?>"  placeholder="Tamaño del monitor">
                            </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="tipo"> Tipo de monitor</label>
                                    <select id="tipo" name="tipo"  class="form-control input-sm" style="width: 100%">
                                        <?php
                                            if (isset($tipo)) {
                                            echo '<option value="' .$tipo1. '" selected="" > ' .$tipo1. '</option>';
                                            echo '<option value="' .$tipo2. '"  >  ' .$tipo2. '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>            
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">            
                                <div class="form-group">
                                    <label for="fecha_compra"> Fecha Compra  (OPCIONAL)</label>
                                    <input class="form-control input-sm" id="fecha_compra" value="<?php echo $fecha; ?>">
                                </div>
                            </div> 
                            <div class="col-12 col-lg-6 col-md-6">              
                                <div class="form-group">
                                    <label for="obs"> Observación  (OPCIONAL)</label>
                                    <textarea class="form-control input-group-sm" id="obs" name="obs" placeholder="Ejemplo Buen estado..."><?php echo $obs; ?></textarea>
                                </div>
                            </div>
                        </div>                
                    
                        <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="btn-group pull-right">
                                            <button type="button" id="guardar" name="guardar"  class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                            <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg"  style="margin: 3px">   <span class="fa fa-list"></span>
                                                Ver Monitores</a>
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
    <script type="text/javascript" src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

    <script>
                    $(document).ready(function () {
                        $("#inventario").inputmask("99-999-9999");
                        $("select").select2();

                        $('#fecha_compra').datepicker({
                            clearBtn: true,
                            language: "es"
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
                        var id= $("#id").val();
                        var inventario= $("#inventario").val();
                        var marca = $("#marca").val();
                        var serie= $("#serie").val();
                        var service= $("#serv").val();
                        var tamano= $("#tamano").val();
                        var tipo= $("#tipo").val();
                        var fecha_compra= $("#fecha_compra").val();
                        var obs= $("#obs").val();
                       
                        $.ajax({
                            type:"POST",
                            url:"consultas.php",
                            data:
                                {
                        
                                    tarea:"editar",
                                    id:id,
                                    inventario:inventario,
                                    marca:marca,
                                    serie:serie,
                                    service:service,
                                    tamano:tamano,
                                    tipo:tipo,
                                    fecha_compra:fecha_compra,
                                    obs:obs,
                                },
                            success: function(data)
                            {
                                data=data.split("|");
                                $.each(data, function(i, item) {

                                    if (item=="actualizado"){
                                        toastr.success('Éxito','Actualizado correctamente');
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
                                toastr.error("Error", thrownError);
                                toastr.error("ERROR", "No funciona ajax para guardar");
                            }
                        })


                    });

                    function limpiarcampos(){
                        document.getElementById("inventario").value="";
                        document.getElementById("serie").value="";
                        document.getElementById("serv").value="";
                        document.getElementById("tamano").value="";
                        document.getElementById("fecha_compra").value="";
                        document.getElementById("obs").value="";
                            //LIMPIAR LOS SELCT
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

</html>