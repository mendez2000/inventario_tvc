<?php

include ("../config/conexion2.php");
$tarea=$_GET["ver"];
switch ($tarea) {
    case 'cpu':

        $mbd=DB::connect();
        $proof=$mbd->query("SELECT man.*, cpu.num_inventario, cpu.nombre_cpu FROM 
                            mantenimiento man INNER JOIN cpu ON id_equipo=cpu.id_increment and tipo_equipo='cpu'");

        $i=0;
        $tabla = "";
        while($row = $proof->fetch(PDO::FETCH_ASSOC))
        {

            $tabla.='{"num_inventario":"'.$row['num_inventario'].'","nombre_cpu":"'.$row['nombre_cpu'].'","estado":"'.$row['estado'].'", "precio":"'.$row['precio'].'",
           "fecha":"'.$row['fecha'].'"},';
            $i++;
        }
        $tabla = substr($tabla,0, strlen($tabla) - 1);

        echo '{"data":['.$tabla.']}';
        break;

    case 'monitor':
        $mbd=DB::connect();
        $proof=$mbd->query("SELECT man.*, inventario, serie FROM mantenimiento man 
INNER JOIN monitor ON id_equipo=monitor.id_monitor and tipo_equipo='monitor'");

        $i=0;
        $tabla = "";
        while($row = $proof->fetch(PDO::FETCH_ASSOC))
        {

            $tabla.='{"inventario":"'.$row['inventario'].'","serie":"'.$row['serie'].'","fecha":"'.$row['fecha'].'", "precio":"'.$row['precio'].'",
           "fecha":"'.$row['fecha'].'"},';
            $i++;
        }
        $tabla = substr($tabla,0, strlen($tabla) - 1);

        echo '{"data":['.$tabla.']}';

        break;
}