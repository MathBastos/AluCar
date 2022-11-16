$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/rankingLonga.php",
        success: function (resultado) {
            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'></td>";
            html += "<td align='center'>" + "Rank" + "</td>";
            html += "<td align='center'>" + "Veículo" + "</td>";
            html += "<td align='center'>" + "Vezes Reservado" + "</td>";
            html += "<td align='center'>" + "Media de Km por dia" + "</td>";
            html += "</tr>";

            var rank = 1;
            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'> <img src = "+ resultado[i].imagem +" width = '100px' height = '75px'/></td>"
                html += "<td align='center'>" + rank + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].qtde_reservas + "</td>";
                html += "<td align='center'>" + Math.round(resultado[i].media_dia) + "</td>";
                html += "</tr>";
                rank ++;
            }
            html += "</table>";
            html += "<br>";

            $("#rankingLonga").html(html);

        },
        error: function () {
        }
    });

    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/rankingCurta.php",
        success: function (resultado) {
            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'></td>";
            html += "<td align='center'>" + "Rank" + "</td>";
            html += "<td align='center'>" + "Veículo" + "</td>";
            html += "<td align='center'>" + "Vezes Reservado" + "</td>";
            html += "<td align='center'>" + "Media de Km por dia" + "</td>";
            html += "</tr>";
            
            var rank = 1;
            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'> <img src = " + resultado[i].imagem + " width = '100px' height = '75px'/></td>"
                html += "<td align='center'>" + rank + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].qtde_reservas + "</td>";
                html += "<td align='center'>" + Math.round(resultado[i].media_dia) + "</td>";
                html += "</tr>";
                rank++;
            }
            html += "</table>";
            html += "<br>";

            $("#rankingCurta").html(html);
        },
        error: function () {
        }
    });
});