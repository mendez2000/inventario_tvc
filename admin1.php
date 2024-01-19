
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sist. Inventario | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/font-awesome-4.5.0/css/font-awesome.min.css">

    <link href="assets/img/iconoitb.png" rel="icon" type="image/png" />
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/css/toastr.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

    <link rel="stylesheet" href="./assets/css/style_login1.css">

</head>
<body>
<div class="login-box">
    <div class="login-logo">
      <font color="white"><b>Administrador</b></font>
    </div>

    <div class="login-box-body">
          <font color="black"> <p class="login-box-msg">Iniciar Sesion</p></font>

        <form action="inventario" method="post">
            <div class="form-group has-feedback">
                <input type="text" id="usuario"  name="usuario" class="form-control" placeholder="Usuario">
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="clave" name="clave" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

   <div class="text-center">

<p><a href="/inventario/index.php">¿Regresar?</a></p>

            <div class="row">
                <div class="col-xs-8">
                

   <div class="text-center">
                    
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="button" id="guardar" class="btn btn-primary btn-block btn-flat">INICIAR</button>

                </div>
                <!-- /.col -->
            </div>
        </form>


    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-3.1.1.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/toastr.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    $('#clave').keypress(function(event) {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
       login();
        }
    });
    $("#guardar").click(function() {
   login();
   
    });
    function login() {
        var usuario = $("#usuario").val();
        var clave = $("#clave").val();

        $.ajax({
            type: "POST",
            url: "login/login.php",
            data: {
                tarea: "verificaUsuario",
                usuario: usuario,
                clave: clave
            },
            success: function (data) {
                data = data.split("|");
                $.each(data, function (i, item) {

                    if (item == "ok") {
                        setTimeout(function () {
                            window.location.replace("usuarios/usuario.php");

                        }, 300);
                        return;
                    }
                    if (item == "no") {

                        setTimeout(function () {
                            toastr.error("ERROR", "Usuario o Clave incorrecta");
                        }, 300);

                    }

                });
                

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
                alert("No funciona ajax para guardar");
                window.location.replace("index.php");
            }
        });

    }

</script>
</body>
</html>
