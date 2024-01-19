<?php
//include('../config/conexion2.php');
session_start();

if(!isset($_SESSION['tipo'])){
    echo "<script>  window.location.href='../index.php';  </script>";
}

include('../config/conexion2.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ups</title>
     <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
</head>
<body class="login-page">

<!-- AGREGAR SOFTWARE -->
<div class="modal fade" id="modalsoftware" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                AGREGAR NUEVO SOFTWARE
            </div>

            <form id="formsoftware">

                <div id="demo" class="modal-body">
                    <label for="serie"> Producto </label>
                    <input type="text" class="form-control  input-sm  help-block" id="producto" name="producto" placeholder="Ejm office...">

                    <label for="marca">Fabricante</label>
                    <select class="help-block" id="marca" name="marca" required style="width: 100%"><option disabled selected value></option>
                        <?php ComboBoxMarca("SELECT * FROM marca","id_marca","nombre_marca"); ?>
                    </select>

                    
                    <label for="serie"> Edición </label>
                    <input type="text" class="form-control  input-sm  help-block" id="edicion" name="edicion" placeholder="Ejm Vegas Pro...">
                    

                    
                    <label for="serie"> Versión </label>
                    <input type="text" class="form-control  input-sm  help-block" id="version" name="version" placeholder="Ejm 2.0...">
                    

                    <label for="serie"> Categoría </label>
                    <select class="help-block" id="categoria" name="categoria" required style="width: 100%"><option disabled selected value></option>
                        <?php ComboBoxMarca("SELECT * FROM categoria_software;","id_categoria","categoria"); ?>
                    </select> 
                    
                    
                    <label for="obs"> Nota:</label>
                    <textarea class="form-control input-group-sm" id="nota" name="nota" placeholder="Ejemplo: Software especifico para SO de 32..."></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat" id="cerrarsoft" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="addram" name="addram" class="btn btn-success btn-flat">Agregar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- CUERPO DE LA PAGINA -->
   <div id="cuerpo" class="col-md-12" >
       <section class="content-header">
           <h1>LICENCIA</h1>
        
       </section>

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h2 class="box-title">Agregar Nueva</h2>
                    </div>
                        <form role="form" id="formlicencia">
                            <div class="box-body">

                                <div class="row">

                                    <div class="col-12 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="marca">Clasificación</label>
                                                <select class="help-block" id="slclasificacion" name="slclasificacion" required style="width: 100%"><option disabled selected value></option>
                                                    <?php ComboBoxcla("SELECT * FROM clasificacion_licencia","id_clasificacion","clasificacion","tipo_identificador") ?>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="serie"> Id licencia (Por "ID": clave del producto, Por "NOMENCLATURA: (Sotfware,Edicion,Version,idioma) 'W7PROEN' ": asignar de acuerdo a la clasificación)</label>
                                            <input type="text" class="form-control  input-sm  help-block" disabled id="id_licencia" name="id_licencia" placeholder="Por 'ID': clave del producto, Por 'NOMENCLATURA': asignar de acuerdo a la clasificación">
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class=" col-12 col-lg-6 col-md-6">
                                        <div class="form-group">
                                        <label for="serie"> Elija el software correspondiente: </label>
                                        <select class="help-block" id="slsoftware" name="slsoftware" required style="width: 100%"><option disabled selected value></option>                          
                                        <?php ComboBoxsoft("SELECT id_software,producto,marca.nombre_marca,edicion,version_,categoria_software.categoria, nota 
                                            FROM software
                                            left JOIN marca ON marca.id_marca=software.id_marca
                                            LEFT JOIN categoria_software ON categoria_software.id_categoria=software.id_categoria;","id_software","producto","nombre_marca","edicion","version_","categoria","nota") ?><option disabled selected value></option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6">
                                        <button type="button" data-toggle="modal" data-target="#modalsoftware" id="software" name="software" class="btn btn-info btn-block"  style="margin-top: 25px"><i class="fa fa-gears"></i>      Agregar  nuevo  software    <i class="fa fa-plus-circle"></i></button>     
                                    </div>
                                </div>
                     
                                <div class="row">

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-group">
                                        <label for="fecha_compra">Fecha</label>
                                        <input type="number" min="1" max="31"  class="form-control input-sm" id="dia" name="dia" placeholder="Día">
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-grou"> 
                                        <label for="fecha_compra">De</label>                       
                                        <input type="number" min="1" max="12"  class="form-control input-sm" id="mes" name="mes" placeholder="Mes">
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-group">   
                                        <label for="fecha_compra">Compra</label>                                       
                                        <input type="number" min="2000" max="2050"  class="form-control input-sm" id="anio" name="anio" placeholder="Año">
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-group">   
                                        <label for="fecha_compra"></label>                                       
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-group">
                                        <label for="tipodisco"> ¿Renovable? </label>
                                            <select id="slrecurrente" name="slrecurrente" required style="width:100%"><option hidden disabled selected value></option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-group">   
                                        <label for="fecha_compra"></label>                                       
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-2 col-md-2">
                                        <div class="form-group">
                                        <label for="obs"> Duración (meses) </label>
                                        <input type="number" min="1" disabled class="form-control input-sm" id="duracion" name="duracion" placeholder="Número en meses">
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-1 col-md-1">
                                        <div class="form-group">   
                                        <label for="fecha_compra"></label>                                       
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >
                                    </div>
                                    </div>

                                    <div class="col-12 col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="serie"> Cantidad de asientos: </label>
                                            <input type="number" min="1" class="form-control  input-sm  help-block" id="cantidad" name="cantidad" placeholder="Número de asientos" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-lg-12 col-md-12"> 
                                        <div class="form-group">
                                            <label for="Observaciones">Nota (ingresar datos de interes: pag. web,usuario, password etc)</label>
                                            <textarea class="form-control  input-sm" id="nota_lic" name="nota_lic" placeholder="Observaciones"></textarea>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class=" col-122 col-lg-12 col-md-12">
                                        <div clas="form-group">
                                            <div class="btn-group pull-right">
                                                <button type="button" id="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                                                <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>
                                                Buscar Licencias</a>
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
    <script src="controller/controllerlicencia.js"></script>
    <script>

        //MODAL DE SOFTWARE
        const formsoftware=document.getElementById("formsoftware")
        const btncerrar=document.getElementById("cerrarsoft")
        let marca=document.getElementById("marca") //sl de modal
        let categoria=document.getElementById("categoria")//select de modal
        let software=document.getElementById("slsoftware")//select de la pagina principal 


        formsoftware.addEventListener("submit",async function (e){ 
            e.preventDefault()
            const data=new FormData(formsoftware)  
            var tarea="guardado";
            data.append("tarea",tarea);
            const res=await  fetch ("../software/consultas.php",{method: "POST",
                body: data, // data can be `string` or {object}!
                })
            const recibe=await res.json()
            console.log(recibe)
            if (recibe == "guardado")
            {
                console.log(recibe)
                formsoftware.reset()
                toastr.success("Software Guardado")

                    //LIMPIAR EL SELECT
                    let optionmodaldis=document.createElement("option")
                    optionmodaldis.value=""
                    optionmodaldis.setAttribute("disabled","")
                    optionmodaldis.setAttribute("selected","")
                    optionmodaldis.setAttribute("hidden","")
                    marca.add(optionmodaldis) 

                
                    //LIMPIAR EL SELECT TIPO DE DISCO DE PUERTO
                    let optionmodalp=document.createElement("option")
                    optionmodalp.value=""
                    optionmodalp.setAttribute("disabled","")
                    optionmodalp.setAttribute("selected","")
                    optionmodalp.setAttribute("hidden","")
                    categoria.add(optionmodalp) 

            }
            else if (recibe == "vacio")
            {
                toastr.warning("Campo por rellenar!")
            }
            else if (recibe == "existe")
            {
                toastr.warning("Software ya existente!")
                
            }
        })


            //ACTUALIZACION DE DATOS EN EL SELECT DE DE SOFTWARE PRINCIPAL
            btncerrar.addEventListener("click",async function (e){
            e.preventDefault()
            const data=new FormData()
            var tarea="refrescar";
            data.append("tarea",tarea);
            
            const res=await fetch ("../software/consultas.php",{method:"POST",body:(data)})
            const recibe=await res.json()
            console.log(recibe)
            software.innerHTML=""


            //LIMPIAR EL SELECT DE LA PAGINA PRINCIPAL

            let option=document.createElement("option")
            option.value=""
                option.setAttribute("disabled","")
                option.setAttribute("selected","")
                option.setAttribute("hidden","")
                software.add(option)

            //ACTUALIZAR SELECT PRINCIPAL 
            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_software
                option2.text=`Producto: ${item.producto} ,marca:  ${item.nombre_marca} ,edición:  ${item.edicion} ,versión:  ${item.version_ } ,categoría:  ${item.categoria} ,nota:  ${item.nota }`
                software.add(option2)
            })


        })

            function goBack(){
                    setTimeout(function(){  window.location.href="ver_licencias.php";  }, 30);
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

function ComboBoxcla($consul, $id, $nombre, $apellido)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$id"]."'>";

        echo "Clasificación: ".$row["$nombre"]." ,Se identifica por: ".$row["$apellido"];
        echo "</option>";

    }

}

function ComboBoxsoft($consul, $id, $producto, $marca, $edicion,$version_, $categoria,$nota)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$id"]."'>";
        echo "Producto: ".$row["$producto"]." ,marca: ".$row["$marca"]." ,edición: ".$row["$edicion"]." ,versión: ".$row["$version_"]." ,categoría: ".$row["$categoria"]."  ".$row["$nota"];
        echo "</option>";

    }

}
?>

</html>