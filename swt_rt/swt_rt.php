<?php  include('../config/conexion2.php'); ?>
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
           <h1>Switch/Router</h1>
         
       </section>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">Agregar Nuevo</h2>
        </div>
        <form role="form" id=formswrt>
            <div class="box-body">
                <div class="row ">
                    <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group ">
                                <label for="inventario">Numero de Inventario*</label>
                                <div class="input-group  ">
                                    <span class="input-group-btn">
                                        <button type="button" id="generarInv" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                                    </span>
                                    <input type="text" id="inventario"  class="form-control input-sm" placeholder="Numero de Inventario">
                                </div>
                            </div>
                        </div>  
                    
                    <div class="col-12 col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="tipo">Tipo Dispositvo</label>
                            <select id="tipo" class="form-control input-sm help-block" style="width: 100%">
                                <option value="Switch">Switch</option>
                                <option value="Router">Router</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombre del dispositivo</label>             
                                <input type="text" class="form-control input-sm " id="nombre" name="nombre" placeholder="Ejem switcher">
                        </div>
                    </div>
                </div>

                <div class="row">
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                    <select class="select2 form-control help-block" id="marca" name="marca" style="width: 100%" >
                                        <?php cargacombo("SELECT * FROM marca","id_marca","nombre_marca") ?>
                                    </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-control input-sm" id="modelo" name="modelo" placeholder="Modelo">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                            <label for="total_puertos">Puertos Ocupados</label>
                            <input type="number" class="form-control input-sm" id="total_puertos" name="total_puertos" placeholder="Puertos Ocupados">
                        </div>
                        </div>
                </div>

                <div class="row">
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="serie">Serie</label>
                                <input type="text" class="form-control input-sm help-block" id="serie" name="serie" placeholder="Serie">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="plibres">Puertos Libres</label>
                                <input type="number" class="form-control input-sm help-block" id="plibres" name="plibres" placeholder="Puertos Libres">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="red">Red Fisica</label>
                                <input type="number" class="form-control input-sm help-block" id="red" name="red" placeholder="Red Fisica en la que está">
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="Usuario">Usuario (OPCIONAL)</label>
                            <input type="text" class="form-control input-sm help-block" id="usuario" name="usuario" placeholder="usuario para acceder">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="pass">Contraseña (OPCIONAL)</label>
                            <input type="text" class="form-control input-sm help-block" id="pass" name="pass" placeholder="pass para acceder">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label style="width: inherit" for="depto">Departamento</label>
                            <select id="depto" name="depto" class="form-control input-sm help-block" style="width:100%">
                                <?php cargacombo("SELECT * FROM departamento", "id_departamento", "departamento");?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control input-sm help-block" style="width:100%">
                            <?php cargacombo("SELECT * FROM tipo_estado", "id_estado", "nombre_estado");?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="d_ubicacion">Detalle Ubicacion</label>
                                <input type="text" id="d_ubicacion" name="d_ubicacion" class="form-control input-sm help-block" placeholder="eje Rack de CNT...">
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="ip">Dirección Ip</label>
                                <select id="ip" name="ip" class="form-control input-sm help-block" style="width: 100%">
                                    <?php cargacombo("SELECT ipv4.id_ip,ipv4.ip from ipv4 where not exists (select swt_rt.id_ip from swt_rt where swt_rt.id_ip=ipv4.id_ip);","id_ip","ip");?>
                                </select>
                            </div>
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción (OPCIONAL)</label>
                            <textarea  class="form-control" id="descripcion" name="descripcion" placeholder="Describa el Equipo"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <div class="btn-group pull-right"> 
                                <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                                <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Switch/Router</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </form>
    </div> 
</div>          

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
        
        $("#guardar").click(function(){
                const formlswrt=document.getElementById("formswrt")
                let selecttipo=document.getElementById("tipo")
                let selectmarca=document.getElementById("marca")
                let selectdepto=document.getElementById("depto")
                let selectestado=document.getElementById("estado")
                let selectip=document.getElementById("ip")
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
                var depto = $("#depto").val(); //departamento
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
                        tarea:"guardar",
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
                                formlswrt.reset()
                                let option=document.createElement("option")
                                option.value=""
                                option.setAttribute("disabled","")
                                option.setAttribute("selected","")
                                option.setAttribute("hidden","")
                                selecttipo.add(option)
                                selectmarca.add(option)
                                selectdepto.add(option)
                                selectestado.add(option)
                                selectip.add(option)
                                toastr.success('Exito','Se ha Guardado correctamnete');
                            
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
                document.getElementById("nombre").value="";
                document.getElementById("total_puert").value="";
                document.getElementById("serie").value="";
                document.getElementById("plibres").value="";
                document.getElementById("red").value=""; 
                document.getElementById("usuario").value="";
                document.getElementById("pass").value="";
                document.getElementById("depto").value=""; 
                document.getElementById("estado").value=""; 
                document.getElementById("d_ubicacion").value="";
                document.getElementById("descri").value="";

                let selectmarca=document.getElementById("marca")
                let selecttipo=document.getElementById("tipo")
                    let optionmodaldis=document.createElement("option")
                    optionmodaldis.value=""
                    optionmodaldis.setAttribute("disabled","")
                    optionmodaldis.setAttribute("selected","")
                    optionmodaldis.setAttribute("hidden","")
                    selectmarca.add(optionmodaldis)
                    selecttipo.add(optionmodaldis)  
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
        echo "<option value='".$row["$id"]."'>";

        echo $row[$nombre];
        echo "</option>";

    }
}

?>
</html>