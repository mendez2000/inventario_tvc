<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");//incluyo este archivo que contiene la conexion y el host
 
    $tarea=$_POST["tarea"];// le mando este parametro que viene desde el metodo ajax 
        switch($tarea):
        
        case 'guardar':
			$mbd=DB::connect();DB::disconnect();
        $numero=$_POST['empleado'];
        $nombre=$_POST['nombre'];
        $contrasena=hash("sha512",$_POST["contrasena"]);
        $tipo=$_POST["tipo"];
        $cc=hash("sha512",$_POST["cc"]);
        $estado=$_POST["estado"];
         if($contrasena != $cc ){
             echo "|noc|";
             return;
         }
           $proof="SELECT count(*) as resultado FROM usuario_sistema WHERE nombre_usu='$nombre'";
         
           if($res_usuario2= $mbd->query($proof)){
			    if ($res_usuario2->fetchColumn() > 0) {

					echo "|yae|";
					return;   

		                 }
           }

            $sql="SELECT count(*) as resultado1 FROM usuario_sistema WHERE id_empleado='$numero'";
 				if($res_usuario= $mbd->query($sql)){
						if ($res_usuario->fetchColumn() > 0) {
								echo "|yan|";
								return;   
							}			
					}

           


              $insert=$mbd->query("INSERT INTO usuario_sistema( nombre_usu, pass, id_empleado, tipo_usuario, estado)
                VALUES ('$nombre','$contrasena','$numero','$tipo', '$estado')");
                if ($insert){
                    echo '|bien|';
                }else{
                    echo "|mal|";
                }


        break;
            case 'editar': // cambiar la contrasena
                $mbd=DB::connect();DB::disconnect();
                $nombre=$_POST['nombre'];
                $contrasena=hash("sha512",$_POST["contrasena"]);
                $cc=hash("sha512",$_POST["cc"]);
                $id=$_POST["id"];
                $contrasena_vieja==hash("sha512",$_POST['contrasena_vieja']);

                if($contrasena != $cc ){
                    echo "|noc|";
                    return;
                }
                $stmt = $mbd->prepare("SELECT COUNT(*) as resultado FROM usuario_sistema WHERE pass=:pass AND usuario_sistema.id_usuario=:id ");

                $stmt->execute(array(':pass'=>$contrasena_vieja, ':id'=>$id));

                    if ( $stmt->rowCount() <= 0) {
                        echo "|clavenovalida|";
                        return;
                    }


                if(!trim($id) == ''){

                            $modificar=$mbd->query("UPDATE usuario_sistema SET pass='$contrasena' WHERE id_usuario='$id'");
                            if ($modificar){
                                     echo '|bien|';
                            }else{
                                     echo "|mal|";
                            }
                }else{
                          echo "|mal|";
                }


                break;

            case 'modificar': // modificar tipo y estado de un usuario
                $mbd=DB::connect();DB::disconnect();
                $estado=$_POST["estado"];
                $tipo=$_POST["tipo"];
                $id=$_POST["id"];

                if(!trim($tipo) == ''){

                    $modificar=$mbd->query("UPDATE usuario_sistema SET tipo_usuario='$tipo', estado='$estado' WHERE id_usuario='$id'");
                    if ($modificar){
                        echo '|bien|';
                    }else{
                        echo "|mal|";
                    }
                }else{
                    echo "|mal|";
                }


                break;


                case'eliminar':
                    $mbd=DB::connect();DB::disconnect();
                    $id=$_POST['id'];
                    if(!empty($id)){
                    $proof=$mbd->query("DELETE FROM usuario_sistema WHERE id_usuario='$id'");
                    }    
                  break;

    endswitch;
?>