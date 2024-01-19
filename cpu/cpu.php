<?php
include('../config/conexion2.php');
session_start();

if(!isset($_SESSION['tipo'])){
 echo "<script>  window.location.href='../index.php';  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREAR CPU</title> 
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/dist/css/AdminLTE.min.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-daterangepicker-master/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/custombox.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/toastr.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/datatables/jquery.dataTables.min.css">
    <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
</head>
<body class="login-page">

    <!-- Modal para NUEVA MARCA-->
    <div class="modal fade" id="modalmarca" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVA MARCA
                </div>

                <form id="formmarca"   >
                    <div id="demo" class="modal-body">
                        <label for="marca">Nombre de la nueva marca</label>
                        <input type="text" class="form-control input-sm  help-block" id="nombre_marca" name="nombre_marca" required placeholder="Nombre de la nueva marca">
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrarmar" name="cerrarmar" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addmarca" name="addmarca" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVO UPS-->
    <div class="modal fade" id="modalups" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVO UPS
                </div>

                <form id="formups">
                    <div id="demo" class="modal-body">
                    
                        <label for="inventarioups">Numero de inventario*</label>
                        <div class="input-group  ">
                            <input type="text" id="inventarioups" name="inventarioups" class="form-control input-sm" placeholder="Numero de Inventario">
                            <span class="input-group-btn">
                                <button type="button" id="generarInvups" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                            </span>
                        </div>

                        <label for="modeloups">Modelo</label>
                        <input type="text"  name="modeloups" id="modeloups" autocomplete="on"  class="input-sm form-control" placeholder="Core i3,Ryzen etc"><br>

                        <label for="marcaups">Marca</label>
                        <select class=" help-block" id="marcaups" name="marcaups" required style="width: 100%" ><option hidden disabled selected value></option>
                            <?php cargaComboBox("SELECT * FROM marca","id_marca","nombre_marca") ?>
                        </select>

                        <label for="capacidadups">Capacidad</label>
                        <input type="text" name="capacidadups" id="capacidadups" autocomplete="on"  class="input-sm form-control" placeholder="Capacidad"><br>

                        <label for="fecha_compra_ups">Fecha Compra</label>
                        <input type="text" class="form-control input-sm" id="fecha_compra_ups" name="fecha_compra_ups" placeholder="Fecha de compra">

                        <label for="observacionups">Observación</label>
                        <input type="text" name="observacionups" id="observacionups" autocomplete="on"  class="input-sm form-control" placeholder="Ejemplo Buen estado"><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrarups" name="cerrarups" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addups" name="addups" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVO Monitor-->
    <div class="modal fade" id="modalmonitor" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVO MONITOR
                </div>

                <form id="formmon">
                    <div id="demo" class="modal-body">
                    
                        <label for="inventariomon">Numero de inventario</label>
                        <div class="input-group  ">
                            <input type="text" id="inventariomon" name="inventariomon" class="form-control input-sm" placeholder="Numero de Inventario">
                            <span class="input-group-btn">
                                <button type="button" id="generarInvmon" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                            </span>
                        </div>

                        <label for="seriemon">Serie</label>
                        <input type="text"  name="seriemon" id="seriemon" autocomplete="on"  class="input-sm form-control" placeholder="Core i3,Ryzen etc"><br>

                        <label for="tamañomon">Tamaño</label>
                        <input type="text" name="tamañomon" id="tamañomon" autocomplete="on"  class="input-sm form-control" placeholder="Marca"><br>
                            
                        <label for="fecha_compra_mon">Fecha Compra</label>
                        <input type="text" class="form-control input-sm" id="fecha_compra_mon" name="fecha_compra_mon" placeholder="Fecha de compra">

                        <label for="marcamon">Marca</label>
                        <select class=" help-block" id="marcamon" name="marcamon" required style="width: 100%" ><option hidden disabled selected value></option>
                            <?php cargaComboBox("SELECT * FROM marca","id_marca","nombre_marca") ?>
                        </select>

                        <label for="modelomon">Modelo</label>
                        <input type="text" name="modelomon" id="modelomon" autocomplete="on"  class="input-sm form-control" placeholder="Modelo"><br>
                        
                        <label for="tipomon">Tipo Monitor</label>
                        <select id="tipomon" name="tipomon" class="form-control  help-block" required style="width: 100%">
                            <option disabled selected value></option>
                            <option value="LCD">LCD</option>
                            <option value="LED">LED</option>
                        </select>
                           
                        <label for="observacionmon">Observación</label>
                        <input type="text" name="observacionmon" id="observacionmon" autocomplete="on"  class="input-sm form-control" placeholder="Ejemplo Buen estado"><br>
                    </div>         

                    <div class="modal-footer">
                        <button type="button" id="cerrarmon" name="cerrarmon" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addmon" name="addmon" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVA CLASIFICACION-->
    <div class="modal fade" id="modalclasificacion" data-backdrop="static"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    AGREGAR NUEVA CLASIFICACION DE EQUIPO
                </div>
                <form id="formclasificacion">
                    <div id="demo" class="modal-body">
                        <label for="clas">Nombre de la nueva clasificación</label>
                        <input type="text" class="form-control input-sm  help-block" id="nombre_clasificacion" name="nombre_clasificacion" required placeholder="Nombre de la nueva clasificacion">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cerrarclas" name="cerrarclas" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addclasss" name="addclasss" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVO ESTADO-->
    <div class="modal fade" id="modalestado" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVO ESTADO DEL EQUIPO
                </div>

                <form id="formestado">
                    <div id="demo" class="modal-body">
                        <label for="est">Nombre del nuevo estado</label>
                        <input type="text" class="form-control input-sm  help-block" id="nombre_est" name="nombre_est" required placeholder="Nombre del nuevo estado">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cerrarest" name="cerrarest" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addest" name="addest" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVO PROCESADOR-->
    <div class="modal fade" id="modalprocesador" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVO PROCESADOR
                </div>

                <form id="formprocesador">
                    <div id="demo" class="modal-body">
                        <label for="fabricantepro">Fabricante</label>
                        <!-- <input type="text" name="fabricantepro"   id="fabricantepro" autocomplete="on"  class="input-sm form-control" required placeholder="Intel,Amd etc"><br> -->
                    
                        <select class="help-block" id="fabricantepro" name="fabricantepro" required style="width: 100%">
                                <?php ComboBoxMarca("SELECT * FROM marca","id_marca","nombre_marca"); ?><option disabled selected value></option>
                        </select>

                        <label for="modelopro">Modelo</label>
                        <input type="text"  name="modelopro" id="modelopro" autocomplete="on"  class="input-sm form-control" placeholder="Core i3,Ryzen etc"><br>

                        <label for="generacionpro">Generación</label>
                        <input type="text" name="generacionpro" id="generacionpro" autocomplete="on"  class="input-sm form-control" placeholder="5600, 6800 etc"><br>

                        <label for="velocidadpro">Velocidad</label>
                        <input type="text" name="velocidadpro" id="velocidadpro" autocomplete="on"  class="input-sm form-control" placeholder="3.10 Gz etc"><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrarpro" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addprocesador" name="addprocesador"  class="btn btn-success btn-flat">Agregar</button>
                    </div>
            
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVA RAM-->
    <div class="modal fade" id="modalram" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVA RAM
                </div>

                <form id="formram">
                    <div id="demo" class="modal-body">
                        <label for="tipoRam">Tipo de RAM</label>
                        <select class=" help-block" id="sltiporamm" name="sltiporamm" required style="width: 100%" ><option hidden disabled selected value></option>
                           <?php cargaComboBox("SELECT * FROM tipo_ram","id_tipo_ram","tipo_ram") ?>
                        </select>
                        
                        <label for="capacidadRam">Capacidad</label>
                        <input type="text" id="capacidadmarc" name="capacidadmarc" autocomplete="on"  class="input-sm form-control" placeholder="Total de almacenamiento"><br>

                        <label for="numModulos">Frecuencia</label>
                        <input type="text" id="frecuenciamarc" name="frecuenciamarc" autocomplete="on"  class="input-sm form-control" placeholder="Ejem 400MHz"><br>

                        <label for="Observaciones">Observaciones: </label>
                        <textarea class="form-control  input-sm" id="observacionesmarc" name="observacionesmarc" placeholder="Descripción..."></textarea>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-flat" id="cerrarram" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addram" name="addram" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVA TARJETA DE VIDEO-->
    <div class="modal fade" id="modaltarjeta" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVA TARJETA DE VIDEO
                </div>

                <form id="formvideo">
                    <div id="demo" class="modal-body">          
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <select id="slmarcavideotv" name="slmarcavideotv" required style="width: 100%" ><option hidden disabled selected value></option>
                            <?php cargaComboBox("SELECT * FROM marca","id_marca","nombre_marca") ?>
                            </select>
                        </div>

                        <label for="capacidad">Modelo</label>
                        <input type="text" name="modelotv" id="modelotv" autocomplete="on"  class="input-sm form-control" placeholder="ejemplo: Quadro NVS 295"><br>

                        <label for="numModulos">capacidad</label>
                        <input type="text" min=0 id="capacidadtv" name="capacidadtv" autocomplete="on" class="input-sm form-control" placeholder="2, 4 etc">
                    </div>

                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-flat" name="cerrartarj" id="cerrartarj" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="addtvi" name="addtvi"  class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para NUEVA UNIDAD DE DISCO-->
    <div class="modal fade" id="modaldisco" data-backdrop="static"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    AGREGAR NUEVA UNIDAD
                </div>

                <form id="formdisco">
                    <div id="demo" class="modal-body">
                        <div class="form-group">
                                <label for="tipodisco"> Tipo de Unidad </label>
                                    <select id="sltipod" name="sltipod" required style="width:100%">
                                    <option hidden disabled selected value></option>
                                        <option value="HDD">HDD</option>
                                        <option value="SSD">SSD</option>
                                        <option  value="Flash">Flash</option>
                                    </select>

                                <label for="tipodisco"> Tipo de Puerto </label>
                                    <select id="sltipop" name="sltipop" required style="width:100%">
                                    <option hidden disabled selected value></option>
                                        <option value="Sata">Sata</option>
                                        <option value="M.2">M.2</option>
                                        <option  value="IDE">IDE</option>
                                    </select>

                                <label for="capacidadd">Capacidad</label>
                                <input type="text" id="capacidadd" name="capacidadd" autocomplete="on"  class="input-sm form-control" placeholder="128 GB etc...">
                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-flat" name="cerrardisco" id="cerrardisco" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="adddisc" name="adddisc" class="btn btn-success btn-flat">Agregar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para AGREGAR ACCESORIOS AL EQUIPO (UNO O VARIOS)-->
    <div class="modal fade" id="modalaccesorio" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    AGREGAR ACCESORIOS
                </div>

                <form id="formaccesorio" class="form-inline">
                    <div id="demo" class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="monitor">CPU:</label>
                                        <!-- AGREGAR NUM INV -->
                                        <input type="text" disabled class="form-control input-sm help-block" name="cpu_actual" id="cpu_actual">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >   
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group" style="padding-top: 5px;">
                                        <label  for="ip" > Accesorios disponibles: </label>
                                        <select  id="slnum_inv" class="form-control help-block" name="slnum_inv" required style="width: 100%"><option hidden disabled selected value></option>
                                            <?php ComboBoxinventario("SELECT id_accesorio,num_inv_acc from accesorio where not exists (select num_inv_acc from detalle_cpu_accesorio where detalle_cpu_accesorio.num_inv_accesorio = accesorio.num_inv_acc);","id_accesorio","num_inv_acc")?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="box-title"><strong> Datos del accesorio: </strong></h4>
                            </div>  
                        
                            <!-- Datos del accesorio 1 -->
                            
                            <div class="row">
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="fabricante">Número de Inventario</label>
                                        <input type="text" disabled class="form-control input-sm  help-block" id="txtnum" name="txtnum" placeholder="" >
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="fabricante">Tipo de accesorio:</label>
                                        <input type="text" disabled class="form-control input-sm  help-block" id="tipo" name="tipo" placeholder="Tipo..." >
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="fabricante">Modelo:</label>
                                        <input type="text" disabled class="form-control input-sm  help-block" id="modelo_acce" name="modelo_acce" placeholder="Modelo...">
                                    </div>
                                </div>
                            </div>

                            
                            
                            <div class="row">
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Serie: </label>
                                        <input type="text" disabled class="form-control input-sm help-block" id="serieacc" name="serieacc" placeholder="Serie...">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Marca: </label>
                                        <input type="text" disabled class="form-control input-sm help-block" id="marcaacc" name="marcaacc" placeholder="Marca...">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_compra">fecha Compra:</label>
                                        <input type="text" disabled class="form-control input-sm" id="fecha_compra_acc" name="fecha_compra_acc" placeholder="Fecha de compra..">
                                    </div>    
                                </div>
                            </div>
                            

                            <!-- AGREGAR LOS DATOS AL DATA TABLE -->

                            <div class="row">
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >   
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <button type="button" id="agregaraccesorio" name="agregaraccesorio" class="btn btn-success btn-flat btn-block" ><i class="fa fa-hand-o-down"></i> Agregar accesorio</button>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >   
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <!-- ESPACIO EN BLANCO -->
                                <div class="col-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input class="form-control input-sm" type="hidden" id="00" name="00" >   
                                    </div>
                                </div>
                            </div>
                            <h4 class="box-title"><strong>  Accesorios  Agregados :  </strong></h4>
                            <!-- DATATABLE -->
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <table id="veraccesorios"  style="width:100%"  cellspacing="0" >
                                        <thead>
                                            <tr>
                                                <th data-field="Marca" style="padding-left: 5px; padding-right: 7px;">N°Inv</th>
                                                <th data-field="tipo" style="padding-left: 5px; padding-right: 7px;">Tipo</th>
                                                <th data-field="Ver" style="padding-left: 5px; padding-right: 7px;">Modelo</th>
                                                <th data-field="Editar" style="padding-left: 5px; padding-right: 7px;">Marca</th>
                                                <th data-field="Editar" style="padding-left: 5px; padding-right: 7px;">Quitar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datos">
                                        </tbody> 
                                    </table>
                                </div> 
                            </div>

                            <div class="modal-footer">
                                <button type="button" id="cerraracc" name="cerraracc" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para DIRECCIÓN IP-->
    <div class="modal fade" id="modalip" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    AGREGAR NUEVA DIRECCIÓN IP
                </div>

                <form id="formip">
                    <div id="demo" class="modal-body">
                        <label for="marca">Dirección IP:</label>
                        <input type="text" class="form-control input-sm  help-block" id="ipv4" name="ipv4" required placeholder="ip">
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrarip" name="cerrarip" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="addip" name="addip" class="btn btn-success btn-flat">Agregar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>                      

    <!-- MODAL PARA AGREGAR SOFTWARE -->
    <div class="modal fade" id="modalsoftware" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    AGREGAR SOFTWARE
                </div>

                <form id="formaccesorio">
                    <div id="demo" class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class=" control-label ">Inventario CPU:</label>
                                    <input type="text" disabled   class="form-control" id="cpu_software" name="cpu_software" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label  for="ip" > Software disponible: </label>
                                    <select  id="sl_software_cpu" class="help-block" name="sl_software_cpu" required style="width: 100%"><option hidden disabled selected value> </option>
                                        <?php ComboBoxlicencia("SELECT software.id_software,producto,marca.nombre_marca,edicion,version_,categoria_software.categoria,software.nota FROM `software` LEFT join marca ON marca.id_marca=software.id_marca LEFT join categoria_software ON categoria_software.id_categoria=software.id_categoria INNER JOIN licencia ON software.id_software=licencia.id_software WHERE licencia.disponibilidad>0;","id_software","producto","nombre_marca","edicion","version_","categoria","nota")?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <label for="Observaciones">Información de la licencia</label>
                                <textarea class="form-control  input-sm" id="nota_lic" disabled name="nota_lic" placeholder="Observaciones"></textarea>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div>
                                    <h4 class="box-title"><strong> Software Agregado: </strong></h4>
                                </div>  
                            </div>
                        </div>
                        <!-- DATATABLE -->
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12"> <!-- Note that "m8 l9" was added -->
                                <table id="versoftware"  style="width:100%"  cellspacing="0" >
                                    <thead>
                                    <tr>
                                        <th data-field="Marca" style="padding-left: 5px; padding-right: 7px;">Num</th>
                                        <th data-field="Marca" style="padding-left: 5px; padding-right: 7px;">Prod.</th>
                                        <th data-field="tipo" style="padding-left: 5px; padding-right: 7px;">Marca</th>
                                        <th data-field="Ver" style="padding-left: 5px; padding-right: 7px;">Edición</th>
                                        <th data-field="Editar" style="padding-left: 5px; padding-right: 7px;">Ver.</th>
                                        <th data-field="Editar" style="padding-left: 5px; padding-right: 7px;">Categoría</th>
                                        <th data-field="Editar" style="padding-left: 5px; padding-right: 7px;">Quitar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" id="cerraracc" name="cerraracc" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>        
                </form>
            </div>
        </div>
    </div>

    <!-- CUERPO DE LA PAGINA -->
    <div id="cuerpo" class="col-md-12">
        <section class="content-header">
        <h1>CPU</h1>
       
        
       </section>
        <div class="box box-primary">
            <div class="box-header with-border">
                  <h2 class="box-title">Agregar Nuevo</h2>
            </div>
            <div align="center">
                <h3 class="box-title"><strong>Datos del equipo</strong></h3>
            </div>

            <!-- form start -->
            <form>
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 col-lg-2 col-md-2">
                            <input type="hidden" id="id_user" value="<?php if (isset($_SESSION['user_session'])) echo $_SESSION['user_session']; ?>">
                            <div class="form-group">
                                <label for="inventario">Num.Inventario*</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" id="generarInv" class="btn btn-info input-sm btn-flat"><i class="fa fa-download"></i></button>
                                    </span>
                                    <input type="text" id="inventario" name="inventario" class="form-control input-sm" onkeyup="PasarValor();" required style="width: 100%" placeholder="Numero de Inventario">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Marca</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalmarca" class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select class="select2  help-block" id="slmarca" name="slmarca" required style="width: 100%"  ><option hidden disabled selected value></option>
                                        <?php cargaComboBox("SELECT * FROM marca","id_marca","nombre_marca") ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label for="modelo"> Modelo</label>
                                <input type="text" class="form-control input-sm " id="modelocpu" name="modelocpu"  required style="width: 100%" required placeholder="Modelo">
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="clasificacion">Clasificación de Equipo</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalclasificacion" class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select class=" help-block" id="slclasificacion" name="slclasificacion" required style="width: 100%"  ><option hidden disabled selected value></option>
                                        <?php ComboBoxclasificacion("SELECT * FROM clasificacion","id_clasificacion_cpu","nombre_clasif") ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label>Service TAG</label>
                                <input type="text" class="form-control input-sm" id="servT" name="servT" required placeholder="Service Tag">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Garantia del equipo</label>
                                <input type="text" class="form-control input-sm" id="garantia" name="garantia" required placeholder="Garantia">
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Estado del equipo</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalestado" class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select class=" help-block input-sm form-control " id="slestado" name="slestado" required style="width: 100%"><option hidden disabled selected value></option>
                                        <?php cargaComboBox("SELECT * FROM tipo_estado","id_estado","nombre_estado") ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label> Operador</label>
                                <select class=" help-block" id="slusuariope" name="slusuariope" required style="width: 100%"  ><option hidden disabled selected value></option>
                                    <?php cargaoperador("SELECT * FROM empleados","id_empleado","nombre","apellido") ?>
                                </select>                                    
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label> Nombre de Equipo</label>
                                <input type="text" class="form-control input-sm" id="nombre_cpu" name="nombre_cpu" required placeholder="Nombre de equipo">
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label> Usuario del S.O</label>
                                <input type="text" class="form-control input-sm" id="usu_cpu" name="usu_cpu" required placeholder="Usuario del sistema operativo">
                            </div>
                        </div>
                    </div>

                    <!-- Datos de HARDWARE -->
                    <div class="row">
                         <div class="text-center">
                            <h3 class="box-title"><b>Hardware</b></h3>
                        </div> 
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="procesador">Procesador</label>
                                <div class="input-group" >
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalprocesador" class="btn btn-info input-sm btn-flat  "><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select class=" form-control "  id="slprocesador" name="slprocesador" required style="width: 100%" ><option hidden disabled selected value></option>
                                        <?php ComboBoxpro("SELECT * FROM procesador","id_procesador","fabricante","modelo","generacion","velocidad") ?>
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="col-10 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="ram">Ram</label>
                                <div class="input-group" >
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalram" class="btn btn-info  input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select class="select2 form-control " id="slram" name="slram" ><option disabled selected value></option>  
                                        <?php ComboBoxRam("SELECT id_ram, tipo_ram.tipo_ram, capacidad, frecuencia, observaciones from ram LEFT join tipo_ram on tipo_ram.id_tipo_ram=ram.id_tipo_ram;","id_ram","tipo_ram","capacidad","frecuencia","observaciones") ?>
                                    </select>   
                                </div>
                            </div> 
                        </div>
                        <div class=" col-12 col-lg-3 col-md-3 col-sm-3">
                               
                                <label for="tvideo">Tarjeta Video</label>
                                <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-btn">       
                                            <button type="button" data-toggle="modal" data-target="#modaltarjeta"  class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                        </span>
                                        <select class="form-control select2 " id="slvideo" name="slvideo"><option hidden disabled selected value></option>
                                            <?php ComboBoxtarjeta("SELECT id_tarjeta_v,marca.nombre_marca,modelo,capacidad FROM t_video left join marca ON marca.id_marca=t_video.id_marca;","id_tarjeta_v","modelo","capacidad","nombre_marca") ?>
                                        </select> 
                                        </div>
                                </div>   
                        </div>
                        
                        <div class="col-12 col-lg-3 col-md-3 col-ls-2">
                            <div class="form-group">      
                                <label  for="ups">Ups asignada</label>
                                <div class="input-group ">
                                    <span class="input-group-btn"> 
                                        <button type="button" data-toggle="modal" data-target="#modalups" class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span >
                                    <select class=" form-control input-md" id="slups" name="slups" required ><option hidden disabled selected value></option>
                                        <?php ComboBoxUps("SELECT * from ups where not exists (select id_ups from cpu where cpu.id_ups=ups.id_ups);","id_ups","num_inventario","modelo") ?>
                                    </select>
                                </div>
                            </div>
                        
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group ">
                                <label for="procesador">Disco</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modaldisco" class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select id="sldisco" name="sldisco" class=" select2 form-control  help-block"  id="empleados" name="empleados" required multiple="multiple">
                                        <?php ComboBoxdisco("SELECT * FROM disco","id_disco","tipo_disco","tipo_puerto","capacidad") ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="monitor">Monitor</label>
                                <div class="input-group">
                                <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalmonitor" class="btn btn-info input-sm btn-flat "><i class="fa fa-plus"></i></button>
                                    </span>

                                    <select class="select2 form-control help-block input-sm" id="monitor" name="monitor"  multiple="multiple">
                                   
                                        <?php ComboBoxmonitor("SELECT monitor.id_monitor,monitor.num_inventario,marca.nombre_marca,monitor.tamano,monitor.tipo_monitor,monitor.fecha_compra from monitor left JOIN marca ON monitor.id_marca=marca.id_marca where not exists (select id_monitor from detalle_cpu_monitor where detalle_cpu_monitor.id_monitor=monitor.id_monitor);","id_monitor","num_inventario","nombre_marca","tamano","tipo_monitor","fecha_compra") ?>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-4">
                            <button style="margin-top:25px" type="button" data-toggle="modal"  data-target="#modalaccesorio" id="agregaraccesorio2" name="agregaraccesorio2" class="btn btn-warning input-sm btn-flat btn-block pt-5"><i class="fa fa-headphones"></i>  A g r e g a r   A c c e s o r i o  <i class="fa fa-keyboard-o"></i></button>
                        </div>
                    </div>

                    <!-- Datos de SOFTWARE -->
                    <div class="row">
                        <div class="text-center">
                            <h3 class="box-title"><b>Software</b></h3>
                        </div>
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label  for="ip"  class="control-label">IP del Equipo</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#modalip" class="btn btn-info input-sm btn-flat " ><i class="fa fa-plus"></i></button>
                                    </span>
                                    <select class=" select2  help-block" id="sl_ip" name="sl_ip" required multiple="multiple" style="width: 100%">
                                        <?php cargaComboBox("SELECT * from ipv4 where not exists (select id_ip from detalle_cpu_ip where detalle_cpu_ip.id_ip=ipv4.id_ip);","id_ip", "ip") ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ESPACIO EN BLANCO -->
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <input class="form-control input-sm" type="hidden" id="00" name="00" >   
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <!-- BOTON PARA SOFTWARE -->
                            <button type="button" data-toggle="modal" style="margin-top: 25px;" data-target="#modalsoftware" id="agregaraccesorio2" name="agregaraccesorio2" class="btn btn-warning input-sm btn-flat btn-block"><i class="fa fa-gears"></i>  A g r e g a r   S o f t w a r e  <i class="fa fa-code"></i></button>
                        </div>
                    </div>     

                    <!-- Datos de UBICACION DEL EQUIPO -->
                    <div class="row">
                        <div class="col-12 ">
                            <div class="text-center">
                                <h3 class="box-title"><b>Ubicación Fisica</b></h3>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label style="width: inherit" for="edificio">Edificio</label>
                                <select  id="sledificio" class="select2 help-block input-sm" name="sledificio" required style="width: 100%"  ><option hidden disabled selected value></option>
                                        <?php ComboBoxedificio("SELECT * FROM edificio","id_edificio","nombre_edificio")?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <select  class="form-control select2 input-sm help-block " name="sldepartamento" disabled id="sldepartamento" style="width: 100%"><option disabled hidden value selected></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <select  class="form-control input-sm help-block " id="slubicacion" name="slubicacion" disabled style="width: 100%"><option disabled hidden value selected></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="Observaciones">Observaciones</label>
                                <textarea class="form-control  input-sm" id="observaciones_cpu" name="observaciones_cpu" placeholder="Observaciones"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="btn-group pull-right"> 
                                    <a id="guardarcpu" name="guardarcpu" class="btn btn-success btn-flat btn-lg" style="margin: 3px">   <span class="fa fa-floppy-o"></span> Guardar </a>
                                    <a onclick=goBack() class="btn btn-success btn-flat btn-lg"  style="margin: 3px">    <span class="fa fa-search"></span> Buscar CPU</a> 
                                </div>
                            </div>  
                        </div>
                    </div>
                </div> <!-- FINAL DEL BODY -->
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../assets/plugins/jQuery/jquery-3.5.1.js"></script>
    <script src="../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script src="../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap-daterangepicker-master/moment.min.js"></script>
    <script src="../assets/js/custombox.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-daterangepicker-master/daterangepicker.js"></script>
    <script src="controller/controllerCpu.js"></script>

    <script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../assets/plugins/datatables/tabla.min.js" ></script>
    <script type="text/javascript" src="../assets/js/bootbox.js" ></script>
    <script type="text/javascript" src="../assets/js/bootbox.min.js" ></script>

    
    <script>
        //ENVIAR DATOS DE LAS MODALES PARA QUE SE GUARDEN
        //MODAL DE PROCESADOR
        $("#addprocesador").click(function(){    
                const formprocesador=document.getElementById("formprocesador")
                var fabricante = $("#fabricantepro").val();
                var modelo = $("#modelopro").val();
                var generacion = $("#generacionpro").val();
                var velocidad = $("#velocidadpro").val();

                $.ajax({
                    type:"POST",
                    url:"../mantenimiento_datos/procesador/consultas.php",
                    data:
                    {
                        tarea:"guardar",
                        fabricante:fabricante,
                        modelo:modelo,
                        generacion:generacion,
                        velocidad:velocidad
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="guardado"){
                                formprocesador.reset()
                                toastr.success("Guardado")
                            }
                            else if (item=="vacio"){
                                toastr.warning("Faltan campos por rellenar")

                            } else if (item=="existe"){
                                toastr.warning("Marca ya existente!")
                                formprocesador.reset()
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


        //ACTUALIZAR EL SELECT DE PROCESADOR DE LA PAGINA PRINCIPAL
        const formprocesador=document.getElementById("formprocesador")
        const btncerrar=document.getElementById("cerrarpro")
        const select=document.getElementById("slprocesador")
        btncerrar.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescar.php")
            const recibe=await res.json()
            console.log(recibe)
            select.innerHTML=""
            
            let option=document.createElement("option")
            option.value=""
            option.setAttribute("disabled","")
            option.setAttribute("selected","")
            option.setAttribute("hidden","")
            select.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_procesador
                option2.text=`${item.fabricante} -  ${item.modelo} -  ${item.generacion} -  ${item.velocidad}`
                select.add(option2)
            })
        })

        //MODAL MARCA
        $("#addmarca").click(function(){    
                const formmarca=document.getElementById("formmarca")
                var nombre_marca = $("#nombre_marca").val();

                $.ajax({
                    type:"POST",
                    url:"../mantenimiento_datos/marca/consultas.php",
                    data:
                    {
                        tarea:"guardar",
                        nombre_marca:nombre_marca
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="guardado"){
                                formmarca.reset()
                                toastr.success("Guardado")
                            }
                            else if (item=="vacio"){
                                toastr.warning("Faltan campos por rellenar")

                            } else if (item=="existe"){
                                toastr.warning("Marca ya existente!")
                                formmarca.reset()
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

        //ACTUALIZACION DE DATOS EN EL SELECT DE MARCA DE LA PAGINA PRINCIPAL
        const formmarca=document.getElementById("formmarca")
        const btncerrarmar=document.getElementById("cerrarmar")
        let selectmarca=document.getElementById("slmarca")
        btncerrarmar.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescamarca.php")
            const recibe=await res.json()
            console.log(recibe)
            selectmarca.innerHTML=""
            
            let option=document.createElement("option")
            option.value=""
                option.setAttribute("disabled","")
                option.setAttribute("selected","")
                option.setAttribute("hidden","")
                selectmarca.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_marca
                option2.text=`${item.nombre_marca}`
                selectmarca.add(option2)
            })
        })

        //MODAL CLASIFICACION
        $("#addclasss").click(function(){    
            const formcla=document.getElementById("formclasificacion")
            var nombre_clasificacion = $("#nombre_clasificacion").val();

            $.ajax({
                type:"POST",
                url:"../mantenimiento_datos/clasificacion/consultas.php",
                data:
                {
                    tarea:"guardar",
                    nombre_clasificacion:nombre_clasificacion
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formcla.reset()
                            toastr.success("Guardado")
                        }
                        else if (item=="vacio"){
                            toastr.warning("Campo por rellenar!")

                        } else if (item=="existe"){
                            toastr.warning("Clasificación ya existente!")
                            formcla.reset()
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

        //ACTUALIZACION DE DATOS EN EL SELECT DE CLASIFICACION DE LA PAGINA PRINCIPAL
        const formcla=document.getElementById("formclasificacion")
        const btncerrarclas=document.getElementById("cerrarclas")
        let selectcla=document.getElementById("slclasificacion")
        btncerrarclas.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescaclasificacion.php")
            const recibe=await res.json()
            console.log(recibe)
            selectcla.innerHTML=""
            
            let option=document.createElement("option")
            option.value=""
                option.setAttribute("disabled","")
                option.setAttribute("selected","")
                option.setAttribute("hidden","")
                selectcla.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_clasificacion_cpu
                option2.text=`${item.nombre_clasif}`
                selectcla.add(option2)
            })
        })

        //MODAL MONITOR
        $("#addmon").click(function(){
        const formlmon=document.getElementById("formmon")
        var inventario= $("#inventariomon").val();
        var marca = $("#marcamon").val();
        var serie= $("#seriemon").val();
        var service= $("#modelomon").val();
        var tipo= $("#tipomon").val();
        var tamano= $("#tamañomon").val();
        var obs= $("#observacionmon").val();
        var fecha_compra= $("#fecha_compra_mon").val();
                
        $.ajax({
            type:"POST",
            url:"../monitor/consultas.php",
            data:
            {
                tarea:"guardar",
                inventario:inventario,
                marca:marca,
                serie:serie,
                service:service,
                tipo:tipo,
                tamano:tamano,
                obs:obs,
                fecha_compra:fecha_compra
                
            },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {

                    if (item=="guardado"){
                        formlmon.reset()
                        toastr.success('Éxito','Guardado correctamente');
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
        
        //ACTUALIZACION DE DATOS EN EL SELECT DE CLASIFICACION DE LA PAGINA PRINCIPAL
        const formlmon=document.getElementById("formmon")
        const btncerrarmon=document.getElementById("cerrarmon")
        let selectmoni=document.getElementById("monitor")
        btncerrarmon.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescamonitor.php")
            const recibe=await res.json()
            console.log(recibe)
            selectmoni.innerHTML=""
            
            let option=document.createElement("option")
            option.value=""
                option.setAttribute("disabled","")
                option.setAttribute("selected","")
                option.setAttribute("hidden","")
                selectmoni.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_clasificacion_cpu
                option2.text=`${item.nombre_clasif}`
                selectmoni.add(option2)
            })
        })

        //MODAL UPS
        $("#addups").click(function()
        {
            const formups=document.getElementById("formups")
            var inventario= $("#inventarioups").val();
            var modelo = $("#modeloups").val();
            var capacidad= $("#capacidadups").val();
            var marca= $("#marcaups").val();
            var fecha_compra= $("#fecha_compra_ups").val();
            var obs= $("#observacionups").val();
                
            $.ajax({
                type:"POST",
                url:"../ups/consultas.php",
                data:
                {
                    tarea:"guardar",
                    inventario:inventario,
                    modelo:modelo,
                    capacidad:capacidad,
                    marca:marca,
                    fecha_compra:fecha_compra,
                    obs:obs
                    
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formups.reset()
                            toastr.success('Éxito','Guardado correctamente');
                            limpiarcampos();
                        }
                        else if (item=="existe")
                        {
                            toastr.warning('Error','Ups ya existente!');

                        }
                        else if (item=="vacio")
                        {
                            toastr.error('Faltan campos por rellenar!');
                            formups.reset()
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

        //ACTUALIZACION DE DATOS EN EL SELECT DE CLASIFICACION DE LA PAGINA PRINCIPAL
        const formups=document.getElementById("formups")
        const btncerrarups=document.getElementById("cerrarups")
        let selectups=document.getElementById("slups")
        btncerrarups.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescaups.php")
            const recibe=await res.json()
            console.log(recibe)
            selectups.innerHTML=""
            
            let option=document.createElement("option")
            option.value=""
                option.setAttribute("disabled","")
                option.setAttribute("selected","")
                option.setAttribute("hidden","")
                selectups.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_clasificacion_cpu
                option2.text=`${item.nombre_clasif}`
                selectups.add(option2)
            })
        })

        //MODAL ESTADO
        $("#addest").click(function(){    
        const formestado=document.getElementById("formestado")
        var nombre_est = $("#nombre_est").val();

            $.ajax({
                type:"POST",
                url:"../mantenimiento_datos/estado/consultas.php",
                data:
                {
                    tarea:"guardar",
                    nombre_est:nombre_est
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formestado.reset()
                            toastr.success("Guardado")
                        
                        }
                        else if (item=="vacio"){
                            toastr.warning("Campo por rellenar!")

                        } else if (item=="existe"){
                            toastr.warning("Estado ya existente!")
                            formestado.reset()
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

        //ACTUALIZACION DE DATOS EN EL SELECT DE ESTADO DE LA PAGINA PRINCIPAL
        const formestado=document.getElementById("formestado")
        const btncerrarest=document.getElementById("cerrarest")
        let selectest=document.getElementById("slestado")
        btncerrarest.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescaestado.php")
            const recibe=await res.json()
            console.log(recibe)
            selectest.innerHTML=""
            
            let option=document.createElement("option")
            option.value=""
                option.setAttribute("disabled","")
                option.setAttribute("selected","")
                option.setAttribute("hidden","")
                selectest.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_estado
                option2.text=`${item.nombre_estado}`
                selectest.add(option2)
            })
        })


        //MODAL DE RAM
        $("#addram").click(function(){    
            const formram=document.getElementById("formram")
            var sltiporam = $("#sltiporamm").val();
            var capacidad = $("#capacidadmarc").val();
            var frecuencia = $("#frecuenciamarc").val();
            var observaciones = $("#observacionesmarc").val();

            $.ajax({
                type:"POST",
                url:"../mantenimiento_datos/ram/consultas.php",
                data:
                {
                    tarea:"guardar",
                    sltiporam:sltiporam,
                    capacidad:capacidad,
                    frecuencia:frecuencia,
                    observaciones:observaciones
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formram.reset()
                            toastr.success("Guardado")
                        
                        }
                        else if (item=="vacio"){
                            toastr.warning("Campo por rellenar!")

                        } else if (item=="existe"){
                            toastr.warning("Ram ya existente!")
                            formram.reset()
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
        const formram=document.getElementById("formram")
        //ACTUALIZACION DE DATOS EN EL SELECT DE RAM DE LA PAGINA PRINCIPAL 
        const btncerrarram=document.getElementById("cerrarram")
        let selectram=document.getElementById("slram") //select de la pagina principal 
        let selecttipo=document.getElementById("sltiporamm") // select de la modal
        btncerrarram.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescaram.php")
            const recibe=await res.json()
            console.log(recibe)
            selectram.innerHTML=""
                
            //limpiar el select de la modal
            let optionsl=document.createElement("option")
            optionsl.value=""
            optionsl.setAttribute("disabled","")
            optionsl.setAttribute("selected","")
            optionsl.setAttribute("hidden","")
            selecttipo.add(optionsl)

            //limpiar y actualizar el select de la pagina principal 
            let option=document.createElement("option")
            option.value=""
            option.setAttribute("disabled","")
            option.setAttribute("selected","")
            option.setAttribute("hidden","")
            selectram.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_ram
                option2.text=`Tipo: ${item.tipo_ram} ,Total de Almac: ${item.capacidad} ,Frecuencia:  ${item.frecuencia},Nota:  ${item.observaciones}`
                selectram.add(option2)

            })
        })

        //MODAL DE TARJETA DE VIDEO  
        $("#addtvi").click(function(){    
            const formvideo=document.getElementById("formvideo")
            var slmarcavideo = $("#slmarcavideotv").val();
            var modelo = $("#modelotv").val();
            var capacidad = $("#capacidadtv").val();

            $.ajax({
                type:"POST",
                url:"../mantenimiento_datos/tvideo/consultas.php",
                data:
                {
                    tarea:"guardar",
                    slmarcavideo:slmarcavideo,
                    modelo:modelo,
                    capacidad:capacidad
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formvideo.reset()
                            toastr.success("Guardado")
                        }
                        else if (item=="vacio"){
                            toastr.warning("Campo por rellenar!")

                        } else if (item=="existe"){
                            toastr.warning("Tarjeta video ya existente!")
                            formvideo.reset()
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

        //ACTUALIZACION DE DATOS EN EL SELECT DE VIDEO DE LA PAGINA PRINCIPAL 
        const formvideo=document.getElementById("formvideo")
        const btncerrart=document.getElementById("cerrartarj")
        let selectv=document.getElementById("slvideo") //select que se encuentra en la pagina principal
        let selectmodal=document.getElementById("slmarcavideotv")//select que se encuentra en el modal
        btncerrart.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescavideo.php")
            const recibe=await res.json()
            console.log(recibe)
            formvideo.reset()
            selectv.innerHTML=""
            
            //LIMPIAR EL SELECT DE LA MODAL
            let optionmodal=document.createElement("option")
            optionmodal.value=""
            optionmodal.text=`--seleccione una opcion--`
            optionmodal.setAttribute("disabled","")
            optionmodal.setAttribute("selected","")
            optionmodal.setAttribute("hidden","")
            selectmodal.add(optionmodal) 

            //LIMPIAR EL SELECT DE LA PAGINA PRINCIPAL
            let option=document.createElement("option")
            option.value=""
            option.text=`--seleccione una opcion--`
            option.setAttribute("disabled","")
            option.setAttribute("selected","")
            option.setAttribute("hidden","")
            selectv.add(option)

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_tarjeta_v
                option2.text=`Marca: ${item.nombre_marca} ,Modelo:  ${item.modelo} ,Capacidad  ${item.capacidad}`
                selectv.add(option2)
            })
        })

        //MODAL DE DISCO
        $("#adddisc").click(function(){
            const formdisco=document.getElementById("formdisco")
            var sltipod= $("#sltipod").val();
            var sltipop= $("#sltipop").val();
            var capacidad= $("#capacidadd").val();
            $.ajax({
                type:"POST",
                url:"../mantenimiento_datos/disco/consultas.php",
                data:
                {
                    tarea:"guardar",
                    sltipod:sltipod,
                    sltipop:sltipop,
                    capacidad:capacidad
                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){
                            formdisco.reset()
                            toastr.success("Guardado!")
                        }
                        else if (item=="existe")
                        {
                            toastr.warning("Unidad ya existente!")

                        }
                        else if (item=="vacio")
                        {
                            toastr.warning("Campos por rellenar!")
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

        //ACTUALIZACION DE DATOS EN EL SELECT DE DISCO DE LA PAGINA PRINCIPAL 
        const btncerrardisco=document.getElementById("cerrardisco")
        let selectdisco=document.getElementById("sldisco") //select que se encuentra en la pagina principal
        let selectmodal1=document.getElementById("sltipod")//select que se encuentra en el modal
        let selectmodal2=document.getElementById("sltipop")//select que se encuentra en el modal
        btncerrardisco.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await fetch ("refrescadisco.php")
            const recibe=await res.json()
            console.log(recibe)
            formdisco.reset()
            selectdisco.innerHTML=""
        
            //LIMPIAR EL SELECT DE LA MODAL 1
            let optionmodal=document.createElement("option")
            optionmodal.value=""
            optionmodal.text=`--seleccione una opcion--`
            optionmodal.setAttribute("disabled","")
            optionmodal.setAttribute("selected","")
            optionmodal.setAttribute("hidden","")
            selectmodal1.add(optionmodal) 

            //LIMPIAR EL SELECT DE LA MODAL 2
            let optionmoda=document.createElement("option")
            optionmoda.value=""
            optionmoda.text=`--seleccione una opcion--`
            optionmoda.setAttribute("disabled","")
            optionmoda.setAttribute("selected","")
            optionmoda.setAttribute("hidden","")
            selectmodal2.add(optionmoda) 

            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_disco
                option2.text=`Tipo Disco: ${item.tipo_disco} ,Puerto:  ${item.tipo_puerto} ,Capacidad  ${item.capacidad}`
                selectdisco.add(option2)
            })
        })

        $(document).ready(function () {
            $("#inventarioups").inputmask("99-999-9999");
            $("select").select2();
            $('#fecha_compra_ups').datepicker({
                clearBtn: true,
                format: 'dd-mm-yyyy',
                locale:{
                    language: 'es'
                }
            });
        });

        $(document).ready(function () {
            $("#inventariomon").inputmask("99-999-9999");
            $("select").select2();                     
            $('#fecha_compra_mon').datepicker({
                clearBtn: true,
                format: 'dd-mm-yyyy',
                locale:{
                    language: 'es'
                }
            });
        });

        $("#generarInvups").click(function () {
            var timestamp = event.timeStamp;
            var d = new Date();
            var seconds = d.getSeconds();
            var year= d.getFullYear();
            var x=year+""+seconds+""+timestamp;
            var SetInventario= x.substring(0, 9);
            $("#inventarioups").val(SetInventario);
        });

        $("#generarInvmon").click(function () {
            var timestamp = event.timeStamp;
            var d = new Date();
            var seconds = d.getSeconds();
            var year= d.getFullYear();
            var x=year+""+seconds+""+timestamp;
            var SetInventario= x.substring(0, 9);
            $("#inventariomon").val(SetInventario);
            console.log(SetInventario);
        });

        //MODAL DE DIRECCION IP
        $("#addip").click(function(){
            var ip = $("#ipv4").val();
            //validar ip en un formato correcto
            var ipformat = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
            ipformat = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
            if(ip.match(ipformat))
            {
                $.ajax({
                    type:"POST",
                    url:"../mantenimiento_datos/ipv4/consultas.php",
                    data:
                    {
                        tarea:"guardar",
                        ip:ip
                    },
                    success: function(data)
                    {
                        data=data.split("|");
                        $.each(data, function(i, item) {

                            if (item=="bien")
                            {
                                toastr.success('Éxito','Guardado');
                                document.getElementById("ipv4").value="";
                            }
                            else if (item=="existe")
                            {
                                toastr.error('Error','Ip ya existente!');
                            }
                            else if (item=="vacio")
                            {
                                toastr.error('Campo vacío!');
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError)
                    {
                        alert(thrownError);
                        alert("No funciona ajax para guardar");
                    }
                })
            }
            else
            {
                toastr.error("Error","Has ingresado una IP inválida!");
                return;
            }
        });
             
         
        //ACTUALIZAR EL SELECT DE IP DE LA PAGINA PRINCIPAL
        const btncerrarip=document.getElementById("cerrarip")
        let selectip=document.getElementById("sl_ip") //select que se encuentra en la pagina principal
        btncerrarip.addEventListener("click",async function (e){
            e.preventDefault()
            const res=await  fetch ("refrescaip.php")
            const recibe=await res.json()
            console.log(recibe)
            selectip.innerHTML=""
            
            recibe.forEach(function (item){
                let option2=document.createElement("option")
                option2.value=item.id_ip
                option2.text=`${item.ip}`
                selectip.add(option2)
            })
        })

        $('.select_edificio').select2().on('select2:select',async function(e) {

        })

                
        //ASIGNAR EL VALOR DEL NUMERO DE INVENTARIO
        function PasarValor()
        {

        document.getElementById("cpu_actual").value = document.getElementById("inventario").value;
        document.getElementById("cpu_software").value = document.getElementById("inventario").value;

        }

    </script>
</body>

<?php

// FUNCIONES PARA CARGAR LOS DESPLEGABLES
function cargaComboBox($consul,$id,$nombre)
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

function ComboBoxclasificacion($consul,$id,$nombre)
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

function ComboBoxtarjeta($consul,$id,$modelo,$capacidad,$marca)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo "Marca: ".$row[$marca]." ,Modelo: ".$row[$modelo]." ,Capacidad: ".$row[$capacidad];
        echo "</option>";
    }
}

function ComboBoxUps($consul,$id,$num_inv,$modelo)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo "Inv: ".$row[$num_inv]."  Modelo: ".$row[$modelo];
        echo "</option>";
    }
}

function cargaoperador($consul,$id,$nombre,$apellido)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo $row[$nombre]." _ ".$row[$apellido];
        echo "</option>";
    }
}

function ComboBoxedificio($consul,$id,$nombre)
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

function ComboBoxinventario($consul,$id,$nombre)
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

function ComboBoxRam($consul,$id,$tipo,$capacidad,$frecuencia,$observ)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo "Tipo:".$row[$tipo]." ,Total de Almac: ".$row[$capacidad]." ,Frecuencia: ".$row[$frecuencia]." ,Nota: ".$row[$observ];
        echo "</option>";
    }
}

function ComboBoxmonitor($consul,$id,$inventario,$nombre,$tamano,$tipo,$fecha)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo "Inv. ".$row[$inventario]." marca ".$row[$nombre]." Tamaño: ".$row[$tamano]." Tipo: ".$row[$tipo]." Compra: ".$row[$fecha];
        echo "</option>";
    }
}

function ComboBoxdisco($consul,$id,$tipo,$puerto,$capacidad)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo "Unidad: ".$row[$tipo]." Puerto: ".$row[$puerto]." Capacidad: ".$row[$capacidad];
        echo "</option>";
    }
}
                     
function ComboBoxlicencia($consul,$id,$producto,$nombre_marca,$edicion,$version,$categoria,$nota)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo "producto: ".$row[$producto].",marca ".$row[$nombre_marca].",edición: ".$row[$edicion].",versión: ".$row[$version].",categoría: ".$row[$categoria].",nota: ".$row[$nota];
        echo "</option>";
    }
}

function ComboBoxpro($consul,$id,$fabricante,$modelo,$generacion,$velocidad)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row[$id]."'>";
        echo $row[$fabricante]." ".$row[$modelo]." ".$row[$generacion]." ".$row[$velocidad];
        echo "</option>";
    }
}


function ComboBoxMarca($consul,$id,$nombre)
{
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$nombre"]."'>";
        echo $row["$nombre"];
        echo "</option>";
    }
}
?>
    
</html>