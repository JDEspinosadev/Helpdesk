var tabla;

function init() {
    $("#usuario_form").on("submit", function (e) {
        guardaryeditar(e);
    });

    $('.select2').select2({
        dropdownParent: $('#modalmantenimiento'),
        width: '100%'
    });
}   

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData, 
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);
            $('#usuario_form')[0].reset();
            $('#usu_dep').val('').trigger('change');
            $('#rol_id').val('').trigger('change');
            $('#modalmantenimiento').modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

            /*if(tabla){
                tabla.ajax.reload();
            }else{
                $('#usuario_data').DataTable().ajax.reload();
            }*/
            

            swal({
                title: "HelpDesk!",
                text: "El usuario ha sido creado correctamente.",
                type: "success",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Aceptar"
            });
        }
    });
}

$(document).ready(function () {
    if ($('#usuario_data').length > 0){
        tabla = $('#usuario_data').DataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "ajax": {
                url: '../../controller/usuario.php?op=listar',
                type: "POST",
                dataType:  "json",
                dataSrc: function(json) {
                    return json.aaData || json.data || [];
                },
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "columnDefs": [
                { 
                    "targets": [ 0 ], 
                    "render": function ( data, type, row ) {
                        var foto = (data == "" || data == null) ? "no_photo.png" : data;
                        return '<div class="text-cennter"><img src="../../public/img/usuario/' + foto + '" class="img-circle" style="width: 35px; height: 35px;"></div>';
                    }
                }
            ],
            "bDestroy": true,
            "responsive": true,
            "bInfo":true,
            "iDisplayLength": 10,
            "autoWidth": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar_MENU_registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        }); 
    }
});


function editar(usu_id){
    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/usuario.php?op=mostrar", {usu_id : usu_id}, function (data) {
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_ap').val(data.usu_ap);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_telf').val(data.usu_telf);

        $('#usu_dep').val(data.usu_dep).trigger('change');
        $('#rol_id').val(data.rol_id).trigger('change');


        $('#usu_pass').val('');
        $('#pass_help').show();
        $('#usu_pass').prop('required', false);   
    });

    $('#modalmantenimiento').modal('show');
}

function eliminar(usu_id){
    swal({
        title: "HelpDesk",
        text: "¿Está seguro de Eliminar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=eliminar", {usu_id : usu_id}, function (data) {
                $('#usuario_data').DataTable().ajax.reload();
                swal({
                    title: "HelpDesk!",
                    text: "Registro Eliminado.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            });
        }
    });
}

$(document).on("click","#btnnuevo", function(){
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#usu_dep').val('').trigger('change');
    $('#rol_id').val('').trigger('change');
    $('#usu_id').val('');
    $('#pass_help').hide();
    $('#usu_pass').prop('required', true);
    $('#modalmantenimiento').modal('show');
});

init();
        

