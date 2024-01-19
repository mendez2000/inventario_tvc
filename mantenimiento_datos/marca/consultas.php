<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):

        case 'guardar':
            $mbd=DB::connect();
            $marca=$_POST["nombre_marca"];
            if(!empty($marca)){

                $verifica=$mbd->query(" SELECT count(*) from marca where nombre_marca='$marca';  ");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("INSERT INTO marca(nombre_marca) VALUES ('$marca')");
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
            $marca=$_POST["nombre_marca"];
            $id=$_POST["id_marca"];
            
            if(!empty($marca)){
            
                $verifica=$mbd->query(" SELECT count(*) from marca where nombre_marca='$marca';  ");
                    if ($verifica->fetchColumn()<>0){
                        echo "|existe|"; 
                    }else{
                        $proof=$mbd->query("UPDATE marca SET nombre_marca='$marca' WHERE id_marca='$id'");
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
            $proof=$mbd->query("DELETE FROM marca WHERE id_marca='$id';");
            }   
        break;

    endswitch;

?>