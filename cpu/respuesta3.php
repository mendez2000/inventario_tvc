<?php

include('../config/conexion2.php');
$mbd=DB::connect();

$acc=$_POST['acc'];



$accesorio=$mbd->query("SELECT accesorio.num_inv_acc,accesorio.modelo,accesorio.descri,accesorio.serie,accesorio.id_taccesorio,accesorio.id_marca,accesorio.fecha_compra,marca.nombre_marca,tipo_accesorio.tipo_accesorio 
FROM accesorio 
LEFT JOIN marca ON accesorio.id_marca=marca.id_marca
INNER JOIN tipo_accesorio on accesorio.id_taccesorio=tipo_accesorio.id_taccesorio 
WHERE id_accesorio='$acc';")->fetchAll();

echo json_encode ($accesorio);

