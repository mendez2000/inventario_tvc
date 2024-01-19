<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");

    $tarea=$_POST["tarea"];

    switch($tarea):
            case 'guardar':
            $mbd=DB::connect();DB::disconnect();
            $ip=$_POST['ip'];
            if(!empty($ip)){
                $verifica=$mbd->query("SELECT count(*) from ipv4 where ip='$ip';");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|"; 
                }else{
                    $proof=$mbd->query("INSERT INTO ipv4(ip) VALUES ('$ip')");
                    echo "|bien|";
                }                                                                         
            }
            else
            { 
                echo "|vacio|";
            
            }
    break;
       

    case 'editar':
		$mbd=DB::connect();DB::disconnect();
        $ip=$_POST["ip"];
        $id=$_POST["id"];

        if(!empty($ip)){
            $verifica=$mbd->query("SELECT count(*) from ipv4 where ip='$ip' AND id_ip!='$id' ;");
            if ($verifica->fetchColumn()<>0){
                echo "|existe|"; 
            }else{
                $proof=$mbd->query("UPDATE ipv4 SET ip='$ip' WHERE id_ip='$id'");
                echo "|bien|";
            }                                                                         
        }
        else
        { 
            echo "|vacio|";
        
        }

    break;
    
    case'verifica':  //verificar si ya existe el numero de ip
        $mbd=DB::connect();DB::disconnect();
        $id=$_POST["id"];
        $proof=$mbd->query("SELECT ip FROM `ipv4` WHERE ip='$id'");
        if($proof->fetchColumn()>0){
            echo "existe";
        }else{
            echo "noexiste";    }

    break;

    case 'eliminar':
		$mbd=DB::connect();DB::disconnect();
        $id=$_POST['id'];
        if(!empty($id)){
        $proof=$mbd->query("DELETE FROM ipv4 WHERE id_ip='$id';");
        }   
    break;
        
    endswitch;


?>