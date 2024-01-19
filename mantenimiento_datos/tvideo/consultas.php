<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");

    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
            $mbd=DB::connect();
            $marca=$_POST["slmarcavideo"];   //me trae el id de marca 
            $modelo=$_POST["modelo"];
            $capacidad=$_POST["capacidad"];
            
            if(!empty($marca and $modelo and $capacidad)){
                $verifica=$mbd->query(" SELECT count(*) from t_video where id_marca='$marca' AND modelo='$modelo' and capacidad='$capacidad';");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("INSERT INTO t_video(id_marca,modelo,capacidad) VALUES ('$marca','$modelo','$capacidad')");
                    echo "|guardado|";  
                }                                                                         
            }
            else
            { 
                echo "|vacio|"; 
            }

        break;   
        case 'editar':
            $mbd=DB::connect();
            $id=$_POST["id_video"];
            $marca=$_POST["slmarcavideo"];
            $modelo=$_POST["modelo"];
            $capacidad=$_POST["capacidad"];
            
        
            if(!empty($marca and $modelo and $capacidad)){
                $verifica=$mbd->query("SELECT count(*) from t_video where id_marca='$marca' AND modelo='$modelo' and capacidad='$capacidad';");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("UPDATE t_video SET id_marca='$marca',modelo='$modelo',capacidad='$capacidad' WHERE id_tarjeta_v='$id';");
                    echo "|actualizado|";  
                }                                                                         
            }
            else
            { 
                echo "|vacio|"; 
            }
        break;

        case 'eliminar':
            $mbd=DB::connect();
            $id=$_POST['id'];
            if(!empty($id)){
                $proof=$mbd->query("DELETE FROM t_video WHERE id_tarjeta_v='$id';");
            }   
        break;

    endswitch;
?>