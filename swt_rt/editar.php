<?php 
    include_once '../config/conexion2.php';
    $id=$_GET['id'];
    $mbd=DB::connect();DB::disconnect();
         $proof=$mbd->query("SELECT * from swt_rt WHERE id_swt_rt='$id'");
      foreach($proof as $row){
		  $row["id_swt_rt"];
		  $row["num_inventario"];
		  $row["nombre_equipo"];
		  $row["id_marca"];
		  $row["port_dispo"];
          $row["cant_puertos"];
		  $row["serial"];
		  $row["modelo"];
		  $row["id_depto"];
		  $row["id_ip"];
		  $row["usuario"];
		  $row["pass"];
		  $row["red"];
		  $row["tipo_equipo"];
		  $row["id_estado"];
		  $row["descripcion"];
		  $row["d_ubicacion"];
	  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SWITCH</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>  
</head>
<body class="login-page">
<div id="cuerpo" class="col-md-12" >
        <section class="content-header">
        <h1>
            Switch/Router
            <small>Añadir Switch/Router</small>
        </h1>
        <ol class="breadcrumb">
            <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a >Switch/Router</a></li>
            <li class="active">Añadir Switch/Router</li>
        </ol>
    </section>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">Editar Switch o Router</h2>
            </div>
            <form role="form">
                <div class="box-body">
                    <input type="hidden" id="id" value="<?php if (isset($id)) echo $id;?>">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="inventario">Numero de Inventario*</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" id="generarInv" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                                    </span>
                                    <input type="text" id="inventario"  value="<?php if (isset($row["num_inventario"])) echo $row["num_inventario"];?>" class="form-control input-sm" placeholder="Numero de Inventario">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="tipo">Tipo Dispositvo</label>
                                <select class=" form-control" id="tipo"  name="tipo" style="width: 100%">
                                    <?php
                                        if($row["tipo_equipo"] == "Switch")
                                        {
                                            echo "<option selected value=".$row["tipo_equipo"]."> Switch</option>";
                                            echo "<option value=Router> Router </option>";
                                        }
                                        else if ($row["tipo_equipo"] == "Router")
                                        {
                                            echo "<option selected value=".$row["tipo_equipo"].">Router</option>";
                                            echo "<option value=Switch> Switch </option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>            
                        
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre del dispositivo</label>
                                <input type="text" class="form-control input-sm" id="nombre" value="<?php if (isset($row["nombre_equipo"])) echo $row["nombre_equipo"];?>" name="nombre" placeholder="Ejem switcher9">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <select class=" form-control help-block" id="marca"  name="marca" style="width: 100%">
                                    <?php
                                    $mbd=DB::connect();DB::disconnect();
                                    $proof1=$mbd->query("SELECT id_marca, nombre_marca FROM marca");

                                    while($row1 = $row1 = $proof1->fetch(PDO::FETCH_ASSOC)){
                                        if($row1["id_marca"] == $row["id_marca"])
                                        {
                                            echo "<option selected value=".$row["id_marca"].">".$row1["nombre_marca"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row1["id_marca"].">".$row1["nombre_marca"]."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control input-sm" id="modelo" value="<?php if (isset($row["modelo"])) echo $row["modelo"];?>" name="modelo" placeholder="Modelo">
                        </div>
                        </div>   
                        
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                            <label for="total_puertos">Puertos Ocupados</label>
                            <input type="number" class="form-control input-sm" id="total_puertos" value="<?php if (isset($row["cant_puertos"])) echo $row["cant_puertos"];?>" name="usuario" placeholder="Puertos Ocupados">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="serie">Serie</label>
                                <input type="text" class="form-control input-sm" id="serie" value="<?php if (isset($row["serial"])) echo $row["serial"];?>" name="serie" placeholder="Serie">
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                            <label for="plibres">Puertos Libres</label>
                            <input type="number" class="form-control input-sm" id="plibres" value="<?php if (isset($row["port_dispo"])) echo $row["port_dispo"];?>" name="plibres" placeholder="Puertos Libres">
                        </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">        
                            <div class="form-group">
                            <label for="red">Red Fisica</label>
                            <input type="number" class="form-control input-sm" id="red" value="<?php if (isset($row["red"])) echo $row["red"];?>" name="red" placeholder="Red Fisica en la que está ejem 10 o 100">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="serie">Usuario (OPCIONAL)</label>
                                <input type="text" class="form-control input-sm" id="usuario" value="<?php if (isset($row["usuario"])) echo $row["usuario"];?>" name="usuario" placeholder="usuario para acceder">
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="modelo">Contraseña (OPCIONAL)</label>
                                <input type="text" class="form-control input-sm" id="pass" value="<?php if (isset($row["pass"])) echo $row["pass"];?>" name="modelo" placeholder="pass para acceder">
                            </div>
                        </div>        
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">        
                            <div class="form-group">
                                <label for="departamento">Ubicacion</label>
                                <select id="departamento" class="form-control input-sm" style="width: 100%">

                                    <?php
                                    $mbd=DB::connect();DB::disconnect();
                                    $proof1=$mbd->query("SELECT * FROM departamento");

                                    while($row1 = $row1 = $proof1->fetch(PDO::FETCH_ASSOC)){
                                        if($row1["id_departamento"] == $row["id_depto"])
                                        {
                                            echo "<option selected value=".$row["id_depto"].">".$row1["departamento"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row1["id_departamento"].">".$row1["departamento"]."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>        

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select id="estado" class="form-control input-sm" style="width: 100%">
                                    <?php
                                    $mbd=DB::connect();DB::disconnect();
                                    $proof1=$mbd->query("SELECT * FROM tipo_estado");

                                    while($row1 = $proof1->fetch(PDO::FETCH_ASSOC)){
                                        if($row1["id_estado"] == $row["id_estado"])
                                        {
                                            echo "<option selected value=".$row["id_estado"].">".$row1["nombre_estado"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row1["id_estado"].">".$row1["nombre_estado"]."</option>";
                                        }
                                    }
                                    ?>
                                
                                </select>
                            </div>
                        </div>        
                    </div>

                    <div class="row">

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="clave">Detalle Ubicacion</label>
                                <input type="text" id="d_ubicacion" name="d_ubicacion" class="form-control input-sm" value="<?php if (isset($row["d_ubicacion"])) echo $row["d_ubicacion"];?>" placeholder="eje Rack CNT...">
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="ip">Dirección Ip</label>
                                <select class="form-control" id="ip"  name="ip" style="width: 100%">
                                    <?php
                                    $mbd=DB::connect();DB::disconnect();
                                    $proof1=$mbd->query("SELECT id_ip, ip FROM ipv4");

                                    while($row1 = $row1 = $proof1->fetch(PDO::FETCH_ASSOC)){

                                        if($row1["id_ip"] == $row["id_ip"])
                                        {
                                            echo "<option selected value=".$row["id_ip"].">".$row1["ip"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row1["id_ip"].">".$row1["ip"]."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>        
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción (OPCIONAL)</label>
                                <textarea  class="form-control" id="descripcion" name="descripcion" placeholder="Describa el Equipo"><?php if (isset($row["descripcion"])) echo $row["descripcion"];?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right">
                                    <button type="button" id="guardar" name="guardar"  class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar Cambios</button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"> <span class="glyphicon glyphicon-list"></span> Ver Switch/Router</a>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
            
            
<script type="text/javascript" src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/toastr.js"></script>
<script src="../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
<script src="../assets/plugins/select2/select2.js" type="text/javascript"></script>           
<script src="../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#inventario").inputmask("99-999-9999");
            $("select").select2();


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
        });

        $("#guardar").click(function()
        {
            var id = $("#id").val();
            var inventario = $("#inventario").val(); //1
            var tipo = $("#tipo").val(); //2 tipo de switch 
            var nombre = $("#nombre").val(); //nombre
            var marca = $("#marca").val(); //marca
            var modelo = $("#modelo").val(); // modelo
            var total_puert = $("#total_puertos").val(); //total de puertos ocupados
            var serie = $("#serie").val(); //serie 
            var plibres = $("#plibres").val(); //puertos libres
            var red = $("#red").val(); //Red fisica
            var usuario = $("#usuario").val();
            var pass = $("#pass").val();
            var depto = $("#departamento").val(); //departamento
            var estado = $("#estado").val(); //estado
            var d_ubicacion = $("#d_ubicacion").val();
            var ip = $("#ip").val();  //ip
            var descri = $("#descripcion").val();//descripcióm


            if(inventario.indexOf('_') != -1) {toastr.error("Numero de Inventario no valido"); return; }

            if( inventario.trim()=='')
            {
                toastr.error("Hay campos que son obligatorios");
                return;
            }

            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                    {
                        tarea:"editar",
                        id:id,
                        inventario:inventario,
                        tipo:tipo,
                        nombre:nombre,
                        marca:marca,
                        modelo:modelo,
                        total_puert:total_puert,
                        serie:serie,
                        plibres:plibres,
                        red:red,
                        usuario:usuario,
                        pass:pass,
                        ip:ip,
                        depto:depto,
                        estado:estado,
                        d_ubicacion:d_ubicacion,
                        descri:descri
                    },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="bien"){

                            toastr.success('Exito','se ha Guardado correctamnete');
                            limpiarcampos();
                        }
                        if (item=="mal"){
                            toastr.error('Error','Ha ocurrido un error');

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
            document.getElementById("tipo").value="";
            document.getElementById("serie").value="";
        }
        function goBack(){ setTimeout(function () { window.location.href = "ver_swt_rt.php"; }, 30); }

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
