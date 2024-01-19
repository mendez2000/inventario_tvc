<?php

include('../config/conexion2.php');
$mbd=DB::connect();
$id=$_POST['id'];

$departamentos=$mbd->query("SELECT * FROM departamento WHERE id_edificio='$id';")->fetchAll();
echo json_encode ($departamentos);


