<?php
$server  = $_SERVER['DOCUMENT_ROOT'];
include($server."/inventario/config/conexion2.php");
$tarea=$_POST['tarea'];

switch ($tarea):
    case 'guardar':
        $mbd=DB::connect();
        $tipo=$_POST["sltiporam"];//tipo de ram
        $capacidad=$_POST["capacidad"];
        $frecuencia=$_POST["frecuencia"];
        $observaciones=$_POST["observaciones"];//nulo
        
            if(!empty($tipo and $capacidad )){
                $verifica=$mbd->query(" SELECT count(*) from ram where id_tipo_ram='$tipo' AND capacidad='$capacidad' and frecuencia='$frecuencia';  ");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
            
                        if ($observaciones=="")
                        {
                            $proof=$mbd->query("INSERT INTO ram(id_tipo_ram,capacidad,frecuencia,observaciones) VALUES ('$tipo','$capacidad','$frecuencia','NINGUNA')");
                            echo "|guardado|";  
                        }
                        else
                        {
                            $proof=$mbd->query("INSERT INTO ram(id_tipo_ram,capacidad,frecuencia,observaciones) VALUES ('$tipo','$capacidad','$frecuencia','$observaciones')");
                            echo "|guardado|";  
                        }
                        
                }                                                                         
            }
            else
            { 
                echo "|vacio|"; 
            }
        
        
    break;
    
    case 'editar':
        $mbd=DB::connect();
    
        $id=$_POST["id_ram"];
        $tipo=$_POST["sltiporam"];
        $capacidad=$_POST["capacidad"];
        $frecuencia=$_POST["frecuencia"];
        $observaciones=$_POST["observaciones"];
        
        if(!empty($tipo and $capacidad)){
            $verifica=$mbd->query("SELECT count(*) from ram where id_tipo_ram='$tipo' AND capacidad='$capacidad' and frecuencia='$frecuencia' and observaciones='$observaciones'; ");
            if ($verifica->fetchColumn()<>0){
                echo "|existe|"; 
            }else{
                    if ($observaciones=="")
                    {
                        $proof=$mbd->query("UPDATE ram SET id_tipo_ram='$tipo',capacidad='$capacidad',frecuencia='$frecuencia',observaciones='NINGUNA' WHERE id_ram='$id'");
                        echo "|actualizado|";  
                    }
                    else
                    {
                        $proof=$mbd->query("UPDATE ram SET id_tipo_ram='$tipo',capacidad='$capacidad',frecuencia='$frecuencia',observaciones='$observaciones' WHERE id_ram='$id'");
                        echo "|actualizado|";  
                    }
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
            $proof=$mbd->query("DELETE FROM ram WHERE id_ram='$id';");
        }   
    break;
endswitch;
?>