link_inicio.dao = {

    inicio_sesion: function(){
        var data = new FormData($("#form_inicio")[0]);
        data.append("_token",$('input[name="_token"]').val());
        
        return $.ajax({
           type:"POST",
           dataType:"JSON",
           url:"login",
           data: data,
           processData: false,  // tell jQuery not to process the data
           contentType: false,  // tell jQuery not to set contentType
       });
    },

    registrar_usuario: function(){
        var data = new FormData($("#form_registro")[0]);
        data.append("_token",$('input[name="_token"]').val());
        
        return $.ajax({
           type:"POST",
           dataType:"JSON",
           url:"registro_usuario",
           data: data,
           processData: false,  // tell jQuery not to process the data
           contentType: false,  // tell jQuery not to set contentType
       });
    },

    

};