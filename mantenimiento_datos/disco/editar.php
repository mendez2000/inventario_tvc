<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query("SELECT * from disco where id_disco='$id';");
         
        foreach($proof as $row){
          $row["id_disco"];
          $row["tipo_disco"];
          $row["tipo_puerto"];
          $row["capacidad"];
         
          $id=$row["id_disco"];
          $tipo=$row["tipo_disco"];
          $puerto=$row["tipo_puerto"];
          $capacidad=$row["capacidad"];

          if ($tipo == 'HDD') {
            $tipo1 = 'HDD';
            $tipo2 = 'SSD';
            $tipo3 = 'Flash';
          } else if ($tipo=='SSD') {
            $tipo1 = 'SSD';
            $tipo2 = 'HDD';
            $tipo3 = 'Flash';
          } else if ($tipo=='Flash') {
            $tipo1 = 'Flash';
            $tipo2 = 'SSD';
            $tipo3 = 'HDD';
          }

          if ($puerto == 'Sata') {
            $puerto1= 'Sata';
            $puerto2 = 'M2';
            $puerto3 = 'IDE';
          } else if ($puerto=='M.2') {
            $puerto1 = 'M2';
            $puerto2 = 'Sata';
            $puerto3 = 'IDE';
          } else if ($puerto=='IDE') {
            $puerto1 = 'IDE';
            $puerto2 = 'Sata';
            $puerto3 = 'M2';
          }
	  }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DISCO</title>
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
        <div class="col-md-8 col-md-offset-3">
            <section class="content-header">
                <h1>
                    Alamacenamiento
                   
                </h1>
              
            </section>
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title">Editar Unidad</h2>
                </div>

                <form id="formdisco" role="form">

                    <div class="box-body">
                    <input type="hidden" id="id_disco" name="id_disco" value="<?php if (isset($row["id_disco"])) echo $row["id_disco"]; ?>">

                    <div class="form-group">
                            <label for="tipodisco">Tipo de Unidad</label>
                            <select id="sltipod" name="sltipod" required style="width:100%">
                            
                            <?php
                            if (isset($tipo)) {
                            echo '<option value="' .$tipo1. '" selected="" > ' .$tipo1. '</option>';
                            echo '<option value="' .$tipo2. '"  >  ' .$tipo2. '</option>';
                            echo '<option value="' .$tipo3. '"  >  ' .$tipo3. '</option>';
                            } else {
                            }
                            ?>
                            </select>

                            <label for="tipodisco">Tipo de Puerto</label>
                            <select id="sltipop" name="sltipop" required style="width:100%">
                            <?php
                            if (isset($puerto)) {
                            echo '<option value="' .$puerto1. '" selected="" > ' .$puerto1. '</option>';
                            echo '<option value="' .$puerto2. '"  >  ' .$puerto2. '</option>';
                            echo '<option value="' .$puerto3. '"  >  ' .$puerto3. '</option>';
                            } else {
                            }
                            ?>
                            </select>


                            <label for="capacidad">Capacidad</label>
                            <input type="text" id="capacidad" name="capacidad" value="<?php echo $capacidad; ?>" autocomplete="on"  class="input-sm form-control" placeholder="128 GB etc...">
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="actualizar" name="actualizar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Unidades</a>
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


        $("#actualizar").click(function(){
            const formdisco=document.getElementById("formdisco")
            var sltipod= $("#sltipod").val();
            var sltipop= $("#sltipop").val();
            var capacidad= $("#capacidad").val();
            var id_disco= $("#id_disco").val();
        $.ajax({
        type:"POST",
        url:"consultas.php",
        data:
        {
            tarea:"editar",
            sltipod:sltipod,
            sltipop:sltipop,
            capacidad:capacidad,
            id_disco:id_disco
            
        },
        success: function(data)
        {
            data=data.split("|");
            $.each(data, function(i, item) {

                if (item=="actualizado"){
                    formdisco.reset()
                    capacidad.value=""
                    //LIMPIAR EL SELECT TIPO DE DISCO DE LA MODAL
                    let selectmodalt=document.getElementById("sltipod")
                    let optionmodaldis=document.createElement("option")
                    optionmodaldis.value=""
                    optionmodaldis.setAttribute("disabled","")
                    optionmodaldis.setAttribute("selected","")
                    optionmodaldis.setAttribute("hidden","")
                    selectmodalt.add(optionmodaldis) 

                    
                        //LIMPIAR EL SELECT TIPO DE DISCO DE PUERTO
                    let selectmodalp=document.getElementById("sltipop")
                    let optionmodalp=document.createElement("option")
                    optionmodalp.value=""
                    optionmodalp.setAttribute("disabled","")
                    optionmodalp.setAttribute("selected","")
                    optionmodalp.setAttribute("hidden","")
                    selectmodalp.add(optionmodalp) 
                    toastr.success("Unidad actualizada!")
                }
                else if (item=="existe")
                {
                    toastr.error("Unidad ya existente!")

                }
                else if (item=="vacio")
                {
                    toastr.warning("Campos por rellenar")
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
    

        function goBack(){
        setTimeout(function(){  window.location.href="verdisco.php";  }, 30);
        }
    </script>
</body>
</html>
