const loginLocatario = document.getElementById("loginLocatarioForm");

loginLocatario.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(loginLocatario);
    dadosForm.append("add", 1);

    const dados = await fetch("../php/loginLocatario.php", {
        method: "POST",
        body: dadosForm,
    });
    const resposta = await dados.json();

    if(resposta == "sucesso"){
        alert("Logado com sucesso!");
    }
    else{
        alert("Oops, tem algo errado! Verifique suas credenciais.");
    }
});