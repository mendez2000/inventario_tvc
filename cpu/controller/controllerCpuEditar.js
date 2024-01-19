
var contador_software=0;
 

$(document).ready(function(){
    let tabla=$("#veraccesorios").DataTable()
    let tabla1=$("#versoftware").DataTable()
    var inventario_cpu = $("#inventario").val();
    llenardatable2();
    llenardatable3();


    //generar numero de inventario aleatorio
    $("#generarInv").click(function () {
        var timestamp = event.timeStamp;
        var d = new Date();
        var seconds = d.getSeconds();
        var year= d.getFullYear();
        var x=year+""+seconds+""+timestamp;
        var SetInventario= x.substring(0, 9);
        $("#inventario").val(SetInventario);
        $("#cpu_actual").val(SetInventario);
    });


    $("#inventario").inputmask("99-999-9999");
    $("#cpu_actual").inputmask("99-999-9999");
    $("#num_accesorio").inputmask("99-999-9999");
    $("#ip").inputmask("999.999.999.999");
    $("select").select2();


    $('input[name="garantia"]').daterangepicker({
        autoUpdateInput: false,
        timepicker:false,
        opens: "center",
        cancelClass: "btn-danger",
        locale:{
            format:'DD/MM/YYYY',
            cancelLabel: 'Borrar'
        }
    });

    //esto es para que garantia inicie vacio
    $('input[name="garantia"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    //esto es para limpiar el campo de garntia
    $('input[name="garantia"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('input[name="fingreso"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });

    //permitir solo valores numericos en el campo de num inventario
    $("#inventario").focusout(function() {
        this.value = (this.value + '').replace(/[^0-9]/g, '');
        verificaId($(this).val());

        var maxChars = 11;
        if ($(this).val().length > maxChars) {

            toastr.error("Error","error al ingresar numero de inventario");
            $("#div_inventario").addClass("has-error");
            $("#error").removeClass("hidden");

        }
        if($(this).val().length == maxChars){
            $("#div_inventario").removeClass("has-error");
            $("#div_inventario").addClass("has-success");
            $("#error").addClass("hidden");

        }
    });


    //FUNCIONES PARA LOS SELECT DE EDIFICIO, DEPARTAMENTO Y UBICACION
    //habilitado
    $('#sldepartamento').prop('disabled', false);
    $('#slubicacion').prop('disabled', false);
    $("#sledificio").change(async function() {
        var edificio = $("#sledificio").val();
        
        //alert(edificio)
        const data=new FormData()
        data.append("id",edificio) 
        const res=await fetch("respuesta.php",{method:"POST",body:(data)})
        let selectdep=document.getElementById("sldepartamento")
        let selectubicacion=document.getElementById("slubicacion")
        const recibe=await res.json()
        console.log(recibe)
        selectdep.innerHTML=""
        selectubicacion.innerHTML=""
    
        let option=document.createElement("option")
        option.value=""
        option.setAttribute("disabled","")
        option.setAttribute("selected","")
        option.setAttribute("hidden","")
        selectdep.add(option)

        let option3=document.createElement("option")
        option3.value=""
        option3.setAttribute("disabled","")
        option3.setAttribute("selected","")
        option3.setAttribute("hidden","")
        selectubicacion.add(option3)

        recibe.forEach(function (item){
            let option2=document.createElement("option")
            option2.value=item.id_departamento
            option2.text=`${item.departamento}`
            selectdep.add(option2)
        }) 
    });



    $("#sldepartamento").change(async function() {
        var departamento = $("#sldepartamento").val();
        const data=new FormData()
        data.append("dep",departamento) 
        const respuesta=await fetch ("respuesta2.php",{method:"POST",body:(data)})
        let selectubi=document.getElementById("slubicacion")
        const recibe=await respuesta.json()
        console.log(recibe)
        selectubi.innerHTML=""
    
        let option=document.createElement("option")
        option.value=""
            option.setAttribute("disabled","")
            option.setAttribute("selected","")
            option.setAttribute("hidden","")
            selectubi.add(option)

        recibe.forEach(function (item){
            let option2=document.createElement("option")
            option2.value=item.id_ubicacion
            option2.text=`${item.ubicacion}`
            selectubi.add(option2)
        })
    });//fin select de LAS UBICACIONES FISICAS

    //MODAL DE ACCESORIOS
    $("#slnum_inv").change(async function() {
        if($("#slnum_inv").val() == "0"){
            document.getElementById("txtnum").value ="";
            document.getElementById("tipo").value ="";
            document.getElementById("modelo_acce").value ="";
            document.getElementById("serieacc").value ="";
            document.getElementById("marcaacc").value ="";
            document.getElementById("fecha_compra_acc").value="";
            
        }else{
            var accesorio = $("#slnum_inv").val();
            const data=new FormData()
            data.append("acc",accesorio) 
            const respuesta=await fetch ("respuesta3.php",{method:"POST",body:(data)})
            let selectnum=document.getElementById("slnum_inv")
            const recibe=await respuesta.json()
            console.log(recibe)
            selectnum.innerHTML=""

            recibe.forEach(function (item){
                document.getElementById("tipo").value =item.tipo_accesorio
                document.getElementById("modelo_acce").value =item.modelo
                document.getElementById("serieacc").value =item.serie
                document.getElementById("marcaacc").value =item.nombre_marca
                document.getElementById("fecha_compra_acc").value =item.fecha_compra
                document.getElementById("txtnum").value =item.num_inv_acc;
            })
            llenarselect();
        }
    });

    async function llenarselect() {
        const data2=new FormData()
        const respuesta2=await fetch ("respuesta4.php",{method:"POST",body:(data2)})
        let selectinv=document.getElementById("slnum_inv")
        const recibe2=await respuesta2.json()
        console.log(recibe2)
        selectinv.innerHTML=""
        let option=document.createElement("option")
        option.setAttribute("disabled","")
        option.setAttribute("selected","")
        
        selectinv.add(option)
    
        recibe2.forEach(function (item){
            let option2=document.createElement("option")
            option2.value=item.id_accesorio
            option2.text=item.num_inv_acc
            selectinv.add(option2)
        })
    }
    
    $("#agregaraccesorio").click(async function() {
        var accesorio = $("#txtnum").val();
        var cpu = $("#inventario").val();
        const data=new FormData()
        var tarea="guardar";
        data.append("tarea",tarea);
        data.append("cpu",cpu);
        data.append("acc",accesorio);
        const respuesta=await fetch ("guardar_detalle_accesorio.php",{method:"POST",body:(data)})
        const recibe=await respuesta.json()
        console.log(recibe)
        
                    if (recibe == "agregado")
                {
                    console.log(recibe)
                    toastr.success("Accesorio agregado!")
                    llenardatable();
                }
                else if (recibe == "vacio")
                {
                    console.log(recibe)
                    toastr.warning("Número de inventario faltante!")
                }
                else if (recibe == "asignado")
                {
                    
                    toastr.warning("Accesorio ya asignado a este CPU!")
                    
                }
        });

    function llenardatable() {
        tabla.row.add([document.getElementById("txtnum").value,document.getElementById("tipo").value,document.getElementById("modelo_acce").value,document.getElementById("marcaacc").value,"<button type='button' class='btn btn-flat btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></button>"
        ]).draw(false);
    }

    //FUNCION PARA QUE TRAIGA LOS ACCESORIOS YA ASIGNADOS A ESTE CPU
    async function llenardatable2(){ 
        var id_cpu_actual=$("#inventario").val();
        const data=new FormData()
        var tarea="traer";
        data.append("tarea",tarea);
        data.append("id_cpu_actual",id_cpu_actual)                    
        const res=await fetch("guardar_detalle_accesorio.php",{method:"POST",body:(data)})
        const recibe=await res.json()
        //console.log(recibe)
        
        recibe.forEach(function (item){
            tabla.row.add([item.num_inv_acc,item.tipo_accesorio,item.modelo,item.nombre_marca,"<button  type='button' id='eliminar_accesorio' name='eliminar_accesorio' class='btn btn-flat btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></button>"]).draw(false);
        })
    }

    $('#veraccesorios tbody').on('click', 'button.btn-danger', function () {
        var accesorioelim;
        accesorioelim=($(this).parent().parent().children()[0].innerHTML);
        console.log(accesorioelim);
        console.log(inventario_cpu);
        eliminar(accesorioelim);
        tabla
            .row( $(this).parents('tr'))
            .remove()
            .draw();
    });

    async function eliminar(accesorio_inventario){
        var tarea="eliminar";
        const data=new FormData()
        data.append("tarea",tarea);
        data.append("accesorio",accesorio_inventario);
        data.append("cpu",inventario_cpu);
        const respuesta=await fetch ("../accesorios/consultas.php",{method:"POST",body:(data)})
        const recibe=await respuesta.json()
        console.log(recibe)
        if (recibe == "eliminado")
        {
            toastr.success("Accesorio quitado!")
            llenarselect();
        }
    }

    $("#sl_software_cpu").change(async function() {
        if($("#sl_software_cpu").val() == "0"){
        }
        else
        {          
            //extraer el id
            var id_software = $("#sl_software_cpu").val();
            
            //el inventario de cpu
            var cpu_inv= $("#cpu_software").val();

            if (id_software!="" && cpu_inv!="")
            {
                const data=new FormData()
                data.append("id_soft",id_software) 
                data.append("cpu",cpu_inv) 
                const res=await fetch("respuesta5.php",{method:"POST",body:(data)})
                const recibe=await res.json()
                console.log(recibe)

                if (recibe == "existe")
                {
                    toastr.error("Software ya agregado a este CPU!")
                    
                }
                else
                {
                    recibe.forEach(function (item){
                        var id_software=item.id_software;
                        var producto=item.producto;
                        var marca=item.nombre_marca;
                        var edicion=item.edicion;
                        var version=item.version_;
                        var categoria=item.categoria;
                        llenardatable1(id_software,producto,marca,edicion,version,categoria); 
                    })
                }
            }
            else if (cpu_inv=="")
            {
                toastr.error("Inventario CPU faltante!")
            }                
        }//FIN VALIDACION IF
    });


    function llenardatable1(id_software,producto,marca,edicion,version,categoria){
        tabla1.row.add([id_software,producto,marca,edicion,version,categoria,"<button type='button' class='btn btn-flat btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></button>"
        ]).draw(false);
        toastr.success("Software agregado!")
        contador_software=contador_software+1;
    }

    //AL PRESIONAR QUITAR SOFTWARE
    $('#versoftware tbody').on('click', 'button.btn-danger', function () { 
        var softwareelim;
        softwareelim=($(this).parent().parent().children()[0].innerHTML);
        console.log(softwareelim);
        var cpu_inv2= $("#cpu_software").val();
        eliminarsoftware(softwareelim,cpu_inv2);

        tabla1
            .row( $(this).parents('tr'))
            .remove()
            .draw();
    });

    //ELIMINAR EL ID DE SOFTWARE DE LA TABLA Y VERIFICAR DONDE LO VA HACER PARA QUE REALICE LA TREA DE ELIMINADO
    async function eliminarsoftware(softwareelim,cpu_inv){
        var tarea="eliminar_licencia";
        const data=new FormData()
        data.append("tarea",tarea);
        data.append("softwareelim",softwareelim);
        data.append("cpu_inv",cpu_inv);
        
        const respuesta1=await fetch ("../licencia/consultas.php",{method:"POST",body:(data)})
        const recibe1=await respuesta1.json()
        console.log(recibe1)
        if (recibe1 == "delete")
        {
            toastr.success("Software quitado!")
            contador_software=contador_software-1;
        }
        else if (recibe1 == "vacio")
        {
            toastr.success("Falta Inventario CPU!")

        }

    }

    // FUNCION PARA QUE AGREGUE EL SOFTWARE DE CADA CPU
    async function llenardatable3(){ 
        var id_cpu_actual=$("#inventario").val();
        const data=new FormData()
        var tarea="traer_licencia";
        data.append("tarea",tarea);
        data.append("id_cpu_actual",id_cpu_actual)                    
        const res2=await fetch("../licencia/consultas.php",{method:"POST",body:(data)})
        const recibe2=await res2.json()
        
        recibe2.forEach(function (item){
            tabla1.row.add([item.id_software,item.producto,item.nombre_marca,item.edicion,item.version_,item.categoria,"<button  type='button' id='eliminar' name='eliminar' class='btn btn-flat btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></button>"]).draw(false);
        })
    }


    //FUNCION PARA QUE SELECCIONE EL SOFTWARE Y MOSTRAR SU LICENCIA
    $('#versoftware tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            
        } else {
            //aqui se seleccionó el item
            tabla1.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var item_soft;
            item_soft=($(this).children()[0].innerHTML);
            console.log(item_soft);
            consultarlicencia(item_soft);
        }  
    });

    async function consultarlicencia(id_soft){
        var tarea="consultar_licencia";
        const data=new FormData()
        data.append("tarea",tarea);
        data.append("id_soft",id_soft);
        
        
        const respuesta2=await fetch ("../licencia/consultas.php",{method:"POST",body:(data)})
        const recibe2=await respuesta2.json()
        console.log(recibe2)
        
        recibe2.forEach(function (item){
            var licencia=item.licencia;
            
            $("#nota_lic").val(licencia);
        })
    }


});     //fin del lector


    $("#editarcpu").click(function()
    {
        var id_cpu=$("#id_cpu_actual").val();
        var num_inventario = $("#inventario").val();
        var marca = $("#slmarca").val();
        var modelo = $("#modelocpu").val();
        var clasificacion = $("#slclasificacion").val();
        var servT= $("#servT").val();
        var garantia = $("#garantia").val();
        var estado = $("#slestado").val();
        var operador = $("#slusuariope").val();
        var nombre_cpu = $("#nombre_cpu").val();
        var usuarioSO=$("#usu_cpu").val();
        var procesador= $("#slprocesador").val();
        var ram = $("#slram").val();
        var tvideo= $("#slvideo").val();
        var ups = $("#slups").val();
        var edificio = $("#sledificio").val();
        var departamento = $("#sldepartamento").val();
        var ubicacion = $("#slubicacion").val();
        var obs = $("#observaciones_cpu").val();

        //opciones multiples
        var disco = $("#sldisco").val();
        var monitor = $("#monitor").val();
        var ip = $("#sl_ip").val();
        var id_user=$("#id_user").val();
        
            //VERIFICAR EN CONSULTAS LA PARTE DE EDITAR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $.ajax({
            type:"POST",
            url:"consultas_cpu.php",
            data:
            {
                tarea:"editar",
                id_cpu:id_cpu,
                num_inventario:num_inventario,
                marca:marca,
                modelo:modelo,
                clasificacion:clasificacion,
                servT:servT,
                garantia:garantia,
                estado:estado,
                operador:operador,
                nombre_cpu:nombre_cpu,
                usuarioSO:usuarioSO,
                procesador:procesador,
                ram:ram,
                tvideo:tvideo,
                ups:ups,
                edificio:edificio,
                departamento:departamento,
                ubicacion:ubicacion,
                obs:obs,
                id_user:id_user,
                //opciones multiples
                disco:disco,
                monitor:monitor,
                ip:ip,
                
            },
            success: function(data)
            {
                data=data.split("|");
                $.each(data, function(i, item) {
                    if (item=="vacio")
                    {
                        toastr.warning('Campo(s) faltante(s)');
                    }
                    else if (item=="guardado")
                    {
                        toastr.success('¡CPU actualizado exitosamente!');
                    }
                    else if (item=="existe")
                    {
                        toastr.error('Num. Inventario existente!');
                    }
    
                });
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                alert(thrownError);
                toast.error("No funciona ajax para guardar");
            }
        })//fin ajax

        //actualizar combos
        function uups() {
            $("#slups").load("consultas_cpu.php?combo=ups");
        }

        function umonitor() {
            $("#monitor").load("consultas_cpu.php?combo=monitor");
        }
        
        function uip() {
            $("#sl_ip").load("consultas_cpu.php?combo=ip");
        }

    });



    function verificaId(id) {
        $.ajax({
            type: "POST",
            url: "consultas_cpu.php",
            data: {
                tarea: 'verifica',
                id: id

            },
            success: function (data){
                if(data=="existe"){
                    toastr.error("ERROR", "Este numero de inventario ya existe");

                    $("#div_inventario").removeClass("has-success");
                    $("#div_inventario").addClass("has-error");
                    return;
                }if(data.length==11){
                    $("#div_inventario").removeClass("has-error");
                    $("#div_inventario").addClass("has-success");
                    $("#error").addClass("hidden");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    }

    function limpiarcampos(){
        
        document.getElementById("inventario").value=""; 
        document.getElementById("modelocpu").value="";
        document.getElementById("servT").value=""; 
        document.getElementById("garantia").value=""; 
        document.getElementById("servT").value=""; 
        document.getElementById("servT").value=""; 
                
        let selectmarca=document.getElementById("slmarca")
        let optionsl=document.createElement("option")
        optionsl.value=""
        optionsl.setAttribute("disabled","")
        optionsl.setAttribute("selected","")
        optionsl.setAttribute("hidden","")
        selectmarca.add(optionsl)
        
        let selectups=document.getElementById("slups")
        let option=document.createElement("option")
        option.value=""
        option.setAttribute("disabled","")
        option.setAttribute("selected","")
        option.setAttribute("hidden","")
        selectups.add(option)

    }

    function goBack(){ setTimeout(function(){  window.location.href="ver-ot.php";  }, 30); }

