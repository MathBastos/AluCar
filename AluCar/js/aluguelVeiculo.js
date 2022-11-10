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

        },
        error: function (){
        }
    });
}