<?php
include_once "conexao.php";
session_start();
//variável booleana que permite o cadastro futuramente
$permite_cadastro = false;
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha_md5 = md5($dados['senha']);
$id_locadora = $_SESSION["id_locadora"];


if($id_locadora <= 0){
    //validação de endereço repetido, utilizando o cep + numero como parametros.
    $sql_fk_endereco = "SELECT * FROM endereco WHERE cep = :cep AND numero = :numero ORDER BY id_endereco desc";
    $pega_dados_endereco = $conn->prepare($sql_fk_endereco);
    $pega_dados_endereco->bindParam(':cep', $dados['cep']);
    $pega_dados_endereco->bindParam(':numero', $dados['numero']);
    $pega_dados_endereco->execute();

    $row = $pega_dados_endereco->rowCount();
    if($row == 0){
        //validação de usuario repetido, utilizando o usuario como parametro.
        $sql_fk_usuario = "SELECT * FROM usuario WHERE usuario = :usuario ORDER BY id_usuario desc";
        $pega_dados_usuario = $conn->prepare($sql_fk_usuario);
        $pega_dados_usuario->bindParam(':usuario', $dados['usuario']);
        $pega_dados_usuario->execute();

        //caso nao exista o usuario, ele fará a verificação de CPF repetido.
        $row = $pega_dados_usuario->rowCount();
        if($row == 0){
            //validação de CNPJ repetido, utilizando o CNPJ como parametro.
            $sql_cnpj = "SELECT * FROM locadora WHERE (cnpj) = (:cnpj)";
            $pegaDados = $conn->prepare($sql_cnpj);
            $pegaDados->bindParam(':cnpj', $dados['cnpj']);
            $pegaDados->execute();
            if($pegaDados->rowCount() == 1){
                $retorna = "CNPJ já cadastrado em nosso Banco de Dados!";
            }else{
                //caso não exista o cpf, ele muda a variavel de permissão de cadastro pra true, prosseguindo para os inserts no banco.
                $permite_cadastro = true;
            }
        }else{
            $retorna = "Usuário inserido já existe, favor utilizar outro usuário.";
        }
    }else{
        $retorna = "Endereço inserido já existe, favor utilizar outro endereço.";
    }
}else{
    $permite_cadastro = true;
}
//caso nao exista o endereço, ele fará a verificação de usuário repetido.


