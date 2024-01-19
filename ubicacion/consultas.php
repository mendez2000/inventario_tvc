<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

        switch($tarea):

            case 'guardar':
                $mbd=DB::connect();
                $departamento=$_POST['depto'];
                $ubi=$_POST['ubi'];
        
                if(!empty($departamento and $ubi)){
                    $verifica=$mbd->query("SELECT count(*) from ubicacion where ubicacion='$ubi' AND id_departamento='$departamento';");
                    if ($verifica->fetchColumn()<>0){
                        echo "|existe|";
                    }else{
                        $proof=$mbd->query("INSERT INTO ubicacion (ubicacion,id_departamento) VALUES ('$ubi', '$departamento')");
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
                $id_ubicacion=$_POST['id_ubicacion'];
                $ubicacion=$_POST["ubicacion"];
                $depto=$_POST["depto"];
    
                if(!empty($ubicacion and $depto)){
                    $verifica=$mbd->query("SELECT count(*) from ubicacion where ubicacion='$ubicacion' AND id_departamento='$depto';");
                    if ($verifica->fetchColumn()==0){
                        $proof=$mbd->query("UPDATE ubicacion SET ubicacion='$ubicacion', id_departamento='$depto' WHERE id_ubicacion='$id_ubicacion'");
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
                    $proof=$mbd->query("DELETE FROM ubicacion WHERE id_ubicacion='$id'");

                }else{
                    echo "Error";
                }
            break;


        endswitch;

?>