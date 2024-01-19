/**
 * Created by ENLMovil1 on 2/5/2017.
 */


$(document).ready(function(){

    $("select").select2();

       



    

   
    //FUNCION PARA HABILITAR LOS SELECT DE LA UBICACION FISICA
    $("#slclasificacion").change(async function() {
        if($("#slclasificacion").val() == "0")
        {
           
        }
        else
        {
            //habilitado
            
            var id_clasificacion = $("#slclasificacion").val();
            var tarea="consultar";

            const data=new FormData()
            data.append("tarea",tarea) 
            data.append("id_clasificacion",id_clasificacion) 
            const res=await fetch("consultas.php",{method:"POST",body:(data)})
            const recibe=await res.json()
            console.log(recibe)
        
            

            recibe.forEach(function (item){
                var clasificacion_licencia;
                clasificacion_licencia=item.clasificacion
                tipo_identificador=item.tipo_identificador

                if (tipo_identificador=="ID"){
                    document.getElementById("id_licencia").value ="";
                    toastr.info('Ingrese CLAVE de la licencia');

                }
                else if (tipo_identificador=="NOMENCLATURA"){
                    toastr.info('definido por NOMENCLATURA');
                    asignar_nomenclatura(clasificacion_licencia);
                }



            })
        }
    });

    $("#slrecurrente").change(async function() {
        if($("#slrecurrente").val() == "NO")
        {
            //desabilitado
            $('#duracion').prop('disabled', true);
            document.getElementById("duracion").value ="0";
        }
        else
        {
            //habilitado
            $('#duracion').prop('disabled', false);
        }
    });

});     //fin del lector




