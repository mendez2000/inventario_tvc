<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
        $mbd=DB::connect();DB::disconnect();
        $clasificacion=$_POST['clasificacion'];
        $tipo=$_POST['tipo'];

        if(!empty($tipo and $clasificacion)){
          $verifica=$mbd->query("SELECT count(*) from clasificacion_licencia where clasificacion='$clasificacion' and tipo_identificador='$tipo';  ");
          if ($verifica->fetchColumn()<>0){
              echo "|existe|";
          }else{
              $proof=$mbd->query("INSERT INTO clasificacion_licencia (clasificacion,tipo_identificador) VALUES ('$clasificacion','$tipo')"); 
              echo "|guardado|"; 
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
          $tipo=$_POST['tipo'];
          $id=$_POST['id'];
          if(!empty($id and $clasificacion and $tipo)){
            $verifica=$mbd->query("SELECT count(*) from clasificacion_licencia where clasificacion='$clasificacion' and tipo_identificador='$tipo' AND id_clasificacion!='$id';");
                if ($verifica->fetchColumn()<>0){
                  echo "|existe|";
                }else{
                    $proof=$mbd->query("UPDATE clasificacion_licencia SET clasificacion='$clasificacion',tipo_identificador='$tipo' WHERE id_clasificacion='$id'");
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
            $proof=$mbd->query("DELETE FROM clasificacion_licencia WHERE id_clasificacion='$id';");
            }    
        break;

        
    endswitch;
?>