<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();



$tarea=$_POST["tarea"];


switch($tarea):
    case 'guardar':
        $mbd=DB::connect();
        $cpu_actual=$_POST["cpu"];
        $txtnum=$_POST["acc"];
        if(!empty($cpu_actual and $txtnum)){
        $verifica=$mbd->query("SELECT count(*) from detalle_cpu_accesorio where num_inv_cpu='$cpu_actual' AND num_inv_accesorio='$txtnum';");
            if ($verifica->fetchColumn()==1){
                echo json_encode ("asignado"); 
                //echo json_encode ("existe"); 
            }else{
                $proof=$mbd->query("INSERT INTO detalle_cpu_accesorio(num_inv_cpu,num_inv_accesorio) VALUES ('$cpu_actual','$txtnum');");
                echo json_encode ("agregado");
            }                                                                         
        }
        else
        { 
            echo json_encode("vacio"); 
        }
    break;


    case 'traer':
        $mbd=DB::connect();
        $id_cpu_actual=$_POST["id_cpu_actual"];
        $accesorios=$mbd->query("SELECT num_inv_acc,modelo,descri,serie,tipo_accesorio.tipo_accesorio,marca.nombre_marca,fecha_compra 
        from accesorio
        LEFT JOIN tipo_accesorio ON accesorio.id_taccesorio=tipo_accesorio.id_taccesorio
        LEFT JOIN marca ON marca.id_marca=accesorio.id_marca
        INNER JOIN detalle_cpu_accesorio ON detalle_cpu_accesorio.num_inv_accesorio=accesorio.num_inv_acc
        where detalle_cpu_accesorio.num_inv_cpu='$id_cpu_actual';")->fetchAll();
    
        echo json_encode ($accesorios);

        
    break;


    endswitch;
?>
    
       