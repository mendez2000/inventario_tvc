<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $disco=$mbd->query("SELECT * FROM disco")->fetchAll();
    echo json_encode ($disco);

