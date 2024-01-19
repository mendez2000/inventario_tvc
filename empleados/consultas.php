<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");

        $tarea=$_POST["tarea"];// le mando este parametro que viene desde el metodo ajax 
switch($tarea):
  case 'guardar':
        $mbd=DB::connect();DB::disconnect();
        $telefono=$_POST['telefono'];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $correo=$_POST["correo"];
        $departamento=$_POST["departamento"];


        if(!empty($nombre and $apellido and $departamento)){
          $verifica=$mbd->query("SELECT count(*) from empleados where nombre='$nombre' AND apellido='$apellido' and id_departamento='$departamento';");
          if ($verifica->fetchColumn()<>0){
              echo ("|existe|"); 
          }else{
              $proof=$mbd->query("INSERT INTO empleados(nombre, apellido, telefono, correo, id_departamento)VALUES ( '$nombre', '$apellido',  '$telefono', '$correo','$departamento')");
              echo ("|guardado|");  
          }                                                                         
          }
          else
          { 
              echo ("|vacio|"); 
          }
        break;
       
  case'editar':
			$mbd=DB::connect();DB::disconnect();
      $id=$_POST["id"];
      $telefono=$_POST['telefono'];
      $nombre=$_POST["nombre"];
      $apellido=$_POST["apellido"];
      $correo=$_POST["correo"];
      $departamento=$_POST["departamento"];

      //comparar
      if(!empty($nombre and $apellido and $departamento)){
        $verifica=$mbd->query("SELECT count(*) from empleados where nombre='$nombre' AND apellido='$apellido';");
        if ($verifica->fetchColumn()<>0){
          echo ("|existe|"); 
        }else{
            $proof=$mbd->query("UPDATE empleados SET nombre='$nombre',apellido='$apellido',  telefono='$telefono', correo='$correo', id_departamento='$departamento' WHERE id_empleado='$id';");
            echo ("|actualizado|"); 
        }                                                                         
        }
        else
        { 
          echo ("|vacio|");
        }
    break;

    case'eliminar':
      $mbd=DB::connect();DB::disconnect();
      $id=$_POST['id'];
      if(!empty($id)){
      $proof=$mbd->query("DELETE FROM usuario_sistema WHERE id_empleado='$id'");
      $proof1=$mbd->query("DELETE FROM empleados WHERE id_empleado='$id'");
      }    
    break;

    endswitch;
?>