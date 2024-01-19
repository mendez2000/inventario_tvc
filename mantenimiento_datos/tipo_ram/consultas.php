<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");

    $tarea=$_POST["tarea"];

    switch($tarea):
            case 'guardar':
                $mbd=DB::connect();
                $tipo_ram=$_POST["tipo"];
        
                if(!empty($tipo_ram)){
            
                    $verifica=$mbd->query("SELECT count(*) from tipo_ram where tipo_ram='$tipo_ram';");
                    if ($verifica->fetchColumn()<>0){
                        echo "|existe|"; 
                    }else{
                        $proof=$mbd->query("INSERT INTO tipo_ram(tipo_ram) VALUES ('$tipo_ram')");
                        echo "|guardado|";  
                    }                                                                         
                }
                else
                { 
                    echo "|vacio|"; 
            
                }
        
    break;


        case 'editar':
          $mbd=DB::connect();
          $id_tipo_ram=$_POST['id_tipo_ram'];
          $tipo_ram=$_POST['tipo'];

          if(!empty($id_tipo_ram and $tipo_ram)){
      
            $verifica=$mbd->query("SELECT count(*) from tipo_ram where tipo_ram='$tipo_ram' AND id_tipo_ram!='$id_tipo_ram';");
      
            if ($verifica->fetchColumn()<>0){
                echo "|existe|"; 
            }
            else
            {
                $proof=$mbd->query("UPDATE tipo_ram SET tipo_ram='$tipo_ram' WHERE id_tipo_ram='$id_tipo_ram'");
                echo "|actualizado|";  
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
                $proof=$mbd->query("DELETE FROM tipo_ram WHERE id_tipo_ram='$id';");
            }    
        break;

        
    endswitch;
?>