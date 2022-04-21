<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AluCar - Cadastro Locadora</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Efetue o cadastro de sua Locadora!</h3>
                    <h3 class="title has-text-grey">Preencha todos os campos</h3>
                    <?php
                    if(isset($_SESSION['status_cadastro'])):
                    ?>
                    <div class="notification is-success">
                      <p>Cadastro efetuado!</p>
                      <p>Faça login informando o seu CNPJ e senha <a href="login.php">aqui</a></p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['status_cadastro']);
                    ?>
                    <?php
                    if(isset($_SESSION['usuario_existente'])):
                    ?>
                    <div class="notification is-info">
                        <p>CNPJ já existente. Informe um novo CNPJ e tente novamente.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['usuario_existente']);
                    ?>
                    <div class="box">
                        <form action="cadastrar_locadora.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="nomeFantasia" type="text" class="input is-large" placeholder="Nome fantasia" autofocus>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="cnpj" type="text" class="input is-large" placeholder="CNPJ">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="cep" type="text" class="input is-large" placeholder="CEP">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="logradouro" type="text" class="input is-large" placeholder="Logradouro">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="numero" type="text" class="input is-large" placeholder="Número">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <select class="input is-large" name="estado">
                                        <option value="" disabled selected hidden>Estado</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="EX">Estrangeiro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="cidade" type="text" class="input is-large"  placeholder="Cidade">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="email" type="email" class="input is-large"  placeholder="E-mail">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
                            <div class="field">
                                <a href="logar_locadora.php">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>