<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Almacenamiento</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
     <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
       <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>

<body class="login-page">

   <div id="cuerpo" class="col-md-8" >
           <div class="col-md-8 col-md-offset-3" >
        
                <h3>Unidad de Alamacenamiento</h3>
          
          
              <div class="box box-primary">
                <div class="box-header with-border">

               
             
                    <div class="modal-header">
                        Agregar Nuevo
                    </div>

                    <form id="formdisco">
                        <div id="demo" class="modal-body">
                            
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
                                    <option value="M2">M2</option>
                                    <option  value="IDE">IDE</option>
                                </select>

                            <label for="capacidad">Capacidad</label>
                            <input type="text" id="capacidad" name="capacidad" autocomplete="on"  class="input-sm form-control" placeholder="MB,GB,TB etc...">
                            </div>

                            <div class="modal-footer">
                                <a href="../../mantenimiento_datos/indexform.php">
                                <button type="button" id="cerrarest" name="cerrarest"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span> Mantenimientos</button>
                                </a>

                                <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar </button>
                                <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span> Buscar Unidades</a>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div> 

    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script>
            $(document).ready(function () {
                $("select").select2();

            });


                $("#guardar").click(function(){
                const formdisco=document.getElementById("formdisco")
                var sltipod= $("#sltipod").val();
                var sltipop= $("#sltipop").val();
                var capacidad= $("#capacidad").val();
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
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
                                let selectmarca=document.getElementById("sltipod")
                                let optionmodaldis=document.createElement("option")
                                optionmodaldis.value=""
                                optionmodaldis.setAttribute("disabled","")
                                optionmodaldis.setAttribute("selected","")
                                optionmodaldis.setAttribute("hidden","")
                                selectmarca.add(optionmodaldis) 

                                let selectmarca2=document.getElementById("sltipop")
                                let optionmodaldis2=document.createElement("option")
                                optionmodaldis2.value=""
                                optionmodaldis2.setAttribute("disabled","")
                                optionmodaldis2.setAttribute("selected","")
                                optionmodaldis2.setAttribute("hidden","")
                                selectmarca2.add(optionmodaldis2) 
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


            function goBack(){
            setTimeout(function(){  window.location.href="verdisco.php";  }, 30);
            }
                            
    </script>
</body>

<?php

function cargaComboBox($consul,$id,$nombre)
{
    include('../../config/conexion2.php');

    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["$id"]."'>";
        echo $row["$nombre"];
        echo "</option>";

    }

}

?>
</html>