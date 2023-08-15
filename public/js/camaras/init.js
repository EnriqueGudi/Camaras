$(function() {

    link_camaras.function.get_marcas();
    link_camaras.function.get_areas();
    

    $("#foto_ubi_cam").on("change", function(){
        var fullPath = $("#foto_ubi_cam").val();
        var startIndex = fullPath.lastIndexOf('\\') + 1;
        var filename = fullPath.substring(startIndex); 
        $("#file1").val(filename);
    });

    $("#cam_marca").on("change", function(){
        var modelosFiltrados = modelos.filter(function(modelo) {
            return modelo.id_marca == $("#cam_marca").val();
          });
        link_camaras.function.get_modelos(modelosFiltrados);
    });

    $("#area_ins").on("change", function(){
        var sitiosFiltrados = sitios.filter(function(sitio) {
            return sitio.id_area == $("#area_ins").val();
          });
        link_camaras.function.get_sitios(sitiosFiltrados);
    });

    $("#instalar_camara").on("click", function(){
        $("#display_mant_cam").hide();
        $("#display_baja_cam").hide();
        //$.when(linkcamara.function.get_areas()).done(function(){
            $("#display_ins_cam").show("slow")
        //});
    });

    $("#mantenimiento_camara").on("click", function(){
        $("#display_ins_cam").hide();
        $("#display_baja_cam").hide();
        $("#display_mant_cam").show("slow");
       
    });

    $("#baja_camara").on("click", function(){
        $("#display_mant_cam").hide();
        $("#display_ins_cam").hide();
        $("#display_baja_cam").show("slow")
    });
    $("#save_cam").on("click", function(){
        if($('#formucams').valid()){
            link_camaras.function.set_camara();
        }
    });

    $("#add_camera").on("click", function(){
        $('#cam_modelo').html("<option value>Seleccione...</option>");
        $("#formucams").trigger("reset");
    });

    $("#delete_cam").on("click", function(){
        link_camaras.function.delete_camara();
    });
    

    $("#instalar_camara").on("click", function(){
        $('#sitio_ins').html("<option value>Seleccione...</option>");
        $("#form_ins_cam").trigger("reset");
    });

    $('#formucams').validate({
        rules: {
            cam_marca:'required',
            cam_modelo: 'required',
            cam_no_serie: 'required',
            cam_name: 'required',
            cam_mac: 'required',
            file1: 'required',
            foto_ins_cam: 'required',
        },

        highlight: function(element) {     
            $(element).closest('.cont-input').addClass('has-error'); 
        },
        unhighlight: function(element) {      
           $(element).closest('cont-input').removeClass('has-error');   
        },
        success: function(label, element) {
            $(element).closest('.cont-input').removeClass('has-error');
        },
        //errorElement: 'span',
        errorPlacement: function(element) {      
           if(element.parent('.input-group').length) {         
               if(element.parent('cont-input').children('.error').length<=0){           
                    //error.insertAfter(element.parent());         
               }      
           } else {
               if(element.parent('cont-input').children('.error').length<=0) {            
                   //error.insertAfter(element);         
               }      
           }   
       }

        });
    


});