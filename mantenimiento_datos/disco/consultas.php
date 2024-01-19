<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
            $mbd=DB::connect();
            $tipo_disco=$_POST["sltipod"];
            $tipo_puerto=$_POST["sltipop"];
            $capacidad=$_POST["capacidad"];        
            
            if(!empty($tipo_disco and $tipo_puerto and $capacidad)){
                $verifica=$mbd->query("SELECT count(*) from disco where tipo_disco='$tipo_disco' AND tipo_puerto='$tipo_puerto' and capacidad='$capacidad';");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("INSERT INTO disco(tipo_disco,tipo_puerto,capacidad) VALUES ('$tipo_disco','$tipo_puerto','$capacidad');");
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
            $id=$_POST["id_disco"];
            $tipo=$_POST["sltipod"];
        
            $puerto=$_POST["sltipop"];
            $capacidad=$_POST["capacidad"];
           
            
            if(!empty($tipo and $puerto and $capacidad)){
                $verifica=$mbd->query("SELECT count(*) from disco where tipo_disco='$tipo' AND tipo_puerto='$puerto' and capacidad='$capacidad';");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("UPDATE disco SET tipo_disco='$tipo',tipo_puerto='$puerto',capacidad='$capacidad' WHERE id_disco='$id';");
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
            $proof=$mbd->query("DELETE FROM disco WHERE id_disco='$id';");
            }   
        break;    
             
    endswitch;
?>