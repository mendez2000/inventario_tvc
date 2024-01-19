<?php 
include_once '../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
         $proof=$mbd->query("SELECT accesorio.num_inv_acc,accesorio.modelo,accesorio.descri,accesorio.serie,accesorio.id_taccesorio,accesorio.id_marca,accesorio.fecha_compra,marca.nombre_marca,tipo_accesorio.tipo_accesorio
         FROM accesorio 
         LEFT JOIN marca ON accesorio.id_marca=marca.id_marca
         LEFT JOIN tipo_accesorio ON accesorio.id_taccesorio=tipo_accesorio.id_taccesorio WHERE id_accesorio='$id';");
      foreach($proof as $row){
		  $inventario=$row["num_inv_acc"];
		  $modelo=$row["modelo"];
		  $descri=$row["descri"];
		  $serie=$row["serie"];
		  $marca=$row["nombre_marca"];
          $id_marca=$row["id_marca"];
		  $fecha=$row["fecha_compra"];
		  $tipo=$row["tipo_accesorio"];
          $id_tipo=$row["id_taccesorio"];		  
	  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accesorios</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets/css/toastr.css">
     <link rel="stylesheet" href="../assets/js/node_modules/custombox/dist/custombox.min.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">


</head>
<body class="login-page">
    <div id="cuerpo" class="col-md-12" >
        <section class="content-header">
            <h1>
                Accesorios
             
            </h1>
      
        </section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Editar Accesorio</h2>
                </div>
                <form role="form">
                    <div class="box-body">
                        <input type="hidden" id="id" name="id" value="<?php if (isset($id)) echo $id;?>">
                        
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="inventario">Numero de Inventario*</label>
                                    <div class="input-group  ">
                                    <span class="input-group-btn">
                                    <button type="button" id="generarInv" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                                    </span>
                                    <input type="text" id="inventario" name="inventario" value="<?php echo $inventario; ?>" class="form-control input-sm" placeholder="Numero de Inventario">      
                                </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="tipo">Tipo Accesorio</label>
                                    <select class="form-control input-sm help-block" id="tipo" name="tipo" required style="width: 100%" >
                                        <?php
                                        if(isset($id_tipo)){
                                        $mbd=DB::connect();DB::disconnect();
                                            $proof=$mbd->query("SELECT * FROM tipo_accesorio where id_taccesorio<>'$id_tipo';");
                                            while($row = $proof->fetch(PDO::FETCH_ASSOC)){
                                                echo "<option value='".$row['id_taccesorio']."'  > ";
                                                echo $row['tipo_accesorio'];
                                                echo "</option>" ;
                                            }
                                            echo "<option value='".$id_tipo."' selected='' >";
                                            echo $tipo;
                                            echo "</option>" ;
                                        }?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control input-sm help-block" value="<?php echo $modelo; ?>" id="modelo" name="modelo" placeholder="Modelo">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="serie">Serie (OPCIONAL)</label>
                                    <input type="text" class="form-control input-sm help-block" value="<?php echo $serie; ?>" id="serie" name="serie" placeholder="serie">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <select class="form-control input-sm help-block" id="marca" name="marca" style="width: 100%">
                                        <?php
                                        $mbd=DB::connect();DB::disconnect();
                                            $proof=$mbd->query("SELECT * FROM marca where id_marca<>'$id_marca';");
                                            echo '<option value="'.$id_marca.'"selected="">'.$marca.'</option>' ;
                                            while($row = $proof->fetch(PDO::FETCH_ASSOC)){
                                                echo "<option value='".$row['id_marca']."'>".$row['nombre_marca']."</option>" ;
                                            }  
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="fecha_compra">Fecha Compra (OPCIONAL)</label>
                                    <input type="text" class="form-control input-sm" id="fecha_compra" value="<?php echo $fecha; ?>" name="fecha_compra" placeholder="Fecha de compra">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción (OPCIONAL)</label>
                                    <textarea  class="form-control input-sm" id="descripcion"  name="descripcion" placeholder="Nota del Accesorio"><?php echo $descri; ?></textarea>
                                </div>
                            </div>
                        </div>  
        
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <div class="btn-group pull-right">
                                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Actualizar Cambios</button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="glyphicon glyphicon-list"></span>
                                            Ver Accesorios</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>

    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script type="text/javascript" src="../assets/js/node_modules/custombox/dist/custombox.min.js"></script>
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
            var id = $("#id").val();
            var inventario = $("#inventario").val();
            var tipo = $("#tipo").val();
            var modelo = $("#modelo").val();
            var serie = $("#serie").val();
            var marca = $("#marca").val();
            var fecha = $("#fecha_compra").val();
            var descri = $("#descripcion").val();
            
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                    {
                        tarea:"editar",
                        id:id,
                        inventario:inventario,
                        tipo:tipo,
                        modelo:modelo,
                        serie:serie,
                        marca:marca,
                        fecha:fecha,
                        descri:descri
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
                    alert(thrownError);
                    alert("No funciona ajax para guardar");
                }
            })


        });

        function limpiarcampos(){

            document.getElementById("id").value="";
            document.getElementById("inventario").value="";
            document.getElementById("modelo").value="";
            document.getElementById("serie").value="";
            document.getElementById("descripcion").value="";
            document.getElementById("fecha_compra").value="";

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


        function goBack(){ setTimeout(function () { window.location.href = "ver_accesorios.php"; }, 30); }

    </script>
</body>
<?php
function cargacombo($consul,$id,$nombre)
{

    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";

        echo $row[$nombre];
        echo "</option>";

    }
}
?>
</html>