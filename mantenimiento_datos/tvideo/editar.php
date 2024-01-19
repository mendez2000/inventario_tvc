<?php 
include_once '../../config/conexion2.php';

$id=$_GET['id'];
$mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query("SELECT t_video.id_tarjeta_v,marca.nombre_marca,t_video.modelo,t_video.capacidad,marca.id_marca FROM t_video
        LEFT JOIN marca ON t_video.id_marca=marca.id_marca where t_video.id_tarjeta_v='$id';");
        foreach($proof as $row){
          $row["id_tarjeta_v"];
          $row["nombre_marca"];
          $row["modelo"];
          $row["capacidad"];
          $row["id_marca"];
          $id_marca=$row["id_marca"];
          $marca=$row["nombre_marca"];
          $modelo=$row["modelo"];
          $capacidad=$row["capacidad"];
	  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T Video</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
     <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
       <script type="text/javascript" src="../../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">
   <div id="cuerpo" class="col-md-8" >
           <div class="col-md-8 col-md-offset-3" >
           <section class="content-header">
                <h1>
                   TARJETA DE VIDEO
                 
                </h1>
            
            </section>
              <div class="box box-primary">

                <div class="box-header with-border">
                  <h2 class="box-title">Editar Tarjeta de video</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formvideo">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" id="id_video" name="id_video" value="<?php if (isset($row["id_tarjeta_v"])) echo $row["id_tarjeta_v"]; ?>">

                            <label for="marca">Marca</label>
                            <select class="help-block" id="slmarcavideo" name="slmarcavideo" required style="width: 100%">
                                <?php
                                    
                                    $mbd=DB::connect();DB::disconnect();
                                        $proof=$mbd->query("SELECT * FROM marca where id_marca<>'$id_marca';");
                                        while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                                            echo '<option value="'.$row['id_marca'].'"  > '.$row['nombre_marca'].'</option>' ;
                                        }
                                        echo '<option value="'.$id_marca.'" selected="" >  '.$marca.'</option>' ;
                                
                                ?>
                            </select>

                            <label for="modelo"> Modelo</label>
                            <input type="text" value="<?php echo $modelo; ?>" class="form-control input-sm" id="modelo" name="modelo" placeholder="Modelo">

                            <label for="memoria"> Capacidad</label>
                            <input type="text" value="<?php echo $capacidad ; ?>" class="form-control input-sm" id="capacidad" name="capacidad" placeholder="Capacidad">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <div class="box-footer">
                                        <button type="button" id="actualizar" name="actualizar" class="btn btn-success btn-flat"> <span class="fa fa-floppy-o"></span> Guardar Cambios </button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat">   <span class="fa fa-list"></span>
                                            Ver Tarjetas de Video</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>               
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
    <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script> 
        
        $(document).ready(function () {
            $("select").select2();
        });

        $("#actualizar").click(function(){    
                const formvideo=document.getElementById("formvideo")
                var id_video = $("#id_video").val();
                var slmarcavideo = $("#slmarcavideo").val();
                var modelo = $("#modelo").val();
                var capacidad = $("#capacidad").val();
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
                    data:
                    {
                        tarea:"editar",
                        id_video:id_video,
                        slmarcavideo:slmarcavideo,
                        modelo:modelo,
                        capacidad:capacidad
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="actualizado"){
                                let selectmarca=document.getElementById("slmarcavideo")
                                let optionmodaldis=document.createElement("option")
                                optionmodaldis.value=""
                                optionmodaldis.setAttribute("disabled","")
                                optionmodaldis.setAttribute("selected","")
                                optionmodaldis.setAttribute("hidden","")
                                selectmarca.add(optionmodaldis) 

                                document.getElementById("id_video").value="";
                                document.getElementById("modelo").value="";
                                document.getElementById("capacidad").value="";
                                toastr.success("Tarjeta actualizada!")
                            }
                            else if (item=="vacio"){
                            toastr.warning("Faltan campos por rellenar")

                            } else if (item=="existe"){
                            formvideo.reset()
                            toastr.warning("Tarjeta video ya existente!")
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
            setTimeout(function(){  window.location.href="ver_tvideo.php";  }, 30);
        }

                        
    </script>

</body>

</html>

