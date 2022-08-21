$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/controleVeiculo.php",
        success: function (resultado) {

            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'>" + "ID" + "</td>";
            html += "<td align='center'>" + "Modelo" + "</td>";
            html += "<td align='center'>" + "Marca" + "</td>";
            html += "<td align='center'>" + "Placa" + "</td>";
            html += "<td align='center'>" + "Editar" + "</td>";
            html += "<td align='center'>" + "Excluir" + "</td>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].id + "</td>";
                html += "<td align='center'>" + resultado[i].modelo + "</td>";
                html += "<td align='center'>" + resultado[i].marca + "</td>";
                html += "<td align='center'>" + resultado[i].placa + "</td>";
                html += "<td align='center'> <a onclick='editVeiculo(" + resultado[i].id + ")'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i></td>";
                html += "<td align='center'> <a onclick='deleteVeiculo("+ resultado[i].id +")'> <i class='fas fa-trash-alt' aria-hidden='true'></i> </td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        }
    });
});


function deleteVeiculo(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/deletaVeiculo.php?id_veiculo="+id,
        success: function (resultado) {
            alert("Veículo removido com sucesso!");
            window.location.reload();
        },
        error: function (){
            
        }
    });
}

function editVeiculo(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/redirecionaVeiculo.php?id_veiculo=" + id,
        success: function (resultado) {
            window.location.replace("../html/cadastroVeiculo.html?id_veiculo=" + id);
        },
        error: function () {

        }
    });


}