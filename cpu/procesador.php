<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

//los datos de procesador
$fabricante=$_POST["fabricante"];
$modelo=$_POST["modelo"];
$generacion=$_POST["generacion"];
$velocidad=$_POST["velocidad"];

if(!empty($fabricante and $modelo and $generacion and $velocidad)){
    $verifica=$mbd->query(" SELECT count(*) from procesador where fabricante='$fabricante' AND modelo='$modelo' and generacion='$generacion' and velocidad='$velocidad';  ");
    if ($verifica->fetchColumn()<>0){
        echo json_encode ("existe"); 
    }else{
        $proof=$mbd->query("INSERT INTO procesador(fabricante,modelo,generacion,velocidad) VALUES
        ('$fabricante','$modelo','$generacion','$velocidad')");
        echo json_encode ("guardado");  
    }                                                                         
    }
    else
    { 
        echo json_encode("vacio"); 
    }
    
            

