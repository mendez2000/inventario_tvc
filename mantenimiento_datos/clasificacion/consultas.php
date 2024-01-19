<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
            $mbd=DB::connect();DB::disconnect();
            $clas=$_POST["nombre_clasificacion"];

            if(!empty($clas)){

                $verifica=$mbd->query(" SELECT count(*) from clasificacion where nombre_clasif='$clas';  ");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("INSERT INTO clasificacion(nombre_clasif) VALUES ('$clas')");
                    echo "|guardado|";
                }                                                                         
            }
            else
            { 
                echo "|vacio|";
        
            }
    
            break;
            case 'editar':
                $mbd=DB::connect();DB::disconnect();
    
                $clas=$_POST["nombre_clasificacion"];
                $id=$_POST["id_clasificacion"];
                
                if(!empty($clas)){
                
                    $verifica=$mbd->query(" SELECT count(*) from clasificacion where nombre_clasif='$clas';  ");
                    if ($verifica->fetchColumn()<>0){
                        echo "|existe|"; 
                    }else{
                        $proof=$mbd->query("UPDATE clasificacion SET nombre_clasif='$clas' WHERE id_clasificacion_cpu='$id'");
                        echo "|actualizado|";  
                    }                                                                         
                    }
                else
                { 
                    echo "|vacio|";
                }
                    
            
            break;

            case 'eliminar':
                $mbd=DB::connect();DB::disconnect();
    
                $id=$_POST['id'];
                if(!empty($id)){
                $proof=$mbd->query("DELETE FROM clasificacion WHERE id_clasificacion_cpu='$id';");
                }   

            break;
    endswitch;
    ?>