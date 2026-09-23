function init(){
    var usu_id = $("#user_idx").val();
    $.post("../../controller/usuario.php?op=mostrar", {usu_id:usu_id}, function(data){
        try{
            data = (typeof data === "string") ? JSON.parse(data) : data;

        $('#usu_nom').val(data.usu_nom);
        $('#usu_ap').val(data.usu_ap);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_telf').val(data.usu_telf);
        $('#usu_dep').val(data.usu_dep);

        if(data.usu_img != "" && data.usu_img != null){
            $('#previsualizacion_img').attr("src", "../../public/img/usuario/" + data.usu_img + "?t=" + new Date().getTime());
        }else{
            $('#previsualizacion_img').attr("src", "../../public/img/usuario/no_photo.png");
        }

        if (data.rol_id == "1"){
            $('#lblrol').html('<span class="label label-pill label-danger">' + data.rol_nom + '</span>');
        } else if (data.rol_id == "2"){
            $('#lblrol').html('<span class="label label-pill label-primary">' + data.rol_nom + '</span>');
        }else{
            $('#lblrol').html('<span class="label label-pill label-success">' + data.rol_nom + '</span>');
        }
    }catch(e){
        console.error("Error en OP Mostrar:", e);
        console.log("Respuesta del servidor:", data);
    }
});

    $.post("../../controller/usuario.php?op=stats", {usu_id:usu_id}, function(data){
        try {
            data = (typeof data === "string") ? JSON.parse(data) : data;
            $('#lbltotal').html(data.total);
            $('#lblabierto').html(data.abiertos);
            $('#lblcerrados').html(data.cerrados);
        } catch (e) {
            console.error("Error en OP Stats:", e);
        }
    });
}

$(document).ready(function(){
    init();
});

$(document).on("click", "#btnactualizar", function(){
    var pass = $("#txtpass").val().trim();
    var newpass = $("#txtpassnew").val().trim();

    if(pass.length == 0 || newpass.length == 0){
        Swal("Error!", "Los campos no pueden estar vacíos", "error");
    } else if(pass.length < 6){
        swal("Cuidado!", "La contraseña debe tener al menos 6 caracteres", "warning");
    } else {
        if(pass==newpass){
            var usu_id = $("#user_idx").val();
            $.post("../../controller/usuario.php?op=password", {usu_id:usu_id, usu_pass:newpass}, function(data){
                swal("Correcto!", "Contraseña actualizada correctamente ", "success");
                $("#txtpass").val("");
                $("#txtpassnew").val("");
                });
        } else {
            swal("Error!", "Las contraseñas no coinciden", "error");
        }
    }
});

$(document).on("change", "#usu_img_file", function(){
    var file = this.files[0];
    
    var reader = new FileReader();
    reader.onload = function(e){
        console.log("Cambiando imagen de previsualización...");
        $('#previsualizacion_img').attr('src', e.target.result);
    }
    reader.readAsDataURL(file);

    var formData = new FormData();
    formData.append('usu_id', $("#user_idx").val());
    formData.append('file', file);

    $.ajax({
        url: "../../controller/usuario.php?op=subir_img",
        type: "POST",
        data: formData, 
        contentType: false,
        processData: false,
        success: function(data){
            console.log("Respuesta servidor:", data);
            if(data == "1"){
                swal("Correcto!", "Foto de perfil actualizada correctamente ", "success");
            }else{
                swal("Error!", "Hubo un error al subir la imagen", "error");
            }
        }
    });
}
);
init();