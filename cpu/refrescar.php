<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $procesador=$mbd->query("SELECT * FROM procesador")->fetchAll();
    

    


    echo json_encode ($procesador);

