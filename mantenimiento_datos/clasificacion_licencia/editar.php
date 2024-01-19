<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();

    //$sql = "SELECT * FROM tipo_accesorio WHERE id_taccesorio='$id'";
         $proof=$mbd->query("SELECT * from clasificacion_licencia WHERE id_clasificacion='$id';");

            foreach($proof as $row){
                $clasificicacion=$row["clasificacion"];
                $tipo=$row["tipo_identificador"];
                $textid="POR ID (se refiere a que la clasificación se estipulará por la llave de la licencia)";
                $textnomenclatura="NOMENCLATURA (se definirá una nomenclatura para la clasificación)";

                if ($tipo == 'NOMENCLATURA') {
                  $tipo1 = 'NOMENCLATURA';
                  $text1=$textnomenclatura;
                  $tipo2 = 'ID';
                  $text2=$textid;
                 
                } else if ($tipo=='ID') {
                  $tipo1 = 'ID';
                  $text1=$textid;
                  $tipo2 = 'NOMENCLATURA';
                  $text2=$textnomenclatura;
                } 
            }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accesorio</title>
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
            <section class="content-header">
                <h1>
                   CLASIFICACION DE LICENCIA
            
                </h1>
           
            </section>
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title">Editar Clasificacion</h2>
                </div>
                    
                    <form role="form">
                        <div class="box-body">
                        <input type="hidden" id="id_clasificacion" name="id_clasificacion" value="<?php echo $id ?>">

                            <div class="row col-md-12 col-lg-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label for="marca"> Clasificación </label>

                                    <input type="text" class="form-control input-md col-md-6 col-sm-7 col-xs-8" value="<?php echo $clasificicacion ?>" id="clasif" name="clasif" placeholder="Dongle... etc">
                                </div>
                            </div>
                            
                            <div class="row col-md-12 col-lg-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label for="tipo"> Tipo de Identificador</label>
                                    <select id="tipo" name="tipo" class="form-control  input-sm  help-block">

                                    <?php
                                        if (isset($tipo)) {
                                        echo '<option value="' .$tipo1. '" selected="" > ' .$text1. '</option>';
                                        echo '<option value="' .$tipo2. '"  >  ' .$text2. '</option>';
                                        } 
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Clasificaciones</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            var id=$("#id_clasificacion").val();
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"editar",
                    clasificacion:clasificacion,
                    tipo:tipo,
                    id:id
                },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {

                    if (item=="actualizado"){
                        toastr.success('Éxito','Actualizado correctamente');
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
                            
        function goBack(){ setTimeout(function(){  window.location.href="ver_clasificaciones.php";  }, 30); }

    </script>
</body>
</html>