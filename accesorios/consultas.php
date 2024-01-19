<?php
//CONSULTAS DE LA PANTALLA ACCESORIOS
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];
        switch($tarea):
      
        case 'guardar':
             $mbd=DB::connect();DB::disconnect();

            $inventario=$_POST['inventario'];
            $tipo=$_POST["tipo"];
            $modelo=$_POST["modelo"];
        	$serie=$_POST["serie"];
            $marca=$_POST["marca"];
            $descri=$_POST["descripcion"];
            $fecha_compra=$_POST["fecha"];

            if(!empty($inventario and $tipo and $marca)){
                $verifica=$mbd->query("SELECT contar_inventario('$inventario');");
                while($row = $row = $verifica->fetch(PDO::FETCH_ASSOC)){
                    
                    $existe=$row["contar_inventario('".$inventario."')"];
                    if ($existe==0){
                        //NO HAY UN EQUIPO CON ESTE INVENTARIO
                        if ($descripcion=="")
                        {
                            $proof=$mbd->query("INSERT INTO accesorio (num_inv_acc,modelo,descri,serie,id_taccesorio,id_marca,fecha_compra) VALUES ('$inventario','$modelo','NINGUNA','$serie','$tipo','$marca','$fecha_compra')");
                            $proof1=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$inventario','ACCESORIO');");

                            echo "|guardado|";
                        }
                        else
                        {
                            $proof=$mbd->query("INSERT INTO accesorio (num_inv_acc,modelo,descri,serie,id_taccesorio,id_marca,fecha_compra) VALUES ('$inventario','$modelo','$descri','$serie','$tipo','$marca','$fecha_compra')");
                            $proof1=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$inventario','ACCESORIO');");

                            echo "|guardado|"; 
                        }
                    }
                    else
                    {
                        echo "|existe|";
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
            $id=$_POST['id'];
            $inventario=$_POST['inventario'];
            $tipo=$_POST["tipo"];
            $modelo=$_POST["modelo"];
            $serie=$_POST["serie"];
            $marca=$_POST["marca"];
            $fecha=$_POST["fecha"];
            $descri=$_POST["descri"];
        

            if(!empty($inventario and $tipo and $marca)){
                $verifica=$mbd->query("SELECT contar_inventarioaccesorio ('$inventario','$id');");
                if ($verifica->fetchColumn()==0){

                    if ($descri=="")
                    {                
                        $proof=$mbd->query("UPDATE accesorio SET num_inv_acc ='$inventario', modelo='$modelo', descripcion='NINGUNA',serie='$serie',id_taccesorio='$tipo', id_marca='$marca',fecha_compra='$fecha' WHERE id_accesorio='$id';");
                        echo "|actualizado|"; 
                    }
                    else
                    {
                        $proof=$mbd->query("UPDATE accesorio SET num_inv_acc ='$inventario', modelo='$modelo', descri='$descri',serie='$serie',id_taccesorio='$tipo', id_marca='$marca',fecha_compra='$fecha' WHERE id_accesorio='$id';");
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
            $accesorio=$_POST['accesorio'];
            $cpu=$_POST['cpu'];

            if(!empty($accesorio and $cpu)){
            $proof=$mbd->query("DELETE FROM detalle_cpu_accesorio WHERE num_inv_accesorio='$accesorio' and num_inv_cpu='$cpu';");
                if($proof)
                    {
                        echo json_encode ("eliminado");

                    }
            }    
        break;

            
        case 'eliminar2':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST['id'];

            if(!empty($id)){
            $proof=$mbd->query("DELETE FROM detalle_cpu_accesorio WHERE num_inv_accesorio=(SELECT num_inv_acc FROM accesorio WHERE id_accesorio='$id');");
            $proof=$mbd->query("DELETE FROM accesorio WHERE id_accesorio='$id';");
            }    
        break;


        endswitch;
?>