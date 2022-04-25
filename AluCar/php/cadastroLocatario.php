<?php
include_once "conexao.php";


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_locatario = "INSERT INTO locatario (nome, sobrenome, cpf, celular, dataNasc, email, cep, rua, numero, estado, cidade, bairro, usuario, senha) 
                    VALUES (:nome, :sobrenome, :cpf, :celular, :dataNasc, :email, :cep, :rua, :numero, :estado, :cidade, :bairro, :usuario, :senha)";

$cad_locatario = $conn->prepare($query_locatario);
$cad_locatario->bindParam(':nome', $dados['nome']);
$cad_locatario->bindParam(':sobrenome', $dados['sobrenome']);
$cad_locatario->bindParam(':cpf', $dados['cpf']);
$cad_locatario->bindParam(':celular', $dados['celular']);
$cad_locatario->bindParam(':dataNasc', $dados['dataNasc']);
$cad_locatario->bindParam(':email', $dados['email']);
$cad_locatario->bindParam(':cep', $dados['cep']);
$cad_locatario->bindParam(':rua', $dados['rua']);
$cad_locatario->bindParam(':numero', $dados['numero']);
$cad_locatario->bindParam(':estado', $dados['estado']);
$cad_locatario->bindParam(':cidade', $dados['cidade']);
$cad_locatario->bindParam(':bairro', $dados['bairro']);
$cad_locatario->bindParam(':usuario', $dados['usuario']);
$cad_locatario->bindParam(':senha', md5($dados['senha']));
$cad_locatario->execute();

if($cad_locatario->rowCount()){
    $retorna = ['erro' => false, 'msg' => "Locatário cadastrado com sucesso"];
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Locatário não foi cadastrado!"];
}

echo json_encode($retorna);