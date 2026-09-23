var tabla_usu, tabla_tick;

function init(){
    tabla_usu = $('#tabla_logs_usuarios').DataTable({
        "aProcessing": true,
        "aServerSide": false,
        "destroy": true,
        "ajax": {
            url: '../../controller/log.php?op=listar_logs_usuarios',
            type: "get",
            dataType: "json",
            dataSrc: "aaData",
            error: function(e){
                console.log("Error en el servidor: ",e.responseText);
            }
        },
        "columnDefs":[
            {"targets": "_all", "defaultContent": ""}
        ],
        "order": [[ 0, "desc" ]],
        "language":{
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });

    tabla_tick= $('#tabla_logs_tickets').DataTable({
        "aProcessing": true,
        "aServerSide": false,
        dom: 'frtip',
        "ajax": {
            url: '../../controller/log.php?op=listar_logs_tickets',
            type: "get",
            dataType: "json",
            dataSrc: "aaData",
        },
        "columnDefs":[
            {"targets": "_all", "defaultContent": ""}
        ],
        "order": [[ 0, "desc" ]],
        "language":{
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
}

$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex){
        var min = $('#fecha_inicio').val();
        var max = $('#fecha_fin').val();

        var fechaTablaRaw = data[0].split(" ")[0] || "";
        if(!fechaTablaRaw) return true;
        var partes = fechaTablaRaw.split("/");
        var fechaTabla = partes[2] + "-" + partes[1] + "-" + partes[0];

        if (min === "" && max === "") return true;
        if (min === "" && fechaTabla <= max) return true;
        if (min <= fechaTabla && max === "") return true;
        if (min <= fechaTabla && fechaTabla <= max) return true;

        return false;
    }
);

$(document).on("click", "#btn_filtrar", function(){
    tabla_usu.draw();
    tabla_tick.draw();
});

init();