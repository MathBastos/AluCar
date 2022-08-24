<?php
include_once "conexao.php";
session_start();
//variável booleana que permite o cadastro futuramente
$permite_cadastro = false;
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha_md5 = md5($dados['senha']);
$id_locatario = $_SESSION["id_locatario"];

//$isAlterar = $id_locatario > 0 ? true:false;

if($id_locatario <= 0){
//validação de endereço repetido, utilizando o cep + numero como parametros.
    $sql_fk_endereco = "SELECT * FROM endereco WHERE cep = :cep AND numero = :numero ORDER BY id_endereco desc";
    $pega_dados_endereco = $conn->prepare($sql_fk_endereco);
    $pega_dados_endereco->bindParam(':cep', $dados['cep']);
    $pega_dados_endereco->bindParam(':numero', $dados['numero']);
    $pega_dados_endereco->execute();

    //caso nao exista o endereço, ele fará a verificação de usuário repetido.
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
            //validação de cpf repetido, utilizando o cpf como parametro.
            $sql_cpf = "SELECT * FROM locatario WHERE (cpf) = (:cpf)";
            $pegaDados = $conn->prepare($sql_cpf);
            $pegaDados->bindParam(':cpf', $dados['cpf']);
            $pegaDados->execute();
            if($pegaDados->rowCount() == 1){
                $retorna = "CPF já cadastrado em nosso Banco de Dados!";
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




if($permite_cadastro){
//query de inserção/edição na tabela endereco
    if($id_locatario > 0){
        //buscando ID Endereco  
        $query_id_enredeco = 
        "SELECT id_endereco 
        FROM locatario
        WHERE id_locatario= :id_locatario;
        ";

        $result_id_endereco = $conn->prepare($query_id_enredeco);
        $result_id_endereco->bindParam(':id_locatario', $id_locatario);
        $result_id_endereco->execute();
        $dado_id_loc = $result_id_endereco->fetch(PDO::FETCH_ASSOC);
        $id_end = $dado_id_loc['id_endereco'];


        $query_endereco = 
        "UPDATE endereco 
            SET  
            estado = :estado
            ,cidade = :cidade
            ,bairro = :bairro
            ,cep = :cep
            ,rua = :rua
            ,numero = :numero
            ,complemento = :complemento
            WHERE id_endereco = :id_endereco"; 
        }else{
            $query_endereco ="INSERT INTO endereco ( estado, cidade, bairro, cep, rua, numero, complemento) 
            VALUES (:estado, :cidade, :bairro, :cep, :rua, :numero, :complemento)";
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
    if($id_locatario > 0){
        $cad_endereco->bindParam(':id_endereco', $id_end);
        $cad_endereco->execute();
    }else{
        $cad_endereco->execute();
    }

    //processo de consultar a tabela endereço para pegar o id_endereco(FOREIGN KEY) para inserção na tabela locatario futuramente.
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
    if($id_locatario > 0){
        //buscando ID usuario
        $query_id_usuario = 
        "SELECT id_usuario
        FROM locatario
        WHERE id_locatario = :id_locatario;
        ";
        $result_id_usuario = $conn->prepare($query_id_usuario);
        $result_id_usuario->bindParam(':id_locatario', $id_locatario);
        $result_id_usuario->execute();
        $dado_id_user = $result_id_usuario->fetch(PDO::FETCH_ASSOC);
        $id_user = $dado_id_user['id_usuario'];

        $query_usuario = 
        "UPDATE usuario 
            SET  
            nome = :nome
            ,email = :email
            ,usuario = :usuario
            ,senha = :senha
            ,flag_bloqueado = :flag_bloqueado
            WHERE id_usuario = :id_usuario"; 
    }else{
        $query_usuario = "INSERT INTO usuario (nome, email, usuario, senha, flag_bloqueado) 
                            VALUES (:nome, :email, :usuario, :senha, :flag_bloqueado)";
        $flag_bloqueado = "N";

    }

    //bindando os valores do form nas variaveis para utilizar a inserção SQL
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome']);
    $cad_usuario->bindParam(':email', $dados['email']);
    $cad_usuario->bindParam(':usuario', $dados['usuario']);
    $cad_usuario->bindParam(':senha', $senha_md5);
    $cad_usuario->bindParam(':flag_bloqueado', $flag_bloqueado);
    //insere no banco
    if($id_locatario > 0){
        $cad_usuario->bindParam(':id_usuario', $id_user);
        $cad_usuario->execute();
    }else{
        $cad_usuario->execute();
    }

    //processo de consultar a tabela endereço para pegar o id_usuario(FOREIGN KEY) para inserção na tabela locatario futuramente.
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

     //query de inserção/edição na tabela locatario
    
    if($id_locatario > 0){
        $query_locatario = 
         "UPDATE locatario 
        SET  
         cpf = :cpf
        ,celular = :celular
        ,data_nascimento = :data_nascimento
        WHERE id_locatario = :id_locatario"; 
    }else{
    $query_locatario = "INSERT INTO locatario (cpf, celular, data_nascimento, id_endereco, id_usuario) 
                        VALUES (:cpf, :celular, :data_nascimento, :id_endereco, :id_usuario)";
    }

    //bindando os valores do form nas variaveis para utilizar a inserção SQL
    $cad_locatario = $conn->prepare($query_locatario);
    $cad_locatario->bindParam(':cpf', $dados['cpf']);
    $cad_locatario->bindParam(':celular', $dados['celular']);
    $cad_locatario->bindParam(':data_nascimento', $dados['data_nascimento']);
    //guardando as foreign keys das variaveis nos parametros
    //insere no banco
    if($id_locatario > 0){
        $cad_locatario->bindParam(':id_locatario', $id_locatario);
        $cad_locatario->execute();
    }else{
        //guardando as foreign keys das variaveis nos parametros
        $cad_locatario->bindParam(':id_usuario', $id_usuario);
        $cad_locatario->bindParam(':id_endereco', $id_endereco);
        $cad_locatario->execute();
    }

    //caso insira com sucesso, retornará a mensagem validando.
    
    if($id_locatario <= 0){
        if($cad_locatario->rowCount() == 1){
            $retorna = "Usuário cadastrado com sucesso!";
        }else{
            $retorna = "Não foi possível cadastrar o usuário, verificar os campos.";
        }  
    }else{
        $retorna = "Locatario atualizado com sucesso!";
    }
}
echo json_encode($retorna);