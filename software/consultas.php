<?php
    $server  = $_SERVER['DOCUMENT_ROOT'];
    include($server."/inventario/config/conexion2.php");//incluyo este archivo que contiene la conexion y el host

    $tarea=$_POST["tarea"];// le mando este parametro que viene desde el metodo ajax 
    
    switch($tarea):
       

        case 'guardar':
            $mbd=DB::connect();DB::disconnect();
            $producto=$_POST["producto"];
            $marca=$_POST['marca'];
            $edicion=$_POST["edicion"];
            $version=$_POST["version"];
            $categoria=$_POST["categoria"];
            $nota=$_POST["nota"];

            if(!empty($producto)){
                $verifica=$mbd->query("SELECT count(*) from software where producto='$producto' and id_marca='$marca' and edicion='$edicion' and version_='$version' and id_categoria='$categoria' and nota='$nota' ;");
                if ($verifica->fetchColumn()<>0){
                    echo "|existe|";
                }else{

                    if ($nota=="")
                    {
                        $proof=$mbd->query("INSERT INTO software (producto,id_marca,edicion,version_,id_categoria,nota)
                        VALUES ('$producto', '$marca', '$edicion', '$version', '$categoria', 'NINGUNA')");
                        echo "|guardado|"; 

                    }
                    else
                    {
                        $proof=$mbd->query("INSERT INTO software (producto,id_marca,edicion,version_,id_categoria,nota)
                        VALUES ('$producto', '$marca', '$edicion', '$version', '$categoria', '$nota')");
                        echo "|guardado|"; 
                    }
                    
                } 
            } 
            else
            {
                echo "|vacio|";
            }
        break;
       
        case 'guardado':
            $mbd=DB::connect();DB::disconnect();
            $producto=$_POST["producto"];
            $marca=$_POST["marca"];
            $edicion=$_POST["edicion"];
            $version=$_POST["version"];
            $categoria=$_POST["categoria"];
            $nota=$_POST["nota"];

            if(!empty($producto)){
                $verifica=$mbd->query("SELECT count(*) from software where producto='$producto' and id_marca='$marca' and edicion='$edicion' and version_='$version' and id_categoria='$categoria' ;");
                if ($verifica->fetchColumn()<>0){
                    echo json_encode ("existe");
                }else{
                    if ($nota=="")
                    {
                        $proof=$mbd->query("INSERT INTO software (producto,id_marca,edicion,version_,id_categoria,nota)
                                                 VALUES ('$producto', '$marca', '$edicion', '$version', '$categoria', 'NINGUNA')");
                        echo json_encode ("guardado"); 
                    }
                    else
                    {
                        $proof=$mbd->query("INSERT INTO software (producto,id_marca,edicion,version_,id_categoria,nota)
                                                 VALUES ('$producto', '$marca', '$edicion', '$version', '$categoria', '$nota')");
                        echo json_encode ("guardado"); 
                    }
                } 
            } 
            else
            {
                echo json_encode ("vacio");
            }
        break;

        case 'refrescar':
            $mbd=DB::connect();DB::disconnect();
            $array=$mbd->query("SELECT id_software,producto,marca.nombre_marca,edicion,version_,categoria_software.categoria,nota FROM `software` 
            LEFT JOIN marca ON marca.id_marca=software.id_marca
            LEFT JOIN categoria_software ON categoria_software.id_categoria=software.id_categoria;")->fetchAll();
            echo json_encode ($array);

        break;



        case 'editar':
            $mbd=DB::connect();DB::disconnect();
            $id=$_POST["id"];
            $producto=$_POST["producto"];
            $marca=$_POST['marca'];
            $edicion=$_POST["edicion"];
            $version=$_POST["version"];
            $categoria=$_POST["categoria"];
            $nota=$_POST["nota"];

            if(!empty($producto)){
                $verifica=$mbd->query("SELECT count(*) from software where producto='$producto' and id_marca='$marca' and edicion='$edicion' and version_='$version' and id_categoria='$categoria' and nota='$nota' AND id_software!='$id';");
                if ($verifica->fetchColumn()==0){
                    
                    if ($nota=="")
                    {
                        $proof=$mbd->query("UPDATE software SET producto='$producto', id_marca='$marca', edicion='$edicion',version_='$version',id_categoria='$categoria', nota='NINGUNA' WHERE id_software='$id';");
                        echo "|actualizado|"; 
                    }
                    else
                    {
                        $proof=$mbd->query("UPDATE software SET producto='$producto', id_marca='$marca', edicion='$edicion',version_='$version',id_categoria='$categoria', nota='$nota' WHERE id_software='$id';");
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
            $id=$_POST['id'];
            if(!empty($id)){
            $proof=$mbd->query("DELETE FROM  software WHERE id_software='$id' and  NOT EXISTS (SELECT * FROM licencia WHERE id_software = '$id');");
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