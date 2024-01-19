<?php
/**
 * Created by PhpStorm.
 * User: ENLMovil1
 * Date: 22/6/2017
 * Time: 3:41 PM
 */
include ("../config/conexion2.php");
$tarea=$_GET["ver"];
switch ($tarea){


    case 'ver':
        $mbd=DB::connect();
        $proof=$mbd->query("SELECT licencia.*, 
(SELECT COUNT(*) FROM detalle_cpu_licencia dl WHERE dl.id_licencia=licencia.id_licencia) AS usadas,
 (SELECT  GROUP_CONCAT(' /',t2.nombre_cpu) AS dates
FROM detalle_cpu_licencia t1
LEFT JOIN cpu t2
  ON t2.num_inventario= t1.id_numinventario
    WHERE t1.id_licencia = licencia.id_licencia               
GROUP BY t1.id_licencia) as equipos FROM licencia ");
        $i=0;
        $tabla = "";
        while($row = $proof->fetch(PDO::FETCH_ASSOC))
        {

            $tabla.='{"nombre":"'.$row['nombre'].'","idioma":"'.$row['idioma'].'","fecha_adqui":"'.$row['fecha_adqui'].'", "fecha_vence":"'.$row['fecha_vence'].'",
           "fabricante":"'.$row['fabricante'].'", "clave":"'.$row['clave'].'", "usuario_lic":"'.$row['usuario_lic'].'", "pass":"'.$row['pass'].'",
            "cant_lic":"'.$row['cant_lic'].'","pag_web":"'.$row['pag_web'].'", "descripcion":"'.$row['descripcion'].'", "tipo_contrato":"'.$row['tipo_contrato'].'",
            "usadas":"'.$row['usadas'].'", "equipos":"'.$row['equipos'].'"},';
            $i++;
        }
        $tabla = substr($tabla,0, strlen($tabla) - 1);

        echo '{"data":['.$tabla.']}';
        break;


}
?>