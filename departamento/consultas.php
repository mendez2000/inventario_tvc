<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

        switch($tarea):

            case 'guardar':
                $mbd=DB::connect();
                $departamento=$_POST['depto'];
                $edificio=$_POST['edi'];

                    if(!empty($departamento and $edificio)){
                        $verifica=$mbd->query("SELECT count(*) from departamento where departamento='$departamento' AND id_edificio='$edificio';");
                        if ($verifica->fetchColumn()<>0){
                            echo "|existe|";
                        }else{
                            $proof=$mbd->query("INSERT INTO departamento (departamento,id_edificio)
                                            VALUES ('$departamento', '$edificio')");
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
                $id_depto=$_POST['id_depto'];
                $departamento=$_POST["departamento"];
                $edificio=$_POST["edificio"];
    
                if(!empty($departamento and $edificio)){
                    $verifica=$mbd->query("SELECT count(*) from departamento where departamento='$departamento' AND id_edificio='$edificio';");
                    if ($verifica->fetchColumn()==0){
                        $proof=$mbd->query("UPDATE departamento SET departamento='$departamento', id_edificio='$edificio' WHERE id_departamento='$id_depto'");
                        echo "|actualizado|"; 
                    } 
                    else
                    {
                        echo "|existe|";
                    }
                } 
                else
                {
                    echo "|vacio|";
                }
            break;

            case 'eliminar':
                $mbd=DB::connect();DB::disconnect();
                $id=$_POST["id"];
        
                if (!trim($id) == '') { 
                    $proof=$mbd->query("DELETE FROM departamento WHERE id_departamento='$id'");

                    echo $id;
                }else{
                    echo "Error";
                }
            break;


        endswitch;

?>