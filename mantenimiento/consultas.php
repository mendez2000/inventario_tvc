<?php

$server  = $_SERVER['DOCUMENT_ROOT'];
include($server."/inventario/config/conexion2.php");
$combo=$_GET['combo'];
$tarea=$_POST['tarea'];

switch ($tarea){
    case 'guardar':
        $mbd=DB::connect();
        $id_equipo=$_POST['id_equipo'];
        $tipo_equipo=$_POST['tipo_equipo'];
        $obs=$_POST['obs'];
        $fecha=$_POST['fecha'];
        $precio=$_POST['precio'];
        $ubicacion=$_POST['ubicacion'];
        $estado=$_POST['estado'];
        $tipo_mantenimiento=$_POST['tipo_mantenimiento'];
        if (!trim($id_equipo) == '' || !trim($tipo_equipo)=='0') {

            $proof=$mbd->query("INSERT INTO mantenimiento(tipo_equipo, num_inventario, 
                            fecha, precio, id_departamento, estado, observaciones, tipo_mantenimiento) 
                            VALUES ('$tipo_equipo', '$id_equipo', '$fecha', '$precio', '$ubicacion', '$estado', '$obs', '$tipo_mantenimiento')");

            if ($proof){
                echo "|bien|";
            }else{
                echo "|mal|";
            }
        } else{
            echo "|mal|";
        }


    break;
        case 'editar':
        $mbd=DB::connect();
        $id=$_POST['id'];
        $id_equipo=$_POST['id_equipo'];
        $tipo_equipo=$_POST['tipo_equipo'];
        $obs=$_POST['obs'];
        $fecha=$_POST['fecha'];
        $precio=$_POST['precio'];
        $ubicacion=$_POST['ubicacion'];
        $estado=$_POST['estado'];
        $tipo_mantenimiento=$_POST['tipo_mantenimiento'];
        if (!trim($id) == '' ) {

            $proof=$mbd->query("UPDATE mantenimiento SET observaciones='$obs', fecha='$fecha', precio='$precio', id_departamento='$ubicacion', estado='$estado', tipo_mantenimiento='$tipo_mantenimiento' WHERE id_mantenimiento='$id'");

            if ($proof){
                echo "|bien|";
            }else{
                echo "|mal|";
            }
        } else{
            echo "|mal|";
        }


    break;
    case 'eliminar':
        $mbd=DB::connect();DB::disconnect();
        $id=$_POST['id'];
        if(!empty($id)){
        $proof=$mbd->query("DELETE FROM mantenimiento WHERE id_mantenimiento='$id';");
        }    
    break;

}
switch ($combo){


    case "CPU":
        $consul="select id_cpu, nombre_cpu, num_inventario from cpu";
        $mbd=DB::connect();
        $proof=$mbd->query($consul);
        while ($row = $proof->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$row["num_inventario"]."'>";
            echo $row["num_inventario"]." ".$row["nombre_cpu"];
            echo "</option>";
        }
        break;

    case "Monitor":
        $consul="select id_monitor, num_inventario, serie from monitor";
        $mbd=DB::connect();
        $proof=$mbd->query($consul);
        while ($row = $proof->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$row["num_inventario"]."'>";
            echo $row["num_inventario"]."   ".$row["serie"];
            echo "</option>";
        }
        break;
        case "Ups":
        $consul="select id_ups, num_inventario, modelo from ups";
        $mbd=DB::connect();
        $proof=$mbd->query($consul);
        while ($row = $proof->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$row["num_inventario"]."'>";
            echo $row["num_inventario"]."   ".$row["modelo"];
            echo "</option>";
        }
        break;

        case "Accesorios":
        $consul="SELECT num_inv_acc, tipo_accesorio.tipo_accesorio FROM accesorio INNER JOIN tipo_accesorio ON accesorio.id_taccesorio=tipo_accesorio.id_taccesorio";
        $mbd=DB::connect();
        $proof=$mbd->query($consul);
        while ($row = $proof->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$row["num_inv_acc"]."'>";
            echo $row["num_inv_acc"]."   ".$row["tipo_accesorio"];
            echo "</option>";
        }
        break;

}
?>