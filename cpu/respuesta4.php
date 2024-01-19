<?php

include('../config/conexion2.php');
$mbd=DB::connect();




$accesorios=$mbd->query("SELECT id_accesorio,num_inv_acc from accesorio where not exists (select num_inv_acc from detalle_cpu_accesorio where detalle_cpu_accesorio.num_inv_accesorio = accesorio.num_inv_acc);")->fetchAll();
echo json_encode ($accesorios);

