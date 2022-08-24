$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/indexLocatario.php",
        success: function (resultado) {

            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'>" + "ID" + "</td>";
            html += "<td align='center'>" + "Modelo" + "</td>";
            html += "<td align='center'>" + "Marca" + "</td>";
            html += "<td align='center'>" + "Placa" + "</td>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].id + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].marca + "</td>";
                html += "<td align='center'>" + resultado[i].placa + "</td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        }
    });
});