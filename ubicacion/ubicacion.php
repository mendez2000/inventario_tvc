<?php include('../config/conexion2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ubicacion</title>
     <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets/css/toastr.css">
    <link href="../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet">


</head>

<body class="login-page">
   <div id="cuerpo" class="col-md-12" >
       <section class="content-header">
           <h1>
               UBICACION
             
           </h1>
         
       </section>
           <div class="col-md-12" >
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Nueva Ubicación</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                 <div class="box-body">

                 
                    <div class="row col-md-12 col-lg-12">
                    
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label for="serie">Ubicación</label>
                                <input type="text" class="form-control  input-sm  help-block" id="ubi" name="ubi" placeholder="">
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="marca">Departamento al que pertenece</label>
                            <select class="help-block" id="depto" name="depto" required style="width: 100%" placeholder="marca">
                                <?php ComboBoxMarca("SELECT * from departamento;","id_departamento","departamento"); ?><option disabled selected value></option>
                            </select>
                        </div>

                     </div>



                     <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">                           
                                <div class="form-group">
                                    <div class="btn-group pull-right">
                                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                                        <a  onclick="goBack()" class="btn btn-success btn-flat btn-lg" style="margin: 3px"><span class="fa fa-search"></span>
                                        Buscar Ubicaciones</a>
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
    <script src="../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/toastr.js"></script>
    <script src="../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            
            $("select").select2();
            

        });

                   
 
        $("#guardar").click(function(){
            var ubi= $("#ubi").val();
            var depto = $("#depto").val();
        
            $.ajax({
                type:"POST",
                url:"consultas.php",
                data:
                {
                    tarea:"guardar",
                    depto:depto,
                    ubi:ubi

                },
                success: function(data)
                {
                    data=data.split("|");
                    $.each(data, function(i, item) {

                        if (item=="guardado"){

                            toastr.success('Éxito','Guardado correctamente');
                            limpiarcampos();
                        }
                        else if (item=="existe")
                        {
                            toastr.warning('Error','Ubicación existente en este departamento!');

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
                    
        function limpiarcampos(){
            document.getElementById("ubi").value="";
            
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
            setTimeout(function(){  window.location.href="ver_ubicacion.php";  }, 30);
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
?>

</html>