var tabla;
var usu_id;
var rol_id;

function init(){
    
    $("#ticket_form").on("submit",function(e){
        guardar_asignacion(e);
    });
}

$(document).ready(function(){

    usu_id = $('#user_idx').val();
    rol_id = $('#rol_idx').val();

    tabla=$('#ticket_data').dataTable({
        "aProcessing":true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        "ajax":{
            url: '../../controller/ticket.php?op=listar',
            type : "post",
            data:{ usu_id : usu_id, rol_id : rol_id },
            dataType : "json",
            dataSrc: "aaData",
            error: function(e){console.log(e.responseText);}
        },
        "columns": [
            {"data": "0"},
            {"data": "1"},
            {"data": "2"},
            {"data": "3"},
            {"data": "4"},
            {"data": "5"},
            {"data": "6"},
            {
                "data": null,
                "render": function (data, type, row){
                    return '<button type="button" onClick="ver('+ row[0].replace('INGS-', '') +');" class="btn btn-inline btn-primary btn-sm"><i class= "fa fa-eye"></i></button>';
                }
            }
        ],
        "columnDefs":[
            { "targets": 0, "width": "5%"},
            { "targets": 1, "width": "10%"},
            { "targets": 2, "width": "30%"},
            { "targets": 3, "width": "5%"},
            { "targets": 4, "width": "10%"},
            { "targets": 5, "width": "10%"},
            { "targets": 6, "width": "15%"},
            { "targets": 7, "width": "5%"}
        ],
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth":false,
        "language": {
            "sUrl": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },    
    });
});

function ver(tick_id){
            window.location.href = 'http://localhost/Helpdesk/view/DetalleTicket/?id='+ tick_id;
}

function asignarTicket(tick_id){

    if(rol_id !=1){
        swal("Error", "Solo el administrador puede reasignar agentes", "error");
        return;
    }

    $('#mdltitulo').html('Asignar Agente de Soporte');
    $('#tick_id').val(tick_id);

    $.post("../../controller/ticket.php?op=combo_soporte", function(data){
        if($('#usu_asig'). hasClass("select2-hidden-accessible")){
            $('#usu_asig').select2('destroy');
        }
        
        $('#usu_asig').empty().append(data);

        setTimeout(function(){
            $('#usu_asig').select2({
                dropdownParent: $('#modalasignar'),
                width: '100%',
                placeholder: "Seleccione  un agente"
            });
        }, 200);
    });
        
    $('#modalasignar').modal('show');
}


function guardar_asignacion(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    var usu_asig_nom = $('#usu_asig option:selected').text();
    formData.append('usu_asig_nom', usu_asig_nom);
    
    $.ajax({
        url: "../../controller/ticket.php?op=reasignar",
        type: "POST",   
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            $('#modalasignar').modal('hide');
            $('#ticket_data').DataTable().ajax.reload();
            swal("Asignado!", "El ticket se ha reasignado correctamente.", "success");
        }
    });
}    


function guardar(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    $.ajax({
        url: "../../controller/ticket.php?op=asignar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            var tick_id = $('#tick_id').val();
            $.post("../../controller/email.php?op=ticket_asignado",{ tick_id : tick_id }, function(data){
        });
        swal("Asignado!", "El ticket se ha asignado correctamente.", "success");
        $('#modalasignar').modal('hide');
        $('#ticket_data').DataTable().ajax.reload();
        }
    });
}

function CambiarEstado(tick_id){
    swal({
        title: "HelpDesk",
        text: "¿Está seguro de reabrir el ticket?",
        type: "warning",
        showcancelButton: true,
        confirmButtonColor: "btn-warning",
        confirmButtonText: "Si, reabrir",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false
    },
    function(isConfirm){
        if(isConfirm) {
            $.post("../../controller/ticket.php?op=reabrir",{ tick_id : tick_id, usu_id : usu_id}, function(data){
                $('#ticket_data').DataTable().ajax.reload();
                swal("Reabierto", "El ticket ha sido reabierto.","success");
            });
        }
    });
}

init();