$("#guardar").click(function()
{
    var clasificacion= $("#slclasificacion").val();
    var id_licencia = $("#id_licencia").val();
    var software= $("#slsoftware").val();
    var dia= $("#dia").val();
    var mes= $("#mes").val();
    var anio= $("#anio").val();
    var duracion= $("#duracion").val();
    var slrecurrente= $("#slrecurrente").val();
    var cantidad= $("#cantidad").val();
    var nota= $("#nota_lic").val();
    var incremento= $("#incremento").val();

    numeroCaracteres = anio.length;
    //console.log(numeroCaracteres) para verificar un año válido;

    if (slrecurrente=="SI" && duracion=="")
    {
        toastr.info('Ingrese el tiempo de duración por favor!');
    }
        else if (slrecurrente=="SI" && duracion=="0")
        {
            toastr.info('La duración debe ser mayor a 0!');
        }

        else if (dia=="" || mes=="" || anio=="")
        {
            guardar(clasificacion,id_licencia,software,dia,mes,anio,duracion,slrecurrente,cantidad,incremento,nota);
        }
        else if (mes>12)
            {
                toastr.info('Mes inválido!');
            }
                else if (mes=="1" || mes=="3" || mes=="5" || mes=="7" || mes=="8" || mes=="10" || mes=="12")
                {
                    if (dia>31)
                    {
                        toastr.info('Día inválido!');
                    }
                    else if (numeroCaracteres>4)
                    {
                        toastr.info('Año inválido!');
                    }
                    else
                    {
                        guardar(clasificacion,id_licencia,software,dia,mes,anio,duracion,slrecurrente,cantidad,incremento,nota);
                    }
                }
                    else if (mes=="4" || mes=="6" || mes=="9" || mes=="11")
                    {
                        if (dia>30)
                        {
                            toastr.info('Día inválido!');
                        }
                        else if (numeroCaracteres>4)
                        {
                            toastr.info('Año inválido!');
                        }
                        else
                        {
                            //toastr.info('BIEN!');
                            guardar(clasificacion,id_licencia,software,dia,mes,anio,duracion,slrecurrente,cantidad,incremento,nota);
                        }

                    }
                        else if (mes=="2")
                        {     
                            if (anio=="2016" || anio=="2012" || anio=="2000" || anio=="2004" || anio=="2008"  || anio=="2020" || anio=="2024" || anio=="2028" || anio=="2032" || anio=="2036")
                            {
                                if (dia>29)
                                {
                                    toastr.info('Día inválido!');
                                }
                                else if (numeroCaracteres>4)
                                {
                                    toastr.info('Año inválido!');
                                }
                                else
                                {
                                    //toastr.info('BIEN!');
                                    guardar(clasificacion,id_licencia,software,dia,mes,anio,duracion,slrecurrente,cantidad,incremento,nota);
                                }
                            }
                            else
                            {
                                if (dia>28)
                                {
                                    toastr.info('Día inválido!');
                                }
                                else if (numeroCaracteres>4)
                                {
                                    toastr.info('Año inválido!');
                                }
                                else
                                {
                                    //toastr.info('BIEN!');
                                    guardar(clasificacion,id_licencia,software,dia,mes,anio,duracion,slrecurrente,cantidad,incremento,nota);
                                }


                            }
                        } // fin validaciones
                });



    function guardar(clasificacion,id_licencia,software,dia,mes,anio,duracion,slrecurrente,cantidad,incremento,nota){
        $.ajax({
            type:"POST",
            url:"consultas.php",
            data:
            {
                tarea:"editar",
                clasificacion:clasificacion,
                id_licencia:id_licencia,
                software:software,
                dia:dia,
                mes:mes,
                anio:anio,
                duracion:duracion,
                slrecurrente:slrecurrente,
                cantidad:cantidad,
                incremento:incremento,
                nota:nota
            },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {
                    if (item=="actualizado"){
                        toastr.success('Éxito','Actualizado correctamente');
                        limpiarcampos();
                    }
                    else if (item=="existe")
                    {
                        toastr.error('Error','Licencia existente!');

                    }
                    else if (item=="vacio")
                    {
                        toastr.warning('Campos vacíos!');

                    }else if (item=="invalida")
                    {
                        toastr.error('Error','Cantidad de asientos inválida!');
                    }
                    else if (item=="tope")
                    {
                        toastr.success('Éxito','Asientos han llegado a su tope,Actualizado!');
                        limpiarcampos();
                    }

                });
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                alert(thrownError);
                alert("No funciona ajax para guardar");
            }
        })
    }
    
     
     
 


 
                    
    function limpiarcampos(){
        document.getElementById("id_licencia").value="";
        document.getElementById("dia").value="";
        document.getElementById("mes").value="";
        document.getElementById("anio").value="";
        document.getElementById("duracion").value="";
        document.getElementById("cantidad").value="";
        document.getElementById("nota_lic").value="";


            //LIMPIAR LOS SELCT
            let selectmarca=document.getElementById("slclasificacion")
            let optionmodaldis=document.createElement("option")
            optionmodaldis.value=""
            optionmodaldis.setAttribute("disabled","")
            optionmodaldis.setAttribute("selected","")
            optionmodaldis.setAttribute("hidden","")
            selectmarca.add(optionmodaldis)  

            let selectmarca2=document.getElementById("slsoftware")
            let optionmodaldis2=document.createElement("option")
            optionmodaldis2.value=""
            optionmodaldis2.setAttribute("disabled","")
            optionmodaldis2.setAttribute("selected","")
            optionmodaldis2.setAttribute("hidden","")
            selectmarca2.add(optionmodaldis2) 

            let selectmarca3=document.getElementById("slrecurrente")
            let optionmodaldis3=document.createElement("option")
            optionmodaldis3.value=""
            optionmodaldis3.setAttribute("disabled","")
            optionmodaldis3.setAttribute("selected","")
            optionmodaldis3.setAttribute("hidden","")
            selectmarca3.add(optionmodaldis3) 
       
    }



function asignar_nomenclatura(clasificacion){
    document.getElementById("id_licencia").value = "";
    document.getElementById("id_licencia").value = clasificacion+"-";
}




