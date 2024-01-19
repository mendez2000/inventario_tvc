<?php
$server  = $_SERVER['DOCUMENT_ROOT'];
include($server."/inventario/config/conexion2.php");
$tarea=$_POST["tarea"];
$combo=$_GET['combo'];

switch($tarea):
    case 'guardar':
        $mbd=DB::connect();
        $num_inventario=$_POST['num_inventario'];
        $marca=$_POST["marca"];
        $modelo=$_POST["modelo"];
        $clasificacion=$_POST["clasificacion"];
        $servT=$_POST["servT"];
        $garantia=$_POST["garantia"];
        $estado=$_POST["estado"];
        $operador=$_POST["operador"];
        $nombre_cpu=$_POST["nombre_cpu"];
        $usuarioSO=$_POST["usuarioSO"];
        $procesador=$_POST["procesador"];
        $ram=$_POST["ram"];
        $tvideo=$_POST["tvideo"];
        $ups=$_POST["ups"] != "" ? $_POST["ups"] : '';
        $edificio=$_POST["edificio"];
        $departamento=$_POST["departamento"];
        $ubicacion=$_POST["ubicacion"];
        $obs=$_POST["obs"];
        $id_user=$_POST["id_user"];
        //OPCIONES MULTIPLES
        $disco=$_POST["disco"];
        $monitor=$_POST["monitor"];
        $ip=$_POST["ip"] ?? null;;
    
        if ($obs=="")
        {
            $obs="NINGUNA";
        }
        
        if (!empty($num_inventario and  $marca and $clasificacion and $estado and $operador and $nombre_cpu and $procesador and $ram  and $edificio and $departamento and $ubicacion and $disco)) {
            $verifica=$mbd->query("SELECT contar_inventario('$num_inventario');");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|";
                }
                else
                {


                    if( $ups !=  "" ) {
                        $proof=$mbd->query("INSERT INTO cpu(num_inventario,id_marca,modelo,id_clasificacion,serv_tag,garantia,id_estado,id_empleado,nombre_cpu,usuario_windows,fecha_ingreso,id_procesador,id_ram,id_tarjeta_v,id_ups,id_edificio,id_depto,id_ubicacion,observacion,modificado_por) VALUES 
                        ('$num_inventario','$marca','$modelo','$clasificacion','$servT','$garantia','$estado','$operador','$nombre_cpu','$usuarioSO',CURDATE(),'$procesador','$ram','$tvideo','$ups','$edificio','$departamento','$ubicacion','$obs','$id_user')");

                        if($proof)
                        {
                            GuardarOpcionesMultiples($num_inventario,$disco,$monitor,$ip);
                            $proof11=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$num_inventario','CPU');");

                        }
                        else
                        {
                            echo "|mal|"; 
                        }
                    }
                    else{
                        $proof=$mbd->query("INSERT INTO cpu(num_inventario,id_marca,modelo,id_clasificacion,serv_tag,garantia,id_estado,id_empleado,nombre_cpu,usuario_windows,fecha_ingreso,id_procesador,id_ram,id_tarjeta_v,/* id_ups, */id_edificio,id_depto,id_ubicacion,observacion,modificado_por) VALUES 
                        ('$num_inventario','$marca','$modelo','$clasificacion','$servT','$garantia','$estado','$operador','$nombre_cpu','$usuarioSO',CURDATE(),'$procesador','$ram','$tvideo',/* '$ups', */'$edificio','$departamento','$ubicacion','$obs','$id_user')");

                    if($proof)
                    {
                        GuardarOpcionesMultiples($num_inventario,$disco,$monitor,$ip);
                        $proof11=$mbd->query("INSERT INTO equipo (num_inventario,descripcion) VALUES ('$num_inventario','CPU');");

                    }
                    else
                    {
                        echo "|mal|"; 
                    }
                    }

                } 
        } 
        else
        {
            echo "|vacio|";
        }

        break; //aqui termina la opcion insertar cpu


    case'editar':
        $mbd=DB::connect();
        //  $=$_POST[''];
        $id_cpu=$_POST['id_cpu'];
        $num_inventario=$_POST['num_inventario'];
        $marca=$_POST['marca'];
        $modelo=$_POST['modelo'];
        $clasificacion=$_POST['clasificacion'];
        $servT=$_POST['servT'];
        $garantia=$_POST['garantia'];
        $estado=$_POST['estado'];
        $operador=$_POST['operador'];
        $nombre_cpu=$_POST['nombre_cpu'];
        $usuarioSO=$_POST['usuarioSO'];
        $procesador=$_POST['procesador'];
        $ram=$_POST['ram'];
        $tvideo=$_POST['tvideo'];
        $ups= $_POST["ups"] != "" ? $_POST["ups"] : '';//
        $edificio=$_POST['edificio'];
        $departamento=$_POST['departamento'];
        $ubicacion=$_POST['ubicacion'];
        $obs=$_POST['obs'];
        $id_user=$_POST['id_user'];
        //opciones multiples
        $disco=$_POST['disco'];
        $monitor=$_POST['monitor'] ?? null;
        $ip= $_POST["ip"] ?? null;
        
        
        if (!empty($num_inventario and  $marca and $clasificacion and $estado and $operador and $nombre_cpu and $procesador and $ram  and $edificio and $departamento and $ubicacion and $disco)){
            $verifica=$mbd->query("SELECT contar_inventariocpu('$num_inventario','$id_cpu');");
            if ($verifica->fetchColumn()==0){
                $proof;
                if ($ups!= "") {
                    $proof=$mbd->query("UPDATE cpu SET num_inventario='$num_inventario',id_marca='$marca',modelo='$modelo',id_clasificacion='$clasificacion',serv_tag='$servT',garantia='$garantia',id_estado='$estado',id_empleado='$operador',nombre_cpu='$nombre_cpu',usuario_windows='$usuarioSO',id_procesador='$procesador',id_ram='$ram',id_tarjeta_v='$tvideo',id_ups='$ups',id_edificio='$edificio',id_depto='$departamento',id_ubicacion='$ubicacion',observacion='$obs',modificado_por='$id_user' WHERE id_cpu='$id_cpu'");
                }
                else{
                    $proof=$mbd->query("UPDATE cpu SET num_inventario='$num_inventario',id_marca='$marca',modelo='$modelo',id_clasificacion='$clasificacion',serv_tag='$servT',garantia='$garantia',id_estado='$estado',id_empleado='$operador',nombre_cpu='$nombre_cpu',usuario_windows='$usuarioSO',id_procesador='$procesador',id_ram='$ram',id_tarjeta_v='$tvideo',id_edificio='$edificio',id_depto='$departamento',id_ubicacion='$ubicacion',observacion='$obs',modificado_por='$id_user' WHERE id_cpu='$id_cpu'");
                }
                //echo "|actualizado|"; 
                if($proof){
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_disco WHERE num_inv_cpu='$num_inventario';");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_ip WHERE num_inv_cpu='$num_inventario';");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_monitor WHERE num_inv_cpu='$num_inventario';");
                    GuardarOpcionesMultiples($num_inventario,$disco,$monitor,$ip);
                    //echo "|bien|";
                }
                else 
                { 
                echo "|mal|"; 
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
        $num_inventario=$_POST["num_inventario"];
        echo"$num_inventario"; 
            if (!empty($num_inventario)) {


                $proof=$mbd->query("DELETE FROM cpu WHERE num_inventario='$num_inventario';");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_accesorio WHERE num_inv_cpu='$num_inventario'");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_disco WHERE num_inv_cpu='$num_inventario';");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_ip WHERE num_inv_cpu='$num_inventario';");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_monitor WHERE num_inv_cpu='$num_inventario';");
                    $proof1=$mbd->query("UPDATE licencia as lic INNER JOIN detalle_cpu_licencia as dt ON lic.id_licencia=dt.id_licencia set lic.disponibilidad=lic.disponibilidad+1 where dt.num_inv_cpu='$num_inventario<';");
                    $proof1=$mbd->query("DELETE FROM detalle_cpu_licencia WHERE num_inv_cpu='$num_inventario';");
                    echo "|exito|";
             
               
            }
            else{
                echo "|error|";
            }
            
    break;

    case'consultar':
        $mbd=DB::connect();
        $edificio=$_POST['edificio'];
        echo $edificio;
        $proof=$mbd->query("SELECT * FROM departamento WHERE id_edificio='$edificio';");                     
            while($row = $row = $proof->fetch(PDO::FETCH_ASSOC)){
                echo $row["id_departamento"]."-";
                echo $row["departamento"];
            }
        echo json_encode ($edificio);

    break;
    
        
//verificar si ya existe el numero de inventario
        case'verifica':  
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST["id"];
            $proof=$mbd->query(" select num_inventario from cpu where num_inventario='$id'");
            if($proof->fetchColumn()>0){
                  echo "existe";
                //   $id=$_POST['id'];
            }else{  echo $id;   }
            break;
    endswitch;



    //SWITCH PARA ACTUALIZAR LOS COMBOS
switch($combo):
    case 'ups':
    $consul="SELECT * from ups where not exists (select id_ups from cpu where cpu.id_ups=ups.id_ups);";
    $mbd=DB::connect();DB::disconnect();
    $proof=$mbd->query($consul);
    while ($row = $proof->fetch(PDO::FETCH_ASSOC))
    {
        echo "<option value='".$row["id_ups"]."'>";
        echo "Inv: ".$row["num_inventario"]."  Modelo: ".$row["modelo"];
        echo "</option>";
    }
    break;

    case 'monitor':
        $consul="SELECT monitor.id_monitor,monitor.num_inventario,marca.nombre_marca,monitor.tamano,monitor.tipo_monitor,monitor.fecha_compra from monitor INNER JOIN marca ON monitor.id_marca=marca.id_marca where not exists (select id_monitor from detalle_cpu_monitor where detalle_cpu_monitor.id_monitor=monitor.id_monitor);";
        $mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query($consul);
        while ($row = $proof->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$row["id_monitor"]."'>";
            echo "Inv. ".$row["num_inventario"]." marca ".$row["nombre_marca"]." Tamaño: ".$row["tamano"]." ".$row["tipo_monitor"]." compra ".$row["fecha_compra"];
            echo "</option>";
    
        }
    break;

    
    case 'ip':
        $consul="SELECT * from ipv4 where not exists (select id_ip from detalle_cpu_ip where detalle_cpu_ip.id_ip=ipv4.id_ip);";
        $mbd=DB::connect();DB::disconnect();
        $proof=$mbd->query($consul);
        while ($row = $proof->fetch(PDO::FETCH_ASSOC))
        {
        echo "<option value='".$row["id_ip"]."'>";
        echo $row["ip"];
        echo "</option>";
        }
    break; 
    
endswitch;

        
function GuardarOpcionesMultiples($num_inventario_cpu,$disco_cpu,$monitor_cpu,$ip_cpu){
$cpu=$num_inventario_cpu;
$mbdf=DB::connect();

    if (!empty($monitor_cpu)){
        foreach ($monitor_cpu as $row){
            $proof1=$mbdf->query("INSERT INTO detalle_cpu_monitor(num_inv_cpu,id_monitor) VALUES ('$cpu', '$row')");
        }
    }

    if ( !empty($ip_cpu) ){
        foreach ($ip_cpu as $row){
            $proof1=$mbdf->query("INSERT INTO detalle_cpu_ip(num_inv_cpu,id_ip) VALUES ('$cpu', '$row')");
        }
    }

    if(!empty($disco_cpu)){
        foreach ($disco_cpu as $row){
            $proof1=$mbdf->query("INSERT INTO detalle_cpu_disco(num_inv_cpu,id_disco) VALUES ('$cpu', '$row')");
        }
        echo "|guardado|";
    }
}



?>