//query de inserção/edição na tabela endereco
if($permite_cadastro){
    if($id_locadora > 0){
    $query_endereco = 
    "UPDATE locadora 
        SET  
         estado = :estado
        ,cidade = :cidade
        ,bairro = :bairro
        ,cep = :cep
        ,rua = :rua
        ,numero = :numero
        ,complemento = :complemento
        WHERE id_locadora = :id_locadora"; 
    }else{
    $query_endereco =
    "INSERT INTO endereco (
     estado
    ,cidade
    ,bairro
    ,cep
    ,rua
    ,numero
    ,complemento
    ) 
    VALUES (
     :estado
    ,:cidade
    ,:bairro
    ,:cep
    ,:rua
    ,:numero
    ,:complemento
    )";
    }

    //bindando os valores do form nas variaveis para utilizar a inserção SQL
    $cad_endereco = $conn->prepare($query_endereco);
    $cad_endereco->bindParam(':estado', $dados['estado']);
    $cad_endereco->bindParam(':cidade', $dados['cidade']);
    $cad_endereco->bindParam(':bairro', $dados['bairro']);
    $cad_endereco->bindParam(':cep', $dados['cep']);
    $cad_endereco->bindParam(':rua', $dados['rua']);
    $cad_endereco->bindParam(':numero', $dados['numero']);
    $cad_endereco->bindParam(':complemento', $dados['complemento']);
    //insere no banco
    if($id_locadora > 0){
        $cad_endereco->bindParam(':id_locadora', $id_locadora);
        $cad_endereco->execute();
    }else{
        $cad_endereco->execute();
    }


    //processo de consultar a tabela endereço para pegar o id_endereco(FOREIGN KEY) para inserção na tabela locadora futuramente.
    $sql_fk_endereco = "SELECT * FROM endereco WHERE cep = :cep AND numero = :numero ORDER BY id_endereco desc";
    $pega_dados_endereco = $conn->prepare($sql_fk_endereco);
    $pega_dados_endereco->bindParam(':cep', $dados['cep']);
    $pega_dados_endereco->bindParam(':numero', $dados['numero']);
    $pega_dados_endereco->execute();

    $row = $pega_dados_endereco->rowCount();
    $id_endereco = -1;
    if($row == 1){
        $dados_endereco = $pega_dados_endereco->fetch(PDO::FETCH_ASSOC);
        $id_endereco = $dados_endereco['id_endereco'];
    }

    //query de inserção/edição na tabela usuário
    if($id_locadora > 0){
    $query_usuario = 
    "UPDATE locadora 
        SET  
         nome = :nome
        ,email = :email
        ,usuario = :usuario
        ,senha = :senha
        ,flag_bloqueado = :flag_bloqueado
        WHERE id_locadora = :id_locadora"; 
    }else{
        $query_usuario = 
        "INSERT INTO usuario (
         nome
        ,email
        ,usuario
        ,senha
        ,flag_bloqueado
        ) 
        VALUES (
         :nome
        ,:email
        ,:usuario
        ,:senha
        ,:flag_bloqueado
        )";
    }

    $flag_bloqueado = "N";
    //bindando os valores do form nas variaveis para utilizar a inserção SQL
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome']);
    $cad_usuario->bindParam(':email', $dados['email']);
    $cad_usuario->bindParam(':usuario', $dados['usuario']);
    $cad_usuario->bindParam(':senha', $senha_md5);
    $cad_usuario->bindParam(':flag_bloqueado', $flag_bloqueado);

    //insere no banco
    if($id_locadora > 0){
        $cad_usuario->bindParam(':id_locadora', $id_locadora);
        $cad_usuario->execute();
    }else{
        $cad_usuario->execute();
    }

    //processo de consultar a tabela endereço para pegar o id_usuario(FOREIGN KEY) para inserção na tabela locadora futuramente.
    $sql_fk_usuario = "SELECT * FROM usuario WHERE usuario = :usuario ORDER BY id_usuario desc";
    $pega_dados_usuario = $conn->prepare($sql_fk_usuario);
    $pega_dados_usuario->bindParam(':usuario', $dados['usuario']);
    $pega_dados_usuario->execute();

    $row = $pega_dados_usuario->rowCount();
    $id_usuario = -1;
    if($row == 1){
        $dados_usuario = $pega_dados_usuario->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $dados_usuario['id_usuario'];
    }

    
    

    //query de inserção/edição na tabela locadora

    if($id_locadora > 0){
    $query_locadora = 
    "UPDATE locadora 
        SET  
         cnpj = :cnpj
        ,telefone = :telefone
        ,id_usuario = :id_usuario
        WHERE id_locadora = :id_locadora"; 
    }else{
        $query_locadora = 
        "INSERT INTO locadora (
        cnpj
        ,telefone
        ,id_usuario
        ) 
        VALUES (
        :cnpj
        ,:telefone
        ,:id_usuario
        )";
    }

    //bindando os valores do form nas variaveis para utilizar a inserção SQL
    $cad_locadora = $conn->prepare($query_locadora);
    $cad_locadora->bindParam(':cnpj', $dados['cnpj']);
    $cad_locadora->bindParam(':telefone', $dados['telefone']);
    //guardando as foreign keys das variaveis nos parametros
    $cad_locadora->bindParam(':id_usuario', $id_usuario);
    //insere no banco

    if($id_locadora > 0){
        $cad_locadora->bindParam(':id_locadora', $id_locadora);
        $cad_locadora->execute();
    }else{
        $cad_locadora->execute();
    }

    //processo de consultar a tabela endereço para pegar o id_usuario(FOREIGN KEY) para inserção na tabela locadora futuramente.
    $sql_fk_locadora = "SELECT * FROM locadora WHERE cnpj = :cnpj ORDER BY id_locadora desc";
    $pega_dados_locadora = $conn->prepare($sql_fk_locadora);
    $pega_dados_locadora->bindParam(':cnpj', $dados['cnpj']);
    $pega_dados_locadora->execute();

    $row = $pega_dados_locadora->rowCount();
    $id_locadora = -1;
    if($row == 1){
        $dados_locadora = $pega_dados_locadora->fetch(PDO::FETCH_ASSOC);
        $id_locadora = $dados_locadora['id_locadora'];
    }

    //query de inserção/edição na tabela usuário
    if($id_locadora > 0){
    $query_loc_end= 
    "UPDATE locadora 
        SET  
         cnpj = :cnpj
        ,telefone = :telefone
        ,id_usuario = :id_usuario
        WHERE id_locadora = :id_locadora"; 
    }else{
        $query_locadora = 
        "INSERT INTO locadora (
         id_locadora
        ,id_endereco
        ) 
        VALUES (
        :id_locadora
        ,:id_endereco
        )";
    }

    $query_loc_end = 
    "INSERT INTO locadora_endereco (
     id_locadora
    ,id_endereco
    ) 
    VALUES (
     :id_locadora
    ,:id_endereco
    )";

    //bindando os valores do form nas variaveis para utilizar a inserção SQL
    $cad_loc_end = $conn->prepare($query_loc_end);
    $cad_loc_end->bindParam(':id_locadora', $id_locadora);
    $cad_loc_end->bindParam(':id_endereco', $id_endereco);

    //insere no banco
    if($id_locadora > 0){
        $cad_loc_end->bindParam(':id_locadora', $id_locadora);
        $cad_loc_end->execute();
        $retorna = "Locadora atualizada com sucesso!";
    }else{
        $cad_loc_end->execute();
    }
    
    //caso insira com sucesso, retornará a mensagem validando.
    if($id_locadora <= 0){
        if($cad_locadora->rowCount() == 1){
            $retorna = "Locadora cadastrada com sucesso!";
        }else{
            $retorna = "Não foi possível cadastrar a Locadora, verificar os campos";
        }
    }else{
        $retorna = "Locadora atualizada com sucesso!";
    }

}
echo json_encode($retorna);