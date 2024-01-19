<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ip</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../assets/css/toastr.css">
    <link href="../../assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
       <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
       <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
       <script type="text/javascript" src="../../assets/js/toastr.js"></script>
</head>
<body class="login-page">  
   <div id="cuerpo" class="col-md-8" >
       
           <div class="col-md-8 col-md-offset-3" >

         
                <h3>DIRECCION IP</h3>
        
              <div class="box box-primary">
                <div class="box-header with-border">

                <h2 class="box-title">Agregar Nueva</h2>
         

                <form role="form">
                    <div class="box-body">
                    
                    
                    <div class="form-group">
                        <label for="ip">Direccion Ip</label>
                        <input type="text" class="form-control input-lg" id="ip" name="ip" placeholder="ip">
                        </div>
                        

                    </div><!-- /.box-body -->

                    <div class="modal-footer">
                        <a href="../indexform.php">
                            <button type="button" id="cerrarmar" name="cerrarmar"  class="btn btn-danger btn-flat"><span class="fa fa-database"></span> Mantenimientos </button>
                        </a>

                        <button type="button" id="guardar" name="guardar" class="btn btn-success btn-flat " style="margin: 3px"><span class="fa fa-floppy-o"></span> Guardar</button>
                        <a  onclick="goBack()" class="btn btn-success btn-flat"  style="margin: 3px"><span class="fa fa-search"></span>
                            Buscar IP</a>
                    </div>
                </form>
               </div>
            </div>
       </div>
   </div>
                
    <script type="text/javascript" src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script>
    <script src="../../assets/plugins/select2/select2.full.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../assets/js/toastr.js"></script>
    <script src="../../assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script  src="../../assets/js/bootstrap-daterangepicker-master/moment.min.js"></script>
    <script  src="../../assets/js/custombox.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap-daterangepicker-master/daterangepicker.js"></script>
    
    <script type="text/javascript" src="../../assets/plugins/datatables/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="../../assets/plugins/datatables/tabla.min.js" ></script>
    <script type="text/javascript" src="../../assets/js/bootbox.js" ></script>
    <script type="text/javascript" src="../../assets/js/bootbox.min.js" ></script>

    <script>
   
        $("#guardar").click(function()
        {  
        var ip = $("#ip").val();
        //validar ip en un formato correcto
        var ipformat = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
        ipformat = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
            if(ip.match(ipformat))
            {
                //toastr.success("Ip correcta!");
                $.ajax({
                    type:"POST",
                    url:"consultas.php",
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
                                document.getElementById("ip").value="";
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
          
        function goBack(){
            setTimeout(function(){  window.location.href="ver_ip.php";  }, 30);
            
        }
    </script>          
</body>
</html>