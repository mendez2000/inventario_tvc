<?php


include ("../config/conexion2.php");
$tarea=$_POST["tarea"];// le mando este parametro que viene desde el metodo ajax
switch($tarea):
    case 'verificaUsuario':
        $mbd=DB::connect();DB::disconnect();
        $usuario=$_POST['usuario'];
        $clave= hash("sha512", $_POST['clave']);

       
        $stmt = $mbd->prepare("SELECT id_usuario, nombre_usu, id_empleado, pass, tipo_usuario FROM usuario_sistema WHERE nombre_usu=:uname AND pass=:umail  AND estado='1' ");
        $stmt->execute(array(':uname'=>$usuario, ':umail'=>$clave));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 1) {
                    session_start();
                 $_SESSION['user_session'] = $userRow['id_usuario'];
                 $_SESSION['nombre']= $userRow['nombre_usu'];
                 $_SESSION['empleado']=$userRow['id_empleado'];
                 $_SESSION['tipo']=$userRow['tipo_usuario'];
                 echo "|ok|";
        }else{
            echo "|no|";
        }
        break;
endswitch;


