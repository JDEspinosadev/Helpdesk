/* Declaración de variables globales */
var motivoReapertura = "";

/* Función para capturar parámetros de la URL */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0].toLowerCase() === sParam.toLowerCase()) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return null;
};

var tick_id = getUrlParameter('id');
console.log("ID capturado:", tick_id);

$(document).ready(function() {
    if (tick_id) {
        console.log("ID detectado correctamente: " + tick_id);
        
        /* Inicializar Summernotes */
        $('#tickd_descrip').summernote({
            height: 300,
            lang: 'es-ES',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $('#tickd_descripusu').summernote({ height: 200, lang: 'es-ES' });
        $('#tickd_descripusu').summernote('disable');

        /* Cargar información inicial */
        listardetalle(tick_id);
        cargarDocumentos(tick_id);
        
    } else {
        console.error("ERROR: No se encontró ID en la URL.");
        swal("Error", "No se pudo identificar el ticket", "error");
    }
});

/* Cargar tabla de documentos adjuntos */
function cargarDocumentos(id) {
    $("#documentos_data").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "ajax":{
            url: '../../controller/documento.php?op=listar',
            type : "post",
            data: { tick_id : id },
            dataType : "json",
            error: function(e){ console.log(e.responseText); }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" }
    });
}

/* Cargar detalle del ticket y línea de tiempo */
function listardetalle(id){
    // Historial de respuestas (Asegúrate de tener <table id="detalle_data"> en tu HTML)
    $('#detalle_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": false,
        "ajax":{
            url: '../../controller/ticket.php?op=listardetalle',
            type : "post",
            data: { tick_id : id },
            dataType : "json",
            dataSrc: "aaData"
        },
        "columnDefs":[
            {"targets": [0], "width": "15%"},
            {"targets": [1], "width": "70%"},
            {"targets": [2], "width": "15%"}
        ],
        "bDestroy": true,
        "responsive": true,
        "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" }
    });

    // Información de cabecera
    $.post("../../controller/ticket.php?op=mostrar", { tick_id : id }, function(data){
        try {
            var jsondata = (typeof data === 'string') ? JSON.parse(data) : data;
            
            var usu_id_sesion = $('#user_idx').val();
            var rol_id_sesion = $('#rol_idx').val();

            // Sincronizar campos
            $('#lblnomusuario').html((jsondata.usu_nom || "") + ' ' + (jsondata.usu_ap || ""));
            $('#lblfechcrea').html(jsondata.fech_crea || "");
            $('#lblnomidticket').html("Detalle Ticket - INGS-" + (jsondata.tick_id || ""));
            $('#div_nom').val(jsondata.div_nom || "");
            $('#novedad').val(jsondata.novedad || "");
            $('#canal_nom').val(jsondata.canal_nom || "");
            $('#tickd_descripusu').summernote('code', jsondata.tick_descripcion || "");

            // Lógica de estados (Abierto / Cerrado)
            var estado = (jsondata.tick_estado_texto || "").trim().toLowerCase();
            $('#lblestado').removeClass('label-danger label-success').addClass('label label-pill');

            if(estado === "cerrado"){
                $('#lblestado').addClass('label-danger').html("Cerrado");
                $('#pnldetalle, #btnenvia, #btncerrarticket').hide();
                $('#btnreabrirticket').show();
            } else {
                $('#lblestado').addClass('label-success').html("Abierto");  
                $('#pnldetalle, #btnenvia, #btncerrarticket').show();
                $('#btnreabrirticket').hide();
            }

            // Modo Lectura para técnicos
            if(rol_id_sesion == 2 && jsondata.usu_asig != null && jsondata.usu_asig != 0 && jsondata.usu_asig != usu_id_sesion){
                $('#pnldetalle, #btnenvia, #btncerrarticket, #btnreasignar').hide();
                if ($('#modo_lectura_aviso').length === 0) {
                    $('#lblestado').after('<span id="modo_lectura_aviso" class="label label-pill label-warning" style="margin-left:10px;">Modo Lectura</span>');
                }
            } else {
                $('#modo_lectura_aviso').remove();
            }

        } catch(e) { console.error("Error al procesar JSON:", e); }
    });
}

/* EVENTOS DE BOTONES */

// Enviar nueva respuesta
$(document).on("click", "#btnenvia", function(){
    var usu_id = $('#user_idx').val();
    var descrip_summernote = $('#tickd_descrip').summernote('code');

    if($('#tickd_descrip').summernote('isEmpty')){
        Swal.fire("Advertencia","Debe ingresar una descripción","warning");
    } else {
        var mensajeFinal = descrip_summernote;

        if(motivoReapertura !== "") {
            var fecha = new Date().toLocaleString();
            mensajeFinal = "<br><hr><p><strong>[Ticket reabierto el " + fecha + "]:</strong><br>" +
                           "<strong>Motivo:</strong> " + motivoReapertura + "<br>" +
                           "<strong>Descripción:</strong>" + descrip_summernote + "</p>";
        }

        $.post("../../controller/ticket.php?op=insertardetalle", {
            tick_id : tick_id, 
            usu_id : usu_id, 
            tickd_descrip : mensajeFinal
        }, function(data){
            motivoReapertura = "";
            listardetalle(tick_id);
            $('#tickd_descrip').summernote('reset');
            swal("Correcto!","Detalle registrado","success");
        });
    }    
});

// Reasignar Agente
$(document).on("click", "#btnreasignar", function(){
    $.post("../../controller/usuario.php?op=combo", function(data){
        $('#usu_asig').html(data);
        $('#modalreasignar').modal('show');
    });
});

$(document).on("click", "#btn_ejecutar_reasignacion", function(){
    var usu_asig = $('#usu_asig').val();
    var usu_asig_nom = $('#usu_asig option:selected').text();
    var usu_id = $('#user_idx').val();

    if(usu_asig === "") {
        Swal.fire("Error","Debe seleccionar un agente","warning");
    } else {
        $.post("../../controller/ticket.php?op=reasignar", {
            tick_id : tick_id,
            usu_asig : usu_asig,
            usu_asig_nom: usu_asig_nom,
            usu_id_remitente : usu_id
        }, function(data){
            $('#modalreasignar').modal('hide');
            swal("¡Asignado!", "Ticket reasignado a: " + usu_asig_nom, "success");
            listardetalle(tick_id);
        });
    }
});

// Cerrar Ticket
$(document).on("click", "#btncerrarticket", function(){
    var usu_id = $('#user_idx').val();

    swal({
        title: "HelpDesk",
        text: "¿Está seguro de cerrar el ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/ticket.php?op=update", {tick_id : tick_id, usu_id : usu_id}, function(data){
                swal({
                    title:"HelpDesk!",
                    text: "Ticket Cerrado Correctamente.",
                    type: "success"
                }, function() {
                    location.reload();
                });
            });
        }    
    });
});

// Reabrir Ticket
$(document).on("click", "#btnreabrirticket", function(){        
    swal({
        title: "HelpDesk",
        text: "Ingrese el motivo de la reapertura",
        type: "input",
        showCancelButton: true,
        inputPlaceholder: "Escribe el motivo aquí...",
        closeOnConfirm: false
    }, function(inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("¡Debe escribir un motivo!");
            return false
        }

        motivoReapertura = inputValue;
        $.post("../../controller/ticket.php?op=reabrir", { tick_id : tick_id }, function(data){
            swal("¡Éxito!", "El ticket se ha reabierto.", "success");
            listardetalle(tick_id);
            $('body').css('overflow', 'auto');
        });
    });
});