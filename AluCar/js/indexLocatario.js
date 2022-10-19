$(document).ready(function () {

    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/indexLocatario.php",
        success: function (resultado) {

            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'>" + "" + "</td>";
            html += "<td align='center'>" + "Modelo" + "</td>";
            html += "<td align='center'>" + "Marca" + "</td>";
            html += "<td align='center'>" + "Valor" + "</td>";
            html += "<td align='center'>" + "Cor" + "</td>";
            html += "<td align='center'>" + "" + "</td>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].imagem + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].marca + "</td>";
                html += "<td align='center'>" + resultado[i].valor + "</td>";
                html += "<td align='center'>" + resultado[i].cor + "</td>";
                html += "<td align='center'> <a onclick='alugarCarro(" + resultado[i].id + ")'> <i class='fa fa-shopping-cart' aria-hidden='true'></i></td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        }
    });   

});

function filtrar (){
    var html = "<table class='table' itemborder='1'>";

    html += "<tr>";
    html += "<td align='center'>" + "" + "</td>";
    html += "<td align='center'>" + "Modelo" + "</td>";
    html += "<td align='center'>" + "Marca" + "</td>";
    html += "<td align='center'>" + "Valor" + "</td>";
    html += "<td align='center'>" + "Cor" + "</td>";
    html += "</tr>";



    var filtro = document.getElementById("pesquisa").value
    
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/filtroVeiculos.php?filtro=" + filtro,
        success: function (resultado) {
            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].imagem + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].marca + "</td>";
                html += "<td align='center'>" + resultado[i].valor + "</td>";
                html += "<td align='center'>" + resultado[i].cor + "</td>";
                html += "<td align='center'> <a onclick='alugarCarro(" + resultado[i].id + ")'> <i class='fa fa-shopping-cart' aria-hidden='true'></i></td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        },
        error: function (resultado) {
            console.log(resultado[0]);
        }
    });

    $("#table").html(html);
}

function alugarCarro(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/redirecionaAluguel.php?id_veiculo=" + id,
        success: function (resultado) {
            window.location.replace("../html/aluguelVeiculo.html?id_veiculo=" + id);
        },
        error: function () {

        }
    });


}