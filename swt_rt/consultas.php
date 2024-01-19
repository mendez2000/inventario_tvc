<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];
        switch($tarea):
       

        case 'guardar':
             $mbd=DB::connect();DB::disconnect();
            	$inventario=$_POST['inventario'];
                $tipo=$_POST["tipo"];
                $nombre=$_POST["nombre"];
                $marca=$_POST["marca"];
                $modelo=$_POST["modelo"]; 
                $total_puert=$_POST["total_puert"];
                $serie=$_POST["serie"];
                $plibres=$_POST["plibres"];
                $red=$_POST["red"];
                $usuario=$_POST["usuario"];
        		$pass=$_POST["pass"];
                $depto=$_POST["depto"];
                $estado=$_POST["estado"];
                $d_ubicacion=$_POST["d_ubicacion"];
                $ip=$_POST["ip"];
        		$descri=$_POST["descri"];
        		
       if (!trim($inventario) == '') {
           $proof=$mbd->query( "INSERT INTO swt_rt(num_inventario, nombre_equipo, id_marca, cant_puertos, port_dispo, serial, modelo, id_depto, id_ip, usuario, pass, red, tipo_equipo, id_estado, descripcion, d_ubicacion)
        VALUES ('$inventario', '$nombre', '$marca', '$total_puert','$plibres', '$serie', '$modelo', '$depto', '$ip', '$usuario', '$pass', '$red', '$tipo', '$estado', '$descri', '$d_ubicacion' )" );

           if($proof){ echo "|bien|"; }else{ echo "|mal|"; }

        } else{  echo "|mal|";  }

        break;
       

  case 'editar':
			$mbd=DB::connect();DB::disconnect();
                $id=$_POST['id'];
                $inventario=$_POST['inventario'];
                $tipo=$_POST["tipo"];
                $nombre=$_POST["nombre"];
                $marca=$_POST["marca"];
                $modelo=$_POST["modelo"]; 
                $total_puert=$_POST["total_puert"];
                $serie=$_POST["serie"];
                $plibres=$_POST["plibres"];
                $red=$_POST["red"];
                $usuario=$_POST["usuario"];
        		$pass=$_POST["pass"];
                $depto=$_POST["depto"];
                $estado=$_POST["estado"];
                $d_ubicacion=$_POST["d_ubicacion"];
                $ip=$_POST["ip"];
        		$descri=$_POST["descri"];

    

            if (!trim($inventario) == '') {
				
           $proof=$mbd->query("UPDATE swt_rt SET num_inventario='$inventario', nombre_equipo='$nombre',
                              id_marca='$marca', port_dispo='$plibres', serial='$serie', modelo='$modelo',
                              id_depto='$depto', id_ip='$ip', usuario='$usuario', pass='$pass', cant_puertos='$total_puert', red='$red', tipo_equipo='$tipo', id_estado='$estado',
                              descripcion='$descri', d_ubicacion='$d_ubicacion' WHERE id_swt_rt='$id'");

        if ($proof){  echo "|bien|"; } else{ echo "|mal|";}

			}else{  echo "|mal|";}
            break;


            case 'eliminar':
                $mbd=DB::connect();DB::disconnect();
                $id=$_POST["id"];
        
    
                if (!trim($id) == '') {
                    
               $proof=$mbd->query("DELETE FROM swt_rt WHERE id_swt_rt='$id'");
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
                $proof=$mbd->query("DELETE FROM swt_rt WHERE id_swt_rt='$id'");
                }    
            break;
    endswitch;
?>