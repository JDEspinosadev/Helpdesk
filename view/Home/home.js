var barChart;
var funcChart;

function init(){
}

$(document).ready(function(){
    var usu_id = $('#user_idx').val();
    var rol_id = $('#rol_idx').val();

    var url_total = "../../controller/ticket.php?op=total";
    var url_abierto = "../../controller/ticket.php?op=totalabierto";
    var url_cerrado = "../../controller/ticket.php?op=totalcerrado";
    var url_grafico = "../../controller/ticket.php?op=grafico";
    var grafico_funcionario = "../../controller/ticket.php?op=grafico_funcionario";

        //Grafico total
    $.post(url_total,{usu_id:usu_id},function(data){
        var res = (typeof data === 'string') ? JSON.parse(data) : data;
        $('#lbltotal').html(res.total);
    });

        // Grafico tickets abiertos
    $.post(url_abierto,{usu_id:usu_id},function(data){
        var res = (typeof data === 'string') ? JSON.parse(data) : data;
        $('#lbltotalabierto').html(res.total);
    });

        // Grafico tickets cerrados
    $.post(url_cerrado,{usu_id:usu_id},function(data){
        var res = (typeof data === 'string') ? JSON.parse(data) : data;
        $('#lbltotalcerrado').html(res.total);
    });

        // Grafico morris
    $.post(url_grafico,{usu_id:usu_id},function(data){
        try{

            var info = (typeof data === 'string') ? JSON.parse(data) : data;

        if (info && info.length > 0){
            new Morris.Bar({
                element: 'divgrafico',
                data: info,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Cantidad'],  
                barColors: ['#1AB244'],
                resize: true,
                gridTextColor: '#8e9fa7'
            });
        }
        
        } catch (e){ 
            console.error("Erros en JSON de Gráfico:", e);
            console.log("Respuesta recibida del servidor:", data);
        }
    });

    $.post(grafico_funcionario, function(data){
        try{
            var info = (typeof data === 'string') ? JSON.parse(data) : data;

            if(info && info.length > 0) {
                new Morris.Bar({
                    element: 'grafico_func_div',
                    data:info,
                    xkey: 'funcionario',
                    ykeys: ['total'],
                    labels: ['Tickets'],
                    barColors: ['#3498db'],
                    resize: true
                });
            }
        } catch(e) {
            console.error("Error en grafico funcionario:", e);
        }    
    });
    

    $(document).on('click', '#show-hide-sidebar-toggle', function(){
        setTimeout(function(){
            if(funcChart) funcChart.redraw();
        }, 500);
    });
});

init();