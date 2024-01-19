<?php

include ("../config/conexion2.php");
$tarea=$_GET["ver"];
switch ($tarea){


    case 'ver':
        $mbd=DB::connect();
        $proof=$mbd->query("SELECT acc.num_inventario, acc.modelo, acc.estado, acc.serie, ta.tipo_accesorio, departamento.nombre_dep, marca.nombre_marca, cpu.nombre_cpu, cpu.num_inventario AS invcpu FROM accesorios acc 
INNER JOIN departamento ON ubicacion=departamento.id_departamento 
INNER JOIN tipo_accesorio ta ON acc.tipo=ta.id_taccesorio INNER JOIN marca ON acc.marca=marca.id_marca 
INNER JOIN cpu ON acc.cpu=cpu.id_increment");
        $i=0;
        $tabla = "";
        while($row = $proof->fetch(PDO::FETCH_ASSOC))
        {

            $tabla.='{"num_inventario":"'.$row['num_inventario'].'","modelo":"'.$row['modelo'].'","estado":"'.$row['estado'].'", "serie":"'.$row['serie'].'",
           "tipo_accesorio":"'.$row['tipo_accesorio'].'", "nombre_dep":"'.$row['nombre_dep'].'", "nombre_marca":"'.$row['nombre_marca'].'", "nombre_cpu":"'.$row['nombre_cpu'].'",
            "invcpu":"'.$row['invcpu'].'"},';
            $i++;
        }
        $tabla = substr($tabla,0, strlen($tabla) - 1);

        echo '{"data":['.$tabla.']}';
        break;


}
