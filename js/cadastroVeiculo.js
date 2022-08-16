const cadVeiculo = document.getElementById("cadastroVeiculo");

cadVeiculo.addEventListener("submit", async (e) => {
    
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