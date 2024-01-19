<?php
/**
 * Created by PhpStorm.
 * User: X401
 * Date: 16/06/17
 * Time: 22:11
 */

include ("../config/conexion2.php");
$tarea=$_GET["ver"];
switch ($tarea){


    case 'empleados':
        $mbd=DB::connect();
        $proof=$mbd->query("SELECT emp.id, CONCAT (nombre,' ', apellido) As NAME, emp.telefono, emp.correo, nombre_dep, id_numinventario, cpu.nombre_cpu, cpu.estado, (SELECT COUNT(*) FROM detalle_cpu_empleados 
WHERE detalle_cpu_empleados.id_empleado=de.id_empleado) as equipos FROM empleados emp 
INNER JOIN departamento dep ON emp.id_departamento=dep.id_departamento
 INNER JOIN detalle_cpu_empleados de ON emp.id=de.id_empleado 
 INNER JOIN cpu ON de.id_numinventario=cpu.num_inventario");
        $i=0;
        $tabla = "";
        while($row = $proof->fetch(PDO::FETCH_ASSOC))
        {

            $tabla.='{"id":"'.$row['id'].'","NAME":"'.$row['NAME'].'","telefono":"'.$row['telefono'].'",
             "correo":"'.$row['correo'].'", "nombre_dep":"'.$row['nombre_dep'].'", "id_numinventario":"'.$row['id_numinventario'].'",
              "nombre_cpu":"'.$row['nombre_cpu'].'", "estado":"'.$row['estado'].'",  "equipos":"'.$row['equipos'].'"},';
            $i++;
        }
        $tabla = substr($tabla,0, strlen($tabla) - 1);

        echo '{"data":['.$tabla.']}';
        break;


}
