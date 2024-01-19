<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':

            $mbd=DB::connect();
            $estado=$_POST["nombre_est"];
            
            
            if(!empty($estado)){
            
                $verifica=$mbd->query(" SELECT count(*) from tipo_estado where nombre_estado='$estado';  ");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("INSERT INTO tipo_estado(nombre_estado) VALUES
                    ('$estado')");
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
    
                $estado=$_POST["nombre_est"];
                $id=$_POST["id_estado"];
                
                if(!empty($estado)){
                
                    $verifica=$mbd->query("SELECT count(*) from tipo_estado where nombre_estado='$estado';");
                    if ($verifica->fetchColumn()<>0){
                        echo "|existe|"; 
                    }else{
                        $proof=$mbd->query("UPDATE tipo_estado SET nombre_estado='$estado' WHERE id_estado='$id'");
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
                $proof=$mbd->query("DELETE FROM tipo_estado WHERE id_estado='$id';");
                }   
            break;

    endswitch;
?>