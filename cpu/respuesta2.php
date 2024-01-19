<?php

include('../config/conexion2.php');
$mbd=DB::connect();

$dep=$_POST['dep'];




$ubicacion=$mbd->query("SELECT * FROM ubicacion WHERE id_departamento='$dep';")->fetchAll();
echo json_encode ($ubicacion);

