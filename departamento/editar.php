<?php 
include_once '../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
$proof=$mbd->query("SELECT id_departamento,departamento,edificio.nombre_edificio,edificio.id_edificio from departamento JOIN edificio ON departamento.id_edificio=edificio.id_edificio WHERE id_departamento='$id';");
        foreach($proof as $row){
            $id_dep= $row["id_departamento"];
            $nombredept=$row["departamento"];
            $id_edificio=$row["id_edificio"];
            $nombre_edificio=$row["nombre_edificio"];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departamento</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body class="login-page">
<div id="cuerpo" class="col-md-12" >
    <section class="content-header">
           <h1>
               DEPARTAMENTO
            
           </h1>
        
    </section>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Editar Departamento</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <input type="hidden" id="id" name="id" value="<?php if (isset($row["id_departamento"])) echo  $row["id_departamento"];?>">

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="marca">Nombre Departamento</label>
                                <input type="text" class="form-control " id="departamento" value="<?php if (isset($nombredept)) echo $nombredept; ?>"placeholder="nombre departamento eje: Producion">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                            <label for="marca">Edificio al que pertenece</label>
                            <select class="help-block" id="edificio" name="edificio" required style="width: 100%" placeholder="marca">
                                <?php
                                    if(isset($id_edificio)){
                                    $mbd=DB::connect();DB::disconnect();
                                        $proof=$mbd->query("SELECT * FROM edificio where id_edificio<>'$id_edificio';");
                                        while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                                            echo '<option value="'.$row['id_edificio'].'"  > '.$row['nombre_edificio'].'</option>' ;
                                        }
                                        echo '<option value="'.$id_edificio.'" selected="" >  '.$nombre_edificio.'</option>' ;
                                }?>                        
                            </select>
                    </div>
                            </div>
                            </div>


                <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <div class="btn-group pull-right">
                    <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg"><span class="fa fa-floppy-o"></span> Actualizar Cambios </button>
                    <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg">   <span class="fa fa-list"></span>
                        Ver Departamentos</a>
                        </div>
                                </div>            
                            </div>        
                        </div>    
                </div><!-- /.box-body -->

            </form>


            </div>
    </div>
</div>

            <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.1.1.js"></script>
            <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
            <script src="../assets/plugins/select2/select2.js" type="text/javascript"></script>
            <script type="text/javascript" src="../assets/js/toastr.js"></script>
            <script>
                $(document).ready(function () {
                    $("#edificio").select2();
                });

                $("#guardar").click(function()
                {
                    var id_depto= $("#id").val();
                    var departamento= $("#departamento").val();
                    var edificio=$("#edificio").val();

                    $.ajax({
                            type:"POST",
                            url:"consultas.php",
                            data:
                                {
                                    tarea:"editar",
                                    id_depto:id_depto,
                                    departamento:departamento,
                                    edificio:edificio
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
                                        toastr.warning('Error','Depto existente!');
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
                    document.getElementById("id").value="";
                    document.getElementById("departamento").value="";

                    //LIMPIAR LOS SELCT
                    let selectedi=document.getElementById("edificio")
                    let optionmodaldis=document.createElement("option")
                    optionmodaldis.value=""
                    optionmodaldis.setAttribute("disabled","")
                    optionmodaldis.setAttribute("selected","")
                    optionmodaldis.setAttribute("hidden","")
                    selectedi.add(optionmodaldis) 
                }


                function goBack(){
                    setTimeout(function(){  window.location.href="ver_departamento.php";  }, 30);}

            </script>




</body>
</html>