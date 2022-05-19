<?php
include_once "conexao.php";


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha_md5 = md5($dados['senha']);

$query_loginLocadora = "SELECT * FROM locadora WHERE cnpj = :cnpj AND senha = :senha";
$login_locadora = $conn->prepare($query_loginLocadora);
$login_locadora->bindParam(':cnpj', $dados['cnpj']);
$login_locadora->bindParam(':senha', $senha_md5);
$login_locadora->execute();

$row = $login_locadora->rowCount();

if($row == 1){
    
    $user_locadora = $login_locadora->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idLocadora'] = $user_locadora['idLocadora'];
    $_SESSION['locadora'] = $user_locadora['nomeFantasia'];
    $retorna = ["sucesso"];
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Locadora não foi cadastrado!"];
}

echo json_encode($retorna);