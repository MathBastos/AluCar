var veiculo;

$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/controleAcessorio.php",
        success: function (resultado) {

            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'>" + "Selecionar" + "</td>";
            html += "<td align='center'>" + "Nome" + "</td>";
            html += "<td align='center'>" + "Valor" + "</td>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + "<input type='checkbox' id='" + resultado[i].nome +"' onclick='controleChek(this.id)'>" + "</td>";
                html += "<td align='center'>" + resultado[i].nome + "</td>";
                html += "<td align='center'>" + resultado[i].valor + "</td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);

            

            $("#calcular").click(function () {

                var data_inicio = document.getElementById("data_inicio").value;
                var data_fim = document.getElementById("data_fim").value;

                var dt1 = new Date(data_inicio+'T00:00:00Z');
                var dt2 = new Date(data_fim+'T00:00:00Z');

                var dif = dt2.getTime() - dt1.getTime();

                // To calculate the no. of days between two dates
                var dif_dia = dif / (1000 * 3600 * 24);
                
                var totalReserva = veiculo.valor_dia * dif_dia;

                for (var i = 0; i < resultado.length; i++) {
                    var element = document.getElementById(resultado[i].nome);
                    if (element.classList.contains("checked")) {
                        totalReserva += resultado[i].valor * dif_dia
                    }
                }

                var html = totalReserva
                $("#valorTotal").html(html);


                console.log(totalReserva);
            });
        }
    });

});


function buscaVeiculo(){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/buscaVeiculo.php",
        success: function (resultado) {
            document.getElementById("modelo").value = resultado.modelo;
            document.getElementById("marca").value = resultado.marca;
            document.getElementById("ano").value = resultado.ano;
            document.getElementById("cambio").value = resultado.cambio;
            document.getElementById("direcao").value = resultado.direcao;
            document.getElementById("categoria").value = resultado.categoria;
            document.getElementById("cor").value = resultado.cor;
            document.getElementById("motor").value = resultado.motor;
            document.getElementById("portas").value = resultado.portas;
            document.getElementById("qtd_passageiros").value = resultado.qtd_passageiros;
            document.getElementById("ar_condicionado").value = (resultado.ar_condicionado == 's' ? "Sim" : "Não" );

            var html = "<img src=" + resultado.imagem + " width='100%' height='50%'/>";
            $("#imagem").html(html);

            veiculo = resultado;

        },
        error: function (){
        }
    });
}

function controleChek(clicked_id){
    
    var element = document.getElementById(clicked_id);
    if (element.classList.contains("checked")) {
        element.classList.remove("checked");
    }else{
        element.classList.add("checked");
    }    
}