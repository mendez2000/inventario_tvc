<?php

include('../config/conexion2.php');
$mbd=DB::connect();

        $cpu=$_POST["cpu"];
        $id_soft=$_POST["id_soft"];
        

        $verifica=$mbd->query("SELECT count(*) from detalle_cpu_licencia where num_inv_cpu='$cpu' AND id_licencia=(SELECT id_licencia from licencia where id_software='$id_soft');");
            if ($verifica->fetchColumn()<>0){
                echo json_encode ("existe");
            }
            else
            {
                //$proof=$mbd->query("INSERT INTO detalle_cpu_licencia(num_inv_cpu,id_licencia) VALUES ('$cpu',(SELECT id_licencia from licencia where id_software='$id_soft'));");
                $proof=$mbd->query("CALL update_insert('$cpu','$id_soft');");

                if ($proof){
                    $software=$mbd->query("SELECT id_software,producto,marca.nombre_marca,edicion,version_,categoria_software.categoria FROM `software`
                    LEFT join marca ON marca.id_marca=software.id_marca
                    LEFT join categoria_software ON categoria_software.id_categoria=software.id_categoria
                    WHERE id_software='$id_soft';")->fetchAll();
                    echo json_encode ($software);
                    //devuelve los valores de software
                    
                }
            }                                                                         
        

       

?>
