<?php
include('../config/conexion2.php');
session_start();
$mbd=DB::connect();

    $video=$mbd->query("SELECT id_tarjeta_v,marca.nombre_marca,modelo,capacidad FROM t_video left join marca ON marca.id_marca=t_video.id_marca;")->fetchAll();
    echo json_encode ($video);

