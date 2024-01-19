<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
          $mbd=DB::connect();DB::disconnect();
          $tipo=$_POST['tipo'];

          if(!empty($tipo)){
            $verifica=$mbd->query("SELECT count(*) from tipo_accesorio where tipo_accesorio='$tipo';  ");
            if ($verifica->fetchColumn()<>0){
              echo "|existe|";
            }else{
              $proof=$mbd->query("INSERT INTO tipo_accesorio (tipo_accesorio) VALUES ('$tipo')");
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
          $id_taccesorio=$_POST['id_taccesorio'];
          $tipo_accesorio=$_POST['tipo_accesorio'];
          if(!empty($tipo_accesorio and $id_taccesorio)){
            $verifica=$mbd->query("SELECT count(*) from tipo_accesorio where tipo_accesorio='$tipo_accesorio';");
                if ($verifica->fetchColumn()<>0){
                  echo "|existe|";
                }else{
                  $proof=$mbd->query("UPDATE tipo_accesorio SET tipo_accesorio='$tipo_accesorio' WHERE id_taccesorio='$id_taccesorio'");
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
          $id=$_POST["id"];
          if (!empty($id)) {
            $proof=$mbd->query("DELETE FROM tipo_accesorio WHERE id_taccesorio='$id'");
          }
          else
          {
            echo "Error";
          }
        break;

        
    endswitch;
?>