const loginLocadora = document.getElementById("loginLocadoraForm");

loginLocadora.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(loginLocadora);
    dadosForm.append("add", 1);

    console.log("pedreiro");
    const dados = await fetch("../php/loginLocadora.php", {
        method: "POST",
        body: dadosForm,

    });
    const resposta = await dados.json();
    
    if(resposta == "sucesso"){
        window.location.replace("../html/indexLocadora.html");
    }
    else{
        alert("Oops, tem algo errado! Verifique suas credenciais.");
    }
});