<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");//incluyo este archivo que contiene la conexion y el host

    $tarea=$_POST["tarea"];// le mando este parametro que viene desde el metodo ajax 
    
    switch($tarea):
       
        case 'guardar':
            $mbd=DB::connect();DB::disconnect();
            $inventario=$_POST["inventario"];
            $marca=$_POST['marca'];
            $modelo=$_POST["modelo"];
            $capacidad=$_POST["capacidad"];
            $fecha_compra=$_POST["fecha_compra"];
            $obs=$_POST["obs"];

            if(!empty($inventario and $marca)){
            $verifica=$mbd->query("SELECT contar_inventario('$inventario');");
            if ($verifica->fetchColumn()<>0){
                echo "|existe|";
            }else{
                
                if ($obs=="")
                {
                    $proof=$mbd->query("INSERT INTO ups (num_inventario,id_marca,modelo,capacidad,fecha_compra,observacion)
                                VALUES ('$inventario', '$marca', '$modelo', '$capacidad', '''$fecha_compra''', 'NINGUNA')");
                    $proof11=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$inventario','UPS');");

                    echo "|guardado|"; 
                }
                else {
                    $proof=$mbd->query("INSERT INTO ups (num_inventario,id_marca,modelo,capacidad,fecha_compra,observacion)
                                VALUES ('$inventario', '$marca', '$modelo', '$capacidad', '$fecha_compra', '$obs')");
                    $proof11=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$inventario','UPS');");

                    echo "|guardado|"; 
                }
            } 

            } 
            else
            {
                echo "|vacio|";
            }
        break;
       

        case 'editar':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST["id"];
            $inventario=$_POST["inventario"];
            $id_marca=$_POST['marca'];
            $modelo=$_POST["modelo"];
            $capacidad=$_POST["capacidad"];
            $fecha_compra=$_POST["fecha_compra"];
            $obs=$_POST["obs"];

            if(!empty($inventario and $id_marca)){
                $verifica=$mbd->query("SELECT contar_inventarioups('$inventario','$id');");
                if ($verifica->fetchColumn()==0){

                    if ($obs=="")
                    {
                        $proof=$mbd->query("UPDATE ups SET num_inventario='$inventario', id_marca='$id_marca', modelo='$modelo',capacidad='$capacidad',fecha_compra='$fecha_compra', observacion='NINGUNA' WHERE id_ups='$id'");
                        echo "|actualizado|"; 
                    }
                    else {
                        $proof=$mbd->query("UPDATE ups SET num_inventario='$inventario', id_marca='$id_marca', modelo='$modelo',capacidad='$capacidad',fecha_compra='$fecha_compra', observacion='$obs' WHERE id_ups='$id'");
                        echo "|actualizado|"; 
                    }
                    
                } 
                else
                {
                    echo "|existe|";
                }
            } 
            else
            {
                echo "|vacio|";
            }
        break;

        case 'eliminar':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST['id'];
            if(!empty($id)){
                $verifica=$mbd->query("SELECT ups.id_ups,ups.num_inventario,ups.modelo,capacidad,cpu.num_inventario as cpu,ups.fecha_compra,ups.observacion 
                FROM ups 
                LEFT JOIN cpu ON cpu.id_ups=ups.id_ups
                WHERE ups.id_ups='$id' AND cpu.id_cpu is null");
                if ($verifica->fetchColumn()!=0){
                    $proof=$mbd->query("DELETE FROM ups WHERE id_ups='$id';");
                    echo "|actualizado|";
                } 
                else{
                    echo "|Error|";
                }
                
            }    
        break;

    endswitch;

function guardarCpu($num_inventariod,  $id_cpu)
{
    $mbdf = DB::connect();
    DB::disconnect();
    if (isset($id_cpu)) {

        foreach ($id_cpu as $row) {
            $proof1 = $mbdf->query("INSERT INTO detalle_cpu_monitor(id_numinventario, id_cpu) 
                                               VALUES (  '$num_inventariod', '$row')");

        }

    }
}
?>