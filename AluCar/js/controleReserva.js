var id_reserva;
var id_atual;
$(document).ready(function () {
    

    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/controleReserva.php",
        success: function (resultado) {
            var html = "<table class='table' itemborder='1'>";
            
            html += "<tr>";
            html += "<td align='center'>" + "Locatário" + "</td>";
            html += "<td align='center'>" + "Veículo" + "</td>";
            html += "<td align='center'>" + "De" + "</td>";
            html += "<td align='center'>" + "Até" + "</td>";
            html += "<td align='center'>" + "Veículo" + "</td>";
            html += "<td align='center'>" + "Valor reserva (R$)" + "</td>";
            html += "<td align='center'>" + "Status reserva" + "</td>";
            html += "<td align='center'>" + "Confirmar/Finalizar" + "</td>";
            html += "<td align='center'>" + "Cancelar" + "</td>";
            html += "</tr>";
            
            for (var i = 0; i < resultado.length; i++) {
                var dataInput1 = resultado[i].data_inicio;
                var dataInput2 = resultado[i].data_final;

                
                dataInicio = new Date(dataInput1);
                dataInicioFormatada = dataInicio.toLocaleDateString('pt-BR', { timeZone: 'UTC' });
                id_reserva = resultado[i].id

                dataFim = new Date(dataInput2);
                dataFimFormatada = dataFim.toLocaleDateString('pt-BR', { timeZone: 'UTC' });
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].nome + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + dataInicioFormatada + "</td>";
                html += "<td align='center'>" + dataFimFormatada + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].valor + "</td>";
                html += "<td align='center'>" + resultado[i].status_carro + "</td>";
                if (resultado[i].status_carro == "Reservado") {
                    html += "<td align='center'> <a onclick='confirmaReserva(" + resultado[i].id + ")'><i class='fas fa-thumbs-up' aria-hidden='true'></i></a></td>";
                } else if (resultado[i].status_carro == "Alugado"){
                    html += "<td align='center'> <a data-target='#myModal' onclick='salvaID(" + resultado[i].id + ")' data-toggle='modal'><i class='fas fa-check-circle' aria-hidden='true'></i></a></td>";
                    
                }else{
                    html += "<td align='center'></td>";
                }
                html += "<td align='center'> <a onclick='deleteReserva(" + resultado[i].id +")'> <i class='fas fa-times' aria-hidden='true'></i> </td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        }
    });
});

function deleteReserva(id){
    alert(id);

    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/deletaReserva.php?id_reserva="+id,
        success: function (resultado) {
            alert("Reserva removida com sucesso!");
            window.location.reload();
        },
        error: function (){   
        }
    });
}

function confirmaReserva(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/confirmaReserva.php?id_reserva="+id,
        success: function (resultado) {
            alert(resultado);
            window.location.reload();
        },
        error: function (){
            
        }
    });
}

function finalizaReserva() {
    var quilometragem = document.getElementById("quilometragem").value;

    $.ajax({
        type: "POST",
        data: {
            quilometragem: quilometragem,
            id_reserva: id_atual
        },
        url: "../php/finalizaReserva.php",
        async: false,
        success: function (resultado) {
            alert(resultado);
            window.location.reload();
        },
        error: function () {
            alert("Não foi possível reservar o Veículo, tente novamente!")
        }
    });
}

function salvaID(id){
    id_atual = id;
}
