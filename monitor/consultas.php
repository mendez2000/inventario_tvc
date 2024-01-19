<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");//incluyo este archivo que contiene la conexion y el host

    $tarea=$_POST["tarea"];// le mando este parametro que viene desde el metodo ajax 
        switch($tarea):
       

        case 'guardar':
             $mbd=DB::connect();DB::disconnect();
             $inventario=$_POST["inventario"];
            $marca=$_POST['marca'];
            $serie=$_POST["serie"];
            $service=$_POST["service"];
        	$tipo=$_POST["tipo"];
        	$tamano=$_POST["tamano"];
            $obs=$_POST["obs"];
            $fecha_compra=$_POST["fecha_compra"];

            if(!empty($inventario and $marca and $tipo)){
            $verifica=$mbd->query("SELECT contar_inventario('$inventario');");
            if ($verifica->fetchColumn()<>0){
                echo "|existe|";
            }else{

                if ($obs=="")
                {
                    $proof=$mbd->query("INSERT INTO monitor (num_inventario,id_marca,serie,serv_tag,tamano,tipo_monitor,observacion,fecha_compra)
                                VALUES ('$inventario', '$marca', '$serie', '$service', '$tamano', '$tipo', 'NINGUNA', '$fecha_compra')");
                    $proof11=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$inventario','MONITOR');");
                    echo "|guardado|"; 
                }
                else
                {
                    $proof=$mbd->query("INSERT INTO monitor (num_inventario,id_marca,serie,serv_tag,tamano,tipo_monitor,observacion,fecha_compra)
                                VALUES ('$inventario', '$marca', '$serie', '$service', '$tamano', '$tipo', '$obs', '$fecha_compra')");
                    $proof11=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$inventario','MONITOR');");

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
            $marca=$_POST['marca'];
            $serie=$_POST["serie"];
            $service=$_POST["service"];
            $tamano=$_POST["tamano"];
            $tipo=$_POST["tipo"];
            $fecha_compra=$_POST["fecha_compra"];
            $obs=$_POST["obs"];

                    if(!empty($inventario and $marca and $tipo)){
                        //$verifica=$mbd->query("SELECT count(*) from monitor where num_inventario='$inventario' and id_monitor!='$id';");
                        $verifica=$mbd->query("SELECT contar_inventariomonitor('$inventario','$id');");
                        if ($verifica->fetchColumn()==0){
                            
                            if ($obs=="")
                            {
                                $proof=$mbd->query("UPDATE monitor SET num_inventario='$inventario', id_marca='$marca', serie='$serie',serv_tag='$service',tamano='$tamano', tipo_monitor='$tipo',fecha_compra='$fecha_compra', observacion='NINGUNA' WHERE id_monitor='$id'");
                                echo "|actualizado|"; 
                            }
                            else
                            {
                                $proof=$mbd->query("UPDATE monitor SET num_inventario='$inventario', id_marca='$marca', serie='$serie',serv_tag='$service',tamano='$tamano', tipo_monitor='$tipo',fecha_compra='$fecha_compra', observacion='$obs' WHERE id_monitor='$id'");
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
            $id=$_POST["id"];
    

            if (!trim($id) == '') {
				
           $proof=$mbd->query("DELETE FROM marca WHERE id_marca='$id'");
          // $proof->execute();
				echo $id;
			}else{
                echo "Error";
            }
        break;

        case 'eliminar2':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST['id'];
           
            if(!empty($id)){
            


            $verifica=$mbd->query("SELECT num_inv_cpu 
                FROM detalle_cpu_monitor 
                WHERE id_monitor='$id'");
                if ($verifica->fetchColumn()==0){
                    $proof=$mbd->query("DELETE FROM detalle_cpu_monitor WHERE id_monitor='$id';");
                    $proof=$mbd->query("DELETE FROM monitor WHERE id_monitor='$id';");
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