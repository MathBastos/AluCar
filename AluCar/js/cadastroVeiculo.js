const cadVeiculo = document.getElementById("cadastroVeiculo");

cadVeiculo.addEventListener("submit", async (e) => {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/conexao.php",
        success: function () {
            alert("Oops, tem algo errado! Parece que o banco está fora do ar!");
        },
        error: function (){           
        }
    });

    e.preventDefault();
    const dadosForm = new FormData(cadVeiculo);
    dadosForm.append("add", 1);
    
    const dados = await fetch("../php/cadastroVeiculo.php", {
        method: "POST",
        body: dadosForm,
    });

    const resposta = await dados.json();
    alert(resposta);
});