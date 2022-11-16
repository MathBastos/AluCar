const cadAcessorio = document.getElementById("cadastroAcessorio");

cadAcessorio.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(cadAcessorio);
    dadosForm.append("add", 1);

    const dados = await fetch("../php/cadastroAcessorio.php", {
        method: "POST",
        body: dadosForm,
    });
    
    const resposta = await dados.json();
    alert(resposta);
    location.href = 'indexLocadora.html' 
});