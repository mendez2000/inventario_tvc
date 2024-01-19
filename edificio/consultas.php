<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
            $mbd=DB::connect();DB::disconnect();
            $edificio=$_POST["edificio"];
    
            if(!empty($edificio)){
    
                $verifica=$mbd->query("SELECT count(*) from edificio where nombre_edificio='$edificio';  ");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|";
                }else{
                    $proof=$mbd->query("INSERT INTO edificio(nombre_edificio) VALUES ('$edificio');");
                    echo "|bien|";
                }                                                                         
            }
            else
            { 
                echo "|vacio|";
            
            }
        break;
        case 'editar':
            $mbd=DB::connect();
    
            $edificio=$_POST["edificio"];
            $id=$_POST["id"];
            
            if(!empty($edificio)){
            
                $verifica=$mbd->query("SELECT count(*) from edificio where nombre_edificio='$edificio' and id_edificio !='$id';  ");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|";
                }else{
                    $proof=$mbd->query("UPDATE edificio SET nombre_edificio='$edificio' WHERE id_edificio='$id'");
                    echo "|bien|";
                }                                                                         
                }
                else
                { 
                    echo "|vacio|";
                }
                
        break;


        case'eliminar':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST['id'];
            if(!empty($id)){
            $proof=$mbd->query("DELETE FROM edificio WHERE id_edificio='$id'");
            }    
          break;

    endswitch;
?>