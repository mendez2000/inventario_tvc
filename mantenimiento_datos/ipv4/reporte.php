<?php


include ("../../config/conexion2.php");
$tarea=$_GET["ver"];
switch ($tarea){


    case 'ocupadas':
$mbd=DB::connect();
$proof=$mbd->query("SELECT ip, id_numinventario, nombre_cpu, cpu.estado FROM ipv4 
                    INNER JOIN detalle_cpu_ip di ON ipv4.id_ip=di.id_ip 
                    INNER JOIN cpu ON id_numinventario=cpu.num_inventario");
$i=0;
$tabla = "";
while($row = $proof->fetch(PDO::FETCH_ASSOC))
{

$tabla.='{"ip":"'.$row['ip'].'","id_numinventario":"'.$row['id_numinventario'].'","nombre_cpu":"'.$row['nombre_cpu'].'", "estado":"'.$row['estado'].'"},';
$i++;
}
$tabla = substr($tabla,0, strlen($tabla) - 1);

echo '{"data":['.$tabla.']}';
break;


}
?>