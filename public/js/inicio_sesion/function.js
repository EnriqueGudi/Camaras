link_inicio.function = {

    inicio_sesion:function(){

        var ajax = link_inicio.dao.inicio_sesion();
        ajax.done(function(response){
            if (response.type == 'success') {
                window.location.href = response.redirect;
            }else if(response.type=="warning"){
                swal("Aviso!", response.message, response.type);
            }
        }).fail(function (){
            swal("Aviso!", "Hubo algun error", "error");
        });

    },

    nuevo_usuario:function(){
        window.location.href = "registro_usuario";
    },

    registrar_usuario:function(){

        var ajax = link_inicio.dao.registrar_usuario();
        ajax.done(function(response){
            if (response.type == 'success') {
                Swal.fire({
                    title: 'Se ah enviado un correo de verificación a su correo.',
                    icon: 'success',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonText: 'Aceptar',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = response.redirect;
                    }
                  });
            }else if(response.type=="warning"){
                swal("Aviso!", response.message, response.type);
            }
        }).fail(function (){
            swal("Aviso!", "Hubo algun error", "error");
        });

    },

};