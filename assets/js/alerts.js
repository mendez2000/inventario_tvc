 function alert_success(titulo,mensaje){
        bootbox.dialog({
            message: mensaje,
            title: titulo,
            buttons: {
            success: {
                label: "Aceptar",
                className: "btn-success"
            }
            }
        });
    }
     function alert_danger(titulo,mensaje){
        bootbox.dialog({
            message: mensaje,
            title: titulo,
            buttons: {
            success: {
                label: "Aceptar",
                className: "btn-danger"
            }
            }
        });
         
    }
     function alert_info(titulo,mensaje){
        bootbox.dialog({
            message: mensaje,
            title: titulo,
            buttons: {
            success: {
                label: "Aceptar",
                className: "btn-primary"
            }
            }
        });
    }