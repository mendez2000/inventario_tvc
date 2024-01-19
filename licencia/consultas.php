<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");

    $tarea=$_POST["tarea"];
        switch($tarea):
       
        case 'guardar':
            $mbd=DB::connect();DB::disconnect();
            $clasificacion=$_POST['clasificacion'];
            $id_licencia=$_POST["id_licencia"];
            $software=$_POST["software"];
            $dia=$_POST["dia"];
            $mes=$_POST["mes"];
            $anio=$_POST["anio"];
            $duracion=$_POST["duracion"];
            $recurrente=$_POST["slrecurrente"];
            $cantidad=$_POST["cantidad"];
            $nota=$_POST["nota"];

            if(!empty($id_licencia and $clasificacion  and $software and $recurrente)){
                $verifica=$mbd->query("SELECT count(*) from licencia where id_licencia='$id_licencia';");

                if ($verifica->fetchColumn()==0){ 

                    if ($cantidad == ''){
                        $cantidad=1;
                    }
                    
                    if ($nota == ''){
                        $nota="N/A";
                    }
                    
                    $proof=$mbd->query("INSERT INTO licencia (id_licencia,id_clasificacion,id_software,duracion,recurrente,cantidad,nota,dia,mes,anio,disponibilidad) VALUES ('$id_licencia', '$clasificacion', '$software', '$duracion', '$recurrente', '$cantidad', '$nota', '$dia', '$mes', '$anio','$cantidad')");
                    echo "|guardado|"; 

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

        case 'editar':
			$mbd=DB::connect();DB::disconnect();
            $clasificacion=$_POST['clasificacion'];
            $id_licencia=$_POST["id_licencia"];
            $software=$_POST["software"];
            $dia=$_POST["dia"];
            $mes=$_POST["mes"];
            $anio=$_POST["anio"];
            $duracion=$_POST["duracion"];
            $recurrente=$_POST["slrecurrente"];
            $cantidad=$_POST["cantidad"];
            $incremento=$_POST["incremento"];
            $nota=$_POST["nota"];
            

            if(!empty($id_licencia and $clasificacion and $software and $recurrente)){
                $verifica=$mbd->query("SELECT count(*) from licencia where id_licencia='$id_licencia' and incremento!='$incremento';");
                //no mandar la cantidad/////////////////////////////////////////////////////////////////////////
                
                if ($verifica->fetchColumn()==0){ 
                    if ($nota==""){
                        $nota="NINGUNA";
                    }
                    //primero actualizar la cantidad para despues el query completo
                    $actualizar_cantidad=$mbd->query("SELECT update_licencia('$incremento','$cantidad');");

                    $numero=$actualizar_cantidad->fetchColumn();
                        if ($numero==0)
                        {
                            echo "|invalida|"; 
                        }
                        else if ($numero==2)
                        {
                            $proof=$mbd->query("UPDATE licencia SET id_licencia='$id_licencia', id_clasificacion='$clasificacion', id_software='$software',duracion='$duracion',recurrente='$recurrente',nota='$nota',dia='$dia',mes='$mes', anio='$anio' WHERE incremento='$incremento';");
                            echo "|tope|";

                        }
                        else
                        {
                            $proof=$mbd->query("UPDATE licencia SET id_licencia='$id_licencia', id_clasificacion='$clasificacion', id_software='$software',duracion='$duracion',recurrente='$recurrente',nota='$nota',dia='$dia',mes='$mes', anio='$anio' WHERE incremento='$incremento';");
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


        case 'consultar':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST['id_clasificacion'];

            $datos=$mbd->query("SELECT clasificacion,tipo_identificador FROM clasificacion_licencia WHERE id_clasificacion='$id';")->fetchAll();
            echo json_encode ($datos);

        break;
        

        case 'eliminar_licencia':
            $mbd=DB::connect();DB::disconnect();
            $softwareelim=$_POST['softwareelim'];
            $cpu_inv=$_POST['cpu_inv'];

            if(!empty($softwareelim and $cpu_inv)){
                $eliminar=$mbd->query("CALL update_insert2('$cpu_inv','$softwareelim');");
                if ($eliminar){
                    echo json_encode ("delete");
                }
            }
            else
            {
                echo json_encode ("vacio");
            }


            

        break;

        case 'consultar_licencia':
            $mbd=DB::connect();DB::disconnect();
            $id_soft=$_POST['id_soft'];
            $consultar=$mbd->query("SELECT CONCAT ( 'ID:',id_licencia,'  ,  Clasificación:',clasificacion_licencia.clasificacion, '  ,  Duración:',duracion,' meses ','  ,  Recurrente:',recurrente,'  ,  Asientos:',cantidad,'  ,  Fecha de compra:',dia,'/',mes,'/',anio,'  ,  Nota:',licencia.nota) AS licencia from licencia
            INNER JOIN clasificacion_licencia on clasificacion_licencia.id_clasificacion=licencia.id_clasificacion
            INNER JOIN software on software.id_software=licencia.id_software WHERE licencia.id_software='$id_soft';")->fetchAll();
            if ($consultar){
                echo json_encode ($consultar);
            }

        break;

        case 'eliminar':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST['id'];
            if(!empty($id)){
            $proof=$mbd->query("DELETE FROM licencia WHERE id_licencia='$id' and  NOT EXISTS (SELECT * FROM detalle_cpu_licencia WHERE id_licencia = '$id');");
            }    
        break;

        case 'traer_licencia':
            $mbd=DB::connect();DB::disconnect();
            $id_cpu_actual=$_POST['id_cpu_actual'];
            $consultar2=$mbd->query("SELECT software.id_software,producto,marca.nombre_marca,edicion,version_,categoria_software.categoria
            FROM `software` 
            LEFT JOIN marca ON marca.id_marca=software.id_marca
            LEFT join categoria_software ON categoria_software.id_categoria=software.id_categoria
            INNER join licencia ON licencia.id_software=software.id_software
            INNER join detalle_cpu_licencia ON detalle_cpu_licencia.id_licencia=licencia.id_licencia
            WHERE detalle_cpu_licencia.num_inv_cpu='$id_cpu_actual';")->fetchAll(); 
            echo json_encode ($consultar2);
        break;

    endswitch;


function guardarUser($id_lic,  $user){
    $mbd=DB::connect();DB::disconnect();
    if (isset($user) && !empty($user)){

                foreach ($user as $row){
                    $proof=$mbd->query("INSERT INTO detalle_users_licencia( id_licencia, id_empleado) VALUES ('$id_lic', '$row')");
                     }

    }
}
?>