function editaAcessorio(){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/buscaAcessorio.php",
        success: function (resultado) {
            document.getElementById("nome").value = resultado.nome; 
            document.getElementById("descricao").value = resultado.descricao; 
            document.getElementById("qtd_acessorio").value = resultado.quantidade; 
            document.getElementById("valor_acessorio").value = resultado.valor;
        },
        error: function (){
            
        }
    });
}