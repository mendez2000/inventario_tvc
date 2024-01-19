<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");
    $tarea=$_POST["tarea"];

    switch($tarea):
        case 'guardar':
        $mbd=DB::connect();DB::disconnect();
        $categoria=$_POST['categoria'];
        if(!empty($categoria)){
          $verifica=$mbd->query("SELECT count(*) from categoria_software where categoria='$categoria';  ");
          if ($verifica->fetchColumn()<>0){
              echo "|existe|";
          }else{
              $proof=$mbd->query("INSERT INTO categoria_software (categoria) VALUES ('$categoria')"); 
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
          $id_categoria=$_POST['id_categoria'];
          $categoria=$_POST['categoria'];
          if(!empty($id_categoria and $categoria)){
            $verifica=$mbd->query("SELECT count(*) from categoria_software where categoria='$categoria' AND id_categoria!='$id_categoria';");
                if ($verifica->fetchColumn()<>0){
                  echo "|existe|";
                }else{
                    $proof=$mbd->query("UPDATE categoria_software SET categoria='$categoria' WHERE id_categoria='$id_categoria'");
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
            $proof=$mbd->query("DELETE FROM categoria_software WHERE id_categoria='$id';");
            }    
        break;

        
    endswitch;
?>