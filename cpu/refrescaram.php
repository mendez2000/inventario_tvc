<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $ram=$mbd->query("SELECT id_ram, tipo_ram.tipo_ram, capacidad, frecuencia,observaciones from ram
    LEFT join tipo_ram on tipo_ram.id_tipo_ram=ram.id_tipo_ram;")->fetchAll();
    echo json_encode ($ram);

