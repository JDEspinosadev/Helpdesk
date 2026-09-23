function init(){
}

$(document).on("click", "#btnsoporte", function(){
    if($('#rol_id').val() == 1){
        $('#lbltitulo').html('Acceso Soporte');
        $('#btnsoporte').html("Acceso Usuario");
        $('#rol_id').val(2);
        $("#imgtipo").attr("src","public/2.jpg");
    } else {
        $('#lbltitulo').html('Acceso Usuario');
        $('#btnsoporte').html("Acceso Soporte");
        $('#rol_id').val(1);
        $("#imgtipo").attr("src","public/1.jpg");
    }
});

$(document).on("blur", "#usu_correo", function(){
    console.log("Script index.js cargado correctamente.");

    $("#usu_correo").on("blur", function() {
        var usu_correo = $(this).val().trim();
        console.log("Saliendo del campo correo. Valor:", usu_correo);

        if (usu_correo != ""){
            $.post("controller/usuario.php?op=get_user_img", {usu_correo: usu_correo}, function(data){
                console.log("Datos recibidos de PHP:",data);
                try{
                    var response = (typeof data === "string") ? JSON.parse(data) : data;
                    var ruta_base = "public/img/usuario/";
                    var foto = (response.usu_img) ? response.usu_img : "no_photo.png";
                    
                    $("#login_img").attr("src", ruta_base + foto + "?v=" + new Date().getTime());
                
                }catch(e){
                    console.error("Error al procesar JSON:", e);
                }
            });
        }
    });
});
init();