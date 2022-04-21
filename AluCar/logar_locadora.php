<?php
session_start();
?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AluCar - Aluguel de Automóveis</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">AluCar</h3>
                    <h3 class="title has-text-grey">Aluguel de Automóveis</h3>
                    <h3 class="title has-text-grey">Insira CNPJ e Senha</h3>
                    <?php
                    if(isset($_SESSION['nao_autenticado'])){
                    ?>
                    <div class="notification is-danger">
                      <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                    <?php
                    }
                    unset($_SESSION['nao_autenticado']);
                    ?>
                    <div class="box">
                        <form action="login_locadora.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="cnpj" type="text" class="input is-large" placeholder="CNPJ" autofocus="">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                            <div class="field">
                                <a href="cadastro_locadora.php">Cadastrar</a>
                            </div>
                            <div class="field">
                                <a href="index.php">Logar como Usuario</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>