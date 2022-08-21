function editaVeiculo(){
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
            document.getElementById("chassi").value = resultado.chassi;
            document.getElementById("placa").value = resultado.placa;
            document.getElementById("cor").value = resultado.cor;
            document.getElementById("motor").value = resultado.motor;
            document.getElementById("portas").value = resultado.portas;
            document.getElementById("qtd_passageiros").value = resultado.qtd_passageiros;
            document.getElementById("ar_condicionado").value = resultado.ar_condicionado;
            document.getElementById("valor_hora").value = resultado.valor_hora;
            document.getElementById("valor_seguro").value = resultado.valor_seguro;
        },
        error: function (){
            
        }
    });
}