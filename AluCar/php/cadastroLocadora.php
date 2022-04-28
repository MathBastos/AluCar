<?php
include_once "conexao.php";


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha_md5 = md5($dados['senha']);

$query_locadora = "INSERT INTO locadora (nomeFantasia, cnpj, telefone, cep, logradouro, numero, estado, cidade, bairro, email, senha) 
                    VALUES (:nomeFantasia, :cnpj, :telefone, :cep, :logradouro, :numero, :estado, :cidade, :bairro, :email, :senha)";

$cad_locadora = $conn->prepare($query_locadora);
$cad_locadora->bindParam(':nomeFantasia', $dados['nomeFantasia']);
$cad_locadora->bindParam(':cnpj', $dados['cnpj']);
$cad_locadora->bindParam(':telefone', $dados['telefone']);
$cad_locadora->bindParam(':cep', $dados['cep']);
$cad_locadora->bindParam(':logradouro', $dados['logradouro']);
$cad_locadora->bindParam(':numero', $dados['numero']);
$cad_locadora->bindParam(':estado', $dados['estado']);
$cad_locadora->bindParam(':cidade', $dados['cidade']);
$cad_locadora->bindParam(':bairro', $dados['bairro']);
$cad_locadora->bindParam(':email', $dados['email']);
$cad_locadora->bindParam(':senha', $senha_md5);

$cad_locadora->execute();
    if($cad_locadora->rowCount() == 1){
        $retorna = "Locadora cadastrada com sucesso!";
    }else{
        $retorna = "Não foi possível cadastrar a Locadora, verificar os campos";
    }

echo json_encode($retorna);