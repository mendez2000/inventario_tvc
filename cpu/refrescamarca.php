<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $marca=$mbd->query("SELECT * FROM marca")->fetchAll();
    echo json_encode ($marca);


