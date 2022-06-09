const cadAcessorio = document.getElementById("cadastroAcessorio");

cadAcessorio.addEventListener("submit", async (e) => {
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
    const dadosForm = new FormData(cadAcessorio);
    dadosForm.append("add", 1);

    const dados = await fetch("../php/cadastroAcessorio.php", {
        method: "POST",
        body: dadosForm,

    });

    const resposta = await dados.json();
    alert(resposta);
    
});