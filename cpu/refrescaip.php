<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $ipv4=$mbd->query("SELECT * from ipv4 where not exists (select id_ip from detalle_cpu_ip where detalle_cpu_ip.id_ip=ipv4.id_ip);")->fetchAll();
    echo json_encode ($ipv4);


