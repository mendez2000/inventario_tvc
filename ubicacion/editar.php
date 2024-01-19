<?php 
include_once '../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
$proof=$mbd->query("SELECT id_ubicacion,ubicacion,departamento.id_departamento,departamento.departamento from ubicacion LEFT JOIN departamento ON ubicacion.id_departamento=departamento.id_departamento WHERE id_ubicacion='$id';");
        foreach($proof as $row){
            $id_ubi= $row["id_ubicacion"];
            $ubicacion=$row["ubicacion"];
            $id_depto=$row["id_departamento"];
            $depto=$row["departamento"];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ubicacion</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body class="login-page">
<div id="cuerpo" class="col-md-8" >
    <div class="col-md-8 col-md-offset-3" >
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Editar Ubicación</h2>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <input type="hidden" id="id" name="id" value="<?php if (isset($row["id_ubicacion"])) echo  $row["id_ubicacion"];?>">

                    <div class="form-group">
                        <label for="marca">Nombre Ubicación</label>
                        <input type="text" class="form-control " id="ubicacion" value="<?php if (isset($ubicacion)) echo $ubicacion; ?>"placeholder="nombre Ubicacacion eje: Producion">
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="marca">Departamento al que pertenece</label>
                            <select class="help-block" id="depto" name="depto" required style="width: 100%" placeholder="marca">
                                <?php
                                    if(isset($id_depto)){
                                    $mbd=DB::connect();DB::disconnect();
                                        $proof=$mbd->query("SELECT * FROM departamento where id_departamento<>'$id_depto';");
                                        while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                                            echo '<option value="'.$row['id_departamento'].'"  > '.$row['departamento'].'</option>' ;
                                        }
                                        echo '<option value="'.$id_depto.'" selected="" >  '.$depto.'</option>' ;
                                }?>                        
                            </select>
                    </div>



                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                    <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px">   <span class="fa fa-list"></span>
                                        Ver Ubicaciones</a>
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
            $("#depto").select2();
        });

        $("#guardar").click(function()
        {
            var id_ubicacion= $("#id").val();
            var ubicacion= $("#ubicacion").val();
            var depto=$("#depto").val();

            $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                        {
                            tarea:"editar",
                            id_ubicacion:id_ubicacion,
                            ubicacion:ubicacion,
                            depto:depto
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
                                toastr.warning('Error','Ubicación existente!');
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
            document.getElementById("ubicacion").value="";

            //LIMPIAR LOS SELCT
            let selectedi=document.getElementById("depto")
            let optionmodaldis=document.createElement("option")
            optionmodaldis.value=""
            optionmodaldis.setAttribute("disabled","")
            optionmodaldis.setAttribute("selected","")
            optionmodaldis.setAttribute("hidden","")
            selectedi.add(optionmodaldis) 
        }


        function goBack(){
            setTimeout(function(){  window.location.href="ver_ubicacion.php";  }, 30);}

    </script>

</body>
</html>