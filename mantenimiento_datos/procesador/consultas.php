<?php
$server  = $_SERVER['DOCUMENT_ROOT'];
include($server."/inventario/config/conexion2.php");
$tarea=$_POST['tarea'];


switch ($tarea):
    case 'guardar':

        $mbd=DB::connect();

        //los datos de procesador
        $fabricante=$_POST["fabricante"];
        $modelo=$_POST["modelo"];
        $generacion=$_POST["generacion"];
        $velocidad=$_POST["velocidad"];

        if(!empty($fabricante and $modelo )){
            $verifica=$mbd->query(" SELECT count(*) from procesador where fabricante='$fabricante' AND modelo='$modelo' and generacion='$generacion' and velocidad='$velocidad';  ");
            if ($verifica->fetchColumn()<>0){
                echo "|existe|"; 
            }else{
                $proof=$mbd->query("INSERT INTO procesador(fabricante,modelo,generacion,velocidad) VALUES
                ('$fabricante','$modelo','$generacion','$velocidad')");
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
    
        $id=$_POST["id_pro"];
        $fabricante=$_POST["fabricante"];
        $modelo=$_POST["modelo"];
        $generacion=$_POST["generacion"];
        $velocidad=$_POST["velocidad"];
        
    
        if(!empty($fabricante and $modelo )){
            $verifica=$mbd->query("SELECT count(*) from procesador where fabricante='$fabricante' AND modelo='$modelo' and generacion='$generacion' and velocidad='$velocidad';  ");
            if ($verifica->fetchColumn()<>0){
                echo "|existe|"; 
            }else{
                $proof=$mbd->query("UPDATE procesador SET fabricante='$fabricante',modelo='$modelo',generacion='$generacion',velocidad='$velocidad' WHERE id_procesador='$id'");
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
        $proof=$mbd->query("DELETE FROM procesador WHERE id_procesador='$id';");
        }   
    break;

endswitch;
?>