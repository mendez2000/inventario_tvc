<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $estado=$mbd->query("SELECT * FROM tipo_estado")->fetchAll();
    echo json_encode ($estado);

