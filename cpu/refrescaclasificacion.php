<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $clasif=$mbd->query("SELECT * FROM clasificacion")->fetchAll();
    echo json_encode ($clasif